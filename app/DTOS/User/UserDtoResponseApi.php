<?php

namespace App\DTOS\User;

class UserDtoResponseApi{

    public function __construct(
        public string $name,
        public string $email,
    ){}

    public static function fromArray(array $data): self{

        return new self(
            $data['name'],
            $data['email'],
        );
    }
}
