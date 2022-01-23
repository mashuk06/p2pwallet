<?php

namespace App\Repositories;
use App\Models\Wallet;

class WalletRepository
{
     /**
     * @var Wallet
     */
    protected $wallet;

    /**
     * Wallet Repository constructor
     *
     * @param Wallet $wallet
     */
    public function __construct(Wallet $wallet){
        $this->wallet = $wallet;
    }

    /**
     * update Wallet
     *
     * @param $data
     */

    public function update($data,$id){
        $wallet = $this->wallet->find($id);
        $wallet->available_amount = $wallet->available_amount - $data['actual_amount'];
        $wallet->save();

        return $wallet;
    }
}
