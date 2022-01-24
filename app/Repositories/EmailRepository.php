<?php

namespace App\Repositories;
use App\Models\User;
use App\Jobs\TransactionEmailJob;

class EmailRepository
{
     /**
     * @var user
     */
    protected $user;

    /**
     * Email Repository constructor
     *
     * @param User $user
     */
    public function __construct(User $user){
        $this->user = $user;
    }

    /**
     * find and send email to user
     *
     * @param $receiver_id for user
     */

    public function getUserEmailAndSendEmail($receiver_id){
        $user = $this->user->where('id',$receiver_id)->first();
            dispatch(new TransactionEmailJob($user->email));
        return true;
    }
}
