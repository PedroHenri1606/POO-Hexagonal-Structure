<?php

namespace App\Interfaces\Auth;

use App\DTOS\Auth\AuthDtoRequestLogin;

interface AuthServiceInterface {

    public function getToken(): string ;
    public function getTokenPayload(): array;
    public function checkToken(): bool;
    public function login(AuthDtoRequestLogin $data): string;
    public function logout(): void;
    public function refresh(): string;
}
