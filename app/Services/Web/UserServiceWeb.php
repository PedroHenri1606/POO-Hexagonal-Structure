<?php

namespace App\Services\Web;

use App\Exceptions\EntityNotFound;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;

class UserServiceWeb extends UserService{

    public function __construct(
        private UserRepository $repository,
    ){}

    public function findById(int $id): User{

        $user = $this->repository->findById($id);

        if(!$user){
            throw new EntityNotFound("User",404);
        }

        return $user;
    }

    /**
     * @return User[]
     */
    public function findAll(): array {

        return $this->repository->findAll();
    }
}
