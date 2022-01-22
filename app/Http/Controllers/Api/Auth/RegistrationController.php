<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class RegistrationController extends Controller
{

    use ApiResponse;

    public function register(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return $this->success([
                'message' => "Registration successful.",
                'token' => $token,
                'expires_in' => 60 * 24 * 7,
                'user' => $user
            ], 200);
        }catch(\Exception $e){
            return $this->error("Something went wrong. Please try again!", $e->getCode());
        }
    }
}
