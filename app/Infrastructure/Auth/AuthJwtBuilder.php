<?php

namespace App\Infrastructure\Auth;

use App\Exceptions\TokenNotFound;
use App\Interfaces\Auth\AuthInfrastructureInterface;
use App\Models\User;
use Tymon\JWTAuth\JWTAuth;

class AuthJwtBuilder implements AuthInfrastructureInterface{

    public function __construct(
        private JWTAuth $jwt
    ){}

    public function getToken(): string {

        return $this->jwt->getToken();
    }

    public function generateToken(User $user): string {

        return $this->jwt->fromUser($user);
    }

    public function validateToken(string $token): bool {

        if($this->jwt->setToken($token)->check()){
            return true;
        }

        throw new TokenNotFound('The token provided is incorrect or not valid');
    }

    public function getPayload(string $token): array {

        return $this->jwt->setToken($token)->getPayload()->toArray();
    }

    public function getUserFromToken(string $token): array{

        return (array) $this->jwt->setToken($token)->toUser();
    }

    public function refreshToken(string $token): string {

        return $this->jwt->setToken($token)->refresh();
    }

    public function invalidateToken(string $token): void {

        $this->jwt->setToken($token)->invalidate();
    }
}
