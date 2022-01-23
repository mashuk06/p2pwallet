<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransactionService;

class TransactionController extends Controller
{

    protected $transactionService;

    public function __construct(TransactionService $transactionService){
        $this->transactionService = $transactionService;
    }

    public function store(Request $request){

        $data = $request->only([
            'receiver_id',
            'transaction_type',
            'actual_amount',
            'converted_amount',
            'conversion_rate',
            'transaction_description'
        ]);
        try{
            $this->transactionService->saveTransactionData($data);
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
