<?php

namespace App\Repositories;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
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
        $transaction->transaction_status = 'succeed'; //processing for just send // succeed for successfull transaction and failed for failed transaction

        $transaction->save();

        return $transaction->fresh();
    }


    public function getMostConvertedTransactionData(){
        $transactionData = Transaction::with(['user' => function($query){
            $query->select('name','id');
        }])->select('sender_id')
            ->selectRaw('COUNT(*) AS count')
            ->groupBy('sender_id')
            ->orderByDesc('count')
            ->limit(1)
            ->get();
        return $transactionData;
    }

    public function getUserWiseConvertedTransactionData(){
        $transactionData = Transaction::with(['user' => function($query){
            $query->select('name','id');
        }])->groupBy('sender_id')
            ->selectRaw('sum(actual_amount) as total, sender_id')
            ->get();

        return $transactionData;
    }

    public function getThirdHighestTransactionData(){
        $transactionData = Transaction::with(['user' => function($query){
            $query->select('name','id');
        }])->selectRaw("* FROM (SELECT actual_amount FROM transactions ORDER BY actual_amount DESC LIMIT 3) AS tbl ORDER BY actual_amount ASC LIMIT 1")->get();
        dd($transactionData);

        return $transactionData;
    }

}
