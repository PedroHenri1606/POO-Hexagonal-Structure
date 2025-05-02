<?php

namespace App\Services;

use App\DTOS\User\UserDtoRequestCreate;
use App\DTOS\User\UserDtoRequestUpdate;
use App\DTOS\User\UserDtoResponseApi;
use App\DTOS\User\UserDtoResponseWeb;
use App\Interfaces\User\UserRepositoryInterface;

abstract class UserService{

    public function __construct(
        protected UserRepositoryInterface $repository,
    ){}

    abstract public function findById(int $id): UserDtoResponseApi | UserDtoResponseWeb;

    abstract public function findAll(): array;

    abstract public function create(UserDtoRequestCreate $userDto): bool ;

    abstract public function update(int $id, UserDtoRequestUpdate $userDto): bool;

    public function delete(int $id):bool {

        $this->findById($id);

        return $this->repository->delete($id);
    }
}
