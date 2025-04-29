<?php

namespace App\DTOS\User;

class UserDtoResponseWeb{

    public function __construct(
        public int $id,
        public string $name,
        public string $email,
    ){}

    public static function fromArray(array $data): self {

        return new self(
            $data['id'],
            $data['name'],
            $data['email'],
        );
    }
}
