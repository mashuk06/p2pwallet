<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransactionService;

class DashboardController extends Controller
{

    protected $transaction;

    public function __construct(TransactionService $transactionService){
        $this->transactionService = $transactionService;
    }

    public function index(){
        $errors = '';
        try{
            $mostConversion = $this->transactionService->getMostConversion();
            $totalAmountConversionByUser = $this->transactionService->getUserWiseTotalAmountConversion();
            $thirdHighestConvertedAmount = $this->transactionService->getThirdHighestConvertedAmount();
            dd($thirdHighestConvertedAmount);
        }catch(\Exception $e){
            $errors = $e->getMessage();
        }
        return view('welcome',[
            'mostConversion' => $mostConversion,
            'totalAmountConversionByUser' => $totalAmountConversionByUser,
            'errors' => $errors
        ]);
    }
}
