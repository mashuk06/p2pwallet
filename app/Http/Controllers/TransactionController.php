<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransactionService;
use App\Services\WalletService;
use App\Services\EmailService;

class TransactionController extends Controller
{

    protected $transactionService;

    public function __construct(TransactionService $transactionService,WalletService $walletService,EmailService $emailService){
        $this->transactionService = $transactionService;
        $this->walletService = $walletService;
        $this->emailService = $emailService;
    }

    public function store(Request $request){

        $data = $request->only([
            'receiver_id',
            'transaction_type',
            'actual_amount',
            'converted_amount',
            'conversion_rate',
            'transaction_description',
            'wallet_id'
        ]);
        try{
            $doTransaction = $this->transactionService->saveTransactionData($data);
            if($doTransaction) $this->walletService->adjustWalletBalance($data,$data['wallet_id']);
            $this->emailService->sendEmailToUser($data['receiver_id']);
        }catch(\Exception $e){
            return redirect()
                ->to('/wallet-dashboard')
                ->withError('Transaction failed !' . $e->getMessage());
        }
        return redirect()
            ->to('/wallet-dashboard')
            ->withSuccess('Transaction has been processed successfully !');
    }


}
