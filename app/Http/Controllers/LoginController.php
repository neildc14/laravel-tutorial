<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Events\LoginHistory;

class LoginController extends Controller
{   
    private function authenticated() {

        $user = Auth::user();
        event(new LoginHistory($user));
    }

    public function login(Request $request){            
        $request->validate([
            'name' => 'required|email',
            'email' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'name' => $request->name])) {
        // The user is being remembered
            $this->authenticated();
            return response()->json(['message' => 'Successfully logged in'], 200);
        }
        else{
            return response()->json(['error' => 'These credentials do not match our records.'], 401);
        }
    
    }
}
