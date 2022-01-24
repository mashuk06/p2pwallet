<?php

namespace App\Services;

use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class TransactionService
{
    /**
     * @var TransactionRepository
     */
    protected $transactionRepository;

    /**
     * Transaction service constructor
     *
     * @param TransactionRepository $transactionRepository
     */

    public function __construct(TransactionRepository $transactionRepository){
        $this->transactionRepository = $transactionRepository;
    }

    public function saveTransactionData($data){
        $validator = Validator::make($data,[
            'receiver_id' => 'required',
            'transaction_type' => 'in:debit,credit',
            'actual_amount' => 'required',
            'converted_amount' => 'required',
            'conversion_rate' => 'required',
        ]);

        if($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->transactionRepository->save($data);

        return $result;
    }

    public function getMostConversion(){
        $result = $this->transactionRepository->getMostConvertedTransactionData();
        return $result;
    }

    public function getUserWiseTotalAmountConversion(){
        $result = $this->transactionRepository->getUserWiseConvertedTransactionData();
        return $result;
    }

    public function getThirdHighestConvertedAmount(){
        $result = $this->transactionRepository->getThirdHighestTransactionData();
        return $result;
    }

}
