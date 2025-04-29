<?php

namespace App\Services\API;

use App\DTOS\User\UserDtoRequestCreate;
use App\DTOS\User\UserDtoRequestUpdate;
use App\DTOS\User\UserDtoResponseApi;
use App\Exceptions\EntityNotFound;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\UserServiceApiInterface;
use App\Services\UserService;
use App\Utils\Validator;

class UserServiceApi extends UserService implements UserServiceApiInterface {

    public function __construct(
        private UserRepositoryInterface $repository,
        private Validator $validator,
    ){}

    public function findById(int $id): UserDtoResponseApi{

        $user = $this->repository->findById($id);

        if(!$user){
            throw new EntityNotFound("User",404);
        }

        return UserDtoResponseApi::fromArray((array) $user);
    }

    /**
     * @return UserDtoResponseApi[]
     */
    public function findAll(): array {

        $users = $this->repository->findAll();

        return array_map(function($user){
            return UserDtoResponseApi::fromArray((array) $user);
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
