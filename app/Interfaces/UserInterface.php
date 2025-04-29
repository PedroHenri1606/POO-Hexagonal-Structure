<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface UserInterface{

    public function findById(int $id): Collection;

    public function findAll(): Collection;

    public function create(array $data): bool;

    public function update(array $data, int $id): bool;

    public function delete(int $id): bool;
}
