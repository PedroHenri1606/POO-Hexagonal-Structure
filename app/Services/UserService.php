<?php

namespace App\Services;

use App\Exceptions\EntityNotFound;
use App\Models\User;
use App\Repositories\UserRepository;
use Validator;

class UserService{

    private function __construct(
        private UserRepository $repository,
        private Validator $validator
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

        $users = $this->repository->findAll();

        if(!$users){
            throw new EntityNotFound("Users", 404);
        }

        return $users;
    }

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
