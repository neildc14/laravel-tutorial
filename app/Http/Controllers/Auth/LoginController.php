<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $token = $user->createToken('Laravel Password Grant Client')->accessToken;
            return response(['user' => $user, 'access_token' => $token]);
        } else {
            return response(['error' => 'Unauthenticated.'], 401);
        }
    }
}
