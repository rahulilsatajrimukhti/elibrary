<?php

namespace App\Services;

use App\DTO\AuthDTO;
use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(AuthDTO $dto): bool
    {
        if (Auth::attempt($dto->toArray())) {
            request()->session()->regenerate();
            return true;
        }

        return false;
    }

    public function logout(): void
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
    }
}
