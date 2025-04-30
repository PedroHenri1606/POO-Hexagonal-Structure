<?php

namespace App\Interfaces\User;

use App\DTOS\User\UserDtoRequestCreate;
use App\DTOS\User\UserDtoRequestUpdate;

interface UserServiceWebInterface{

    public function findAll(): array;
    public function findById(int $id): mixed;
    public function findByEmail(string $email): mixed;
    public function create(UserDtoRequestCreate $data): bool;
    public function update(int $id, UserDtoRequestUpdate $data): bool;
    public function delete(int $id): bool;
}
