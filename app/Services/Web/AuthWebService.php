<?php

namespace App\Services\Web;

use App\DTOS\Auth\AuthDtoRequestLogin;
use App\Exceptions\AuthFailedException;
use App\Interfaces\Auth\AuthWebServiceInterface;
use AuthWebInterface;
use Illuminate\Auth\Authenticatable;

class AuthWebService implements AuthWebServiceInterface{

    public function __construct(
        private AuthWebInterface $auth
    ){}

    public function login(AuthDtoRequestLogin $data): void{

        $success = $this->auth->login($data);

        if (!$success) {
            throw new AuthFailedException('Invalid credentials.');
        }
    }

    public function logout(): void{

        $this->auth->logout();
    }

    public function check(): bool{

        return $this->auth->check();
    }

    public function user(): Authenticatable{

        return $this->auth->user();
    }

    public function isGuest(): bool{

        return $this->auth->isGuest();
    }
}
