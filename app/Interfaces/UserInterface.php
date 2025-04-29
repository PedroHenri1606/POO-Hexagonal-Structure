<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserInterface{

    public function findById(int $id): User;

    public function findAll(): array;

    public function create(array $data): bool;

    public function update(array $data, int $id): bool;

    public function delete(int $id): bool;
}
