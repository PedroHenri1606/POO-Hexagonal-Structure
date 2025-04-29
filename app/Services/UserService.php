<?php

namespace App\Services;

use App\DTOS\User\UserDtoResponseApi;
use App\DTOS\User\UserDtoResponseWeb;
use App\Interfaces\UserRepositoryInterface;

abstract class UserService{

    public function __construct(
        private UserRepositoryInterface $repository,
    ){}

    abstract public function findById(int $id): UserDtoResponseApi | UserDtoResponseWeb;

    abstract public function findAll(): array;

    abstract public function create(array $data): bool ;

    abstract public function update(int $id, array $data): bool;

    public function delete(int $id):bool {

        $this->findById($id);

        return $this->repository->delete($id);
    }
}
