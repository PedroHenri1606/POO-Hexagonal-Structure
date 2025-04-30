<?php

namespace App\Interfaces\Auth;

use App\Models\User;

interface AuthApiInterface{

    public function getToken(): string;
    public function generateToken(User $user): string;
    public function validateToken(string $token): bool;
    public function getPayload(string $token): array;
    public function getUserFromToken(string $token): array;
    public function refreshToken(string $token): string;
    public function invalidateToken(string $token): void;
}
