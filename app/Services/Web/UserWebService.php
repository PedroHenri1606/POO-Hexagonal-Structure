<?php

namespace App\Services\Web;

use App\DTOS\User\UserDtoRequestCreate;
use App\DTOS\User\UserDtoRequestUpdate;
use App\DTOS\User\UserDtoResponseWeb;
use App\Interfaces\User\UserRepositoryInterface;
use App\Interfaces\User\UserServiceWebInterface;
use App\Services\UserService;
use App\Utils\Validator;

class UserWebService extends UserService implements UserServiceWebInterface{

    public function __construct(
        private UserRepositoryInterface $repository,
        private Validator $validator,
    ){}

    public function findById(int $id): UserDtoResponseWeb{

        $user = $this->repository->findById($id);

        return UserDtoResponseWeb::fromArray((array) $user);
    }

    public function findByEmail(string $email): UserDtoResponseWeb{

        $user = $this->repository->findByEmail($email);

        return UserDtoResponseWeb::fromArray((array) $user);
    }

    /**
     * @return UserDtoResponseWeb[]
     */
    public function findAll(): array {

        $users = $this->repository->findAll();

        return array_map(function($user){
            return UserDtoResponseWeb::fromArray((array) $user);
        }, $users);
    }

    public function create(UserDtoRequestCreate $userDto): bool {

        $this->validator->validate((array) $userDto,$userDto->rules());

        return $this->repository->create((array) $userDto);
    }

    public function update(int $id, UserDtoRequestUpdate $userDto): bool{

        $this->findById($id);

        $this->validator->validate( (array) $userDto, $userDto->rules());

        return $this->repository->update((array) $userDto, $id);
    }
}
