<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validazione dei dati inviati dalla form
        $request->validate([
            'email' => 'required|email',
        ]);

        // Cerca l'utente corrispondente all'email fornita
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        
        Auth::login($user);

        return response()->json(['message' => 'Correctly logged in']);
    }
}
