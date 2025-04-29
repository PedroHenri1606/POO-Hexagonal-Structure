<?php

namespace App\Interfaces;

interface UserServiceApiInterface{

    public function findAll(): array;
    public function findById(int $id): mixed;
    public function create(array $data): bool;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}
