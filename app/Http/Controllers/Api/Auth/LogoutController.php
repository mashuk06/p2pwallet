<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

class LogoutController extends Controller
{

    use ApiResponse;

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return $this->success('Successfully logged out.', 200);
    }
}
