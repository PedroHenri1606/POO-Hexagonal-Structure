<?php

namespace App\Services\API;

use App\DTOS\Auth\AuthDtoRequestLogin;
use App\Exceptions\AuthFailedException;
use App\Interfaces\Auth\AuthApiInterface;
use App\Interfaces\Auth\AuthApiServiceInterface;
use App\Repositories\UserRepository;
use Hash;

class AuthApiService implements AuthApiServiceInterface{

    public function __construct(
        private AuthApiInterface $auth,
        private UserRepository $userRepository,
    ){}

    public function getToken(): string {
        return $this->auth->getToken();
    }

    public function getTokenPayload(): array {

        return $this->auth->getPayload($this->auth->getToken());
    }

    public function checkToken(): bool {

        return $this->auth->validateToken($this->auth->getToken());
    }

    public function login(AuthDtoRequestLogin $data): string {

        $user =  $this->userRepository->findByEmail($data->email);

        if (!Hash::check($data->password, $user->password)) {
            throw new AuthFailedException('Invalid credentials');
        }

        return $this->auth->generateToken($user);
    }

    public function logout(): void {

        $this->auth->invalidateToken($this->auth->getToken());
    }

    public function refresh(): string {

        return $this->auth->refreshToken($this->auth->getToken());
    }
}
