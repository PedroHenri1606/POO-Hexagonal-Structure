<?php

namespace App\DTOS\User;

class UserDtoRequestUpdate{

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

    public function rules(): array {

        return  [
            "name"     => "required|min:3|max:250",
            "email"    => "email|max:250",
            "password" => "string|max:250",
        ];
    }
}
