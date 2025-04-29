<?php

namespace App\Services\Web;

use App\DTOS\User\UserDtoRequestCreate;
use App\DTOS\User\UserDtoRequestUpdate;
use App\DTOS\User\UserDtoResponseWeb;
use App\Exceptions\EntityNotFound;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\UserServiceWebInterface;
use App\Services\UserService;
use App\Utils\Validator;

class UserServiceWeb extends UserService implements UserServiceWebInterface{

    public function __construct(
        private UserRepositoryInterface $repository,
        private Validator $validator,
    ){}

    public function findById(int $id): UserDtoResponseWeb{

        $user = $this->repository->findById($id);

        if(!$user){
            throw new EntityNotFound("User",404);
        }

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

    public function create(array $data): bool {

        $userDto = UserDtoRequestCreate::fromArray($data);

        $this->validator->validate((array) $userDto,$userDto->rules());

        return $this->repository->create((array) $userDto);
    }

    public function update(int $id, array $data): bool{

        $this->findById($id);

        $userDto = UserDtoRequestUpdate::fromArray($data);

        $this->validator->validate( (array) $userDto, $userDto->rules());

        return $this->repository->update((array) $userDto, $id);
    }
}
