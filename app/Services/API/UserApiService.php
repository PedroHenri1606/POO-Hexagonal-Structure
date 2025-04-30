<?php

namespace App\Services\API;

use App\DTOS\User\UserDtoRequestCreate;
use App\DTOS\User\UserDtoRequestUpdate;
use App\DTOS\User\UserDtoResponseApi;
use App\Interfaces\User\UserRepositoryInterface;
use App\Interfaces\User\UserServiceApiInterface;
use App\Services\UserService;
use App\Utils\Validator;

class UserApiService extends UserService implements UserServiceApiInterface {

    public function __construct(
        private UserRepositoryInterface $repository,
        private Validator $validator,
    ){}

    public function findById(int $id): UserDtoResponseApi{

        $user = $this->repository->findById($id);

        return UserDtoResponseApi::fromArray($user->toArray());
    }

    public function findByEmail(string $email): UserDtoResponseApi{

        $user = $this->repository->findByEmail($email);

        return UserDtoResponseApi::fromArray($user->toArray());
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
