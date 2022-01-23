<?php

namespace App\Repositories;
use App\Models\Transaction;

class TransactionRepository
{

    /**
     * @var Transaction
     */
    protected $transaction;

    /**
     * Transaction Repository constructor
     *
     * @param Transaction $transaction
     */
    public function __construct(Transaction $transaction){
        $this->transaction = $transaction;
    }

    /**
     * Save Transaction
     *
     * @param $data
     * @return Transaction
     */

    public function save($data){
        $transaction = new $this->transaction;
        $transaction->transaction_id = uniqid('TRANS');
        $transaction->sender_id = auth()->id();
        $transaction->receiver_id = $data['receiver_id'];
        $transaction->transaction_type = $data['transaction_type']; //debit or credit
        $transaction->transaction_description = $data['transaction_description'];
        $transaction->actual_amount = $data['actual_amount']; //amount has been sent
        $transaction->converted_amount = $data['converted_amount']; //amount has been received
        $transaction->conversion_rate = $data['conversion_rate']; //amount has been received
        $transaction->transaction_status = 'processing'; //processing for just send // succeed for successfull transaction and failed for failed transaction

        $transaction->save();

        return $transaction->fresh();
    }


}
