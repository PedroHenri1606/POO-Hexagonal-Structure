<?php

namespace App\Interfaces;

use App\Models\User;

interface UserInterface{

    public function findById($id): Collection | User;

    public function findAll(): Collection | User;

    public function create(): User;

    public function update(): bool;

    public function delete(): bool;
}
