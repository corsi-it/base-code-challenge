<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request): Redirector|Application|RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            // Authentication successful
            return redirect('/'); // Redirect to the main route after successful login
        } else {
            // Authentication failed
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        }
    }

    public function logout(): Redirector|Application|RedirectResponse
    {
        Auth::logout();
        return redirect('/login');
    }

    public function loginForm(): Factory|View|Application
    {
        return view('login');
    }

    public function apiLogin(Request $request): Response
    {

        $fields = $request->validate([
            'email' => ['required','email'],
            'password' => ['required', 'string']
        ]);

        $user = User::where('email', $fields['email'])->first();

        if(!$user){
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        if($user->email_verified_at===null) {
            return response([
                'message' => 'Please verify your email first'
            ], 401);
        }

        if(!Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        try {
            $token = $user->createToken(bin2hex(random_bytes(10)))->plainTextToken;
        } catch (Exception $e) {
            return response([
                'message' => 'There was an error in token creation '.$e
            ], 500);
        }

        $response = [
            'user' => [
                'email' => $user->email,
            ],
            'token' => $token,
        ];

        return response($response, 200);
    }

    public function apiLogout(Request $request): Response
    {

        if($request->user()->currentAccessToken()->delete()){ //Remove only the token used to authenticate the current request
            return response([
                'message' => 'Logged out'
            ], 200);
        }
        else {
            return response([
                'message' => 'An error occurred during logout'
            ], 500);
        }

    }
}
