<?php

namespace App\Services;

use App\Repositories\WalletRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class WalletService
{
    /**
     * @var WalletRepository
     */
    protected $walletRepository;

    /**
     * Wallet service constructor
     *
     * @param WalletRepository $walletRepository
     */

    public function __construct(WalletRepository $walletRepository){
        $this->walletRepository = $walletRepository;
    }

    public function adjustWalletBalance($data,$id){
        $validator = Validator::make($data,[
            'actual_amount' => 'required',
        ]);

        if($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $result = $this->walletRepository->update($data,$id);
        
        return $result;
    }
}
