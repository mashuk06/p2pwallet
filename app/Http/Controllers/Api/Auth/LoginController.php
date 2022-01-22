<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    use ApiResponse;
    
    public function login(Request $request)
    {
        try{
            if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('p2pwallet')->plainTextToken;

        return $this->success([
                'message' => "Login successful.",
                'token' => $token,
                'expires_in' => 60 * 24 * 7,
                'user' => $user
            ], 200);
        }catch(\Exception $e){
            return $this->error("Something went wrong. Please try again!", $e->getCode());
        }
    }
}
