<?php

namespace App\DTOS;

class UserDto{

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
