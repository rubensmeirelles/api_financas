<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // validação do request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $email = $request->email;
        $password = $request->password;
        $attempt = auth()->attempt([
            'email' => $email,
            'password' => $password
        ]);

        if(!$attempt){
            return response()->json([
                'error' => 'Não autorizado.'
            ], 401);
        }

        $user = auth()->user();
        $token = $user->createToken($user->nome)->plainTextToken;

        return response()->json(['token' => $token]);

    }
}
