<?php

namespace App\DTOS\User;

class UserDtoRequestCreate{

    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ){}

    public static function fromArray(array $data): self{
        return new self(
            $data['name'],
            $data['email'],
            $data['password']
        );
    }

    public function rules(): array {

        return [
            "name"     => "required|min:3|max:250",
            "email"    => "email|max:250",
            "password" => "string|max:250",
        ];
    }
}
