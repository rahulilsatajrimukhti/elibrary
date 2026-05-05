<?php

namespace App\Http\Controllers;

use App\DTO\AuthDTO;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;

class AuthController extends Controller
{
    public function __construct(private AuthService $service)
    {
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $dto = new AuthDTO($request->validated());

        if ($this->service->login($dto)) {
            return redirect()->route('dashboard')->with('success', 'Login berhasil!');
        }

        return back()->withErrors([
            'login' => 'Email atau password salah!'
        ])->withInput();
    }

    public function logout()
    {
        $this->service->logout();
        return redirect()->route('login')->with('success', 'Berhasil logout!');
    }
}
