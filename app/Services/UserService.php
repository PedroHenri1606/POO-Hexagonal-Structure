<?php

namespace App\Services;

use App\DTOS\UserDto;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Utils\Validator;

abstract class UserService{

    public function __construct(
        private UserRepositoryInterface $repository,
        private Validator $validator,
    ){}

    abstract public function findById(int $id): UserDto | User;

    abstract public function findAll(): array;

    public function create(array $data): bool {

        $this->validator->validate($data,[
            "name"     => "required|min:3|max:250",
            "email"    => "email|max:250",
            "password" => "string|max:250",
        ]);

        return $this->repository->create($data);
    }

    public function update(int $id, array $data): bool{

        $this->findById($id);

        $this->validator->validate($data,[
            "name"     => "required|min:3|max:250",
            "email"    => "email|max:250",
            "password" => "string|max:250",
        ]);

        return $this->repository->update($data, $id);
    }

    public function delete(int $id):bool {

        $this->findById($id);

        return $this->repository->delete($id);
    }
}
