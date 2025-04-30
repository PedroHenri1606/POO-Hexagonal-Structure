<?php

use App\DTOS\Auth\AuthDtoRequestLogin;
use Illuminate\Auth\Authenticatable;

interface AuthWebInterface{

    public function login(AuthDtoRequestLogin $data): bool;
    public function logout(): void;
    public function check(): bool;
    public function user(): Authenticatable;
    public function isGuest(): bool;
}
