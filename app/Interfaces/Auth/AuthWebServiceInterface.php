<?php

namespace App\Interfaces\Auth;

use App\DTOS\Auth\AuthDtoRequestLogin;
use Illuminate\Auth\Authenticatable;

interface AuthWebServiceInterface{

    public function login(AuthDtoRequestLogin $data): void;
    public function logout(): void;
    public function check(): bool;
    public function user(): Authenticatable;
    public function isGuest(): bool;
}
