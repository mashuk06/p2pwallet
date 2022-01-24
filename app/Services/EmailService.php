<?php

namespace App\Services;

use App\Repositories\EmailRepository;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class EmailService
{
    /**
     * @var EmailRepository
     */
    protected $emailRepository;

    /**
     * Email service constructor
     *
     * @param EmailRepository $emailRepository
     */

    public function __construct(EmailRepository $emailRepository){
        $this->emailRepository = $emailRepository;
    }

    public function sendEmailToUser($receiver_id){
        $result = $this->emailRepository->getUserEmailAndSendEmail($receiver_id);
        return $result;
    }
}
