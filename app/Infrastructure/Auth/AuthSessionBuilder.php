<?php

namespace App\Infrastructure\Auth;

use App\DTOS\Auth\AuthDtoRequestLogin;
use App\Models\User;
use Auth;
use AuthWebInterface;
use Illuminate\Auth\Authenticatable;

class AuthSessionBuilder implements AuthWebInterface{

    public function login(AuthDtoRequestLogin $data): bool{

        return auth()->guard('web')->attempt([
            "email"    => $data->email,
            "password" => $data->password,
        ]);
    }

    public function logout(): void{
        auth()->guard('web')->logout();
    }

    public function check(): bool{
        return auth()->guard('web')->check();

    }

    public function user(): Authenticatable{
        return auth()->guard('web')->user();
    }

    public function isGuest(): bool{
        return auth()->guard('web')->guest();
    }
}
