<?php

namespace App\Interfaces\User;

use App\Models\User;

interface UserRepositoryInterface{

    public function findById(int $id): User;

    public function findByEmail(string $email): User;

    public function findAll(): array;

    public function create(array $data): bool;

    public function update(array $data, int $id): bool;

    public function delete(int $id): bool;
}
