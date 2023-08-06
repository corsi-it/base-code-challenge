<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

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
}
