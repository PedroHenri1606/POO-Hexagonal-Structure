<?php

namespace App\Services\API;

use App\DTOS\UserDto;
use App\Exceptions\EntityNotFound;
use App\Interfaces\UserServiceApiInterface;
use App\Repositories\UserRepository;
use App\Services\UserService;

class UserServiceApi extends UserService implements UserServiceApiInterface {

    public function __construct(
        private UserRepository $repository,
    ){}

    public function findById(int $id): UserDto{

        $user = $this->repository->findById($id);

        if(!$user){
            throw new EntityNotFound("User",404);
        }

        return UserDto::fromArray((array) $user);
    }

    /**
     * @return UserDto[]
     */
    public function findAll(): array {

        $users = $this->repository->findAll();

        return array_map(function($user){
            return UserDto::fromArray((array) $user);
        }, $users);
    }
}
