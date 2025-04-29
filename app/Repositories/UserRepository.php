<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFound;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Utils\QueryBuilder;
use DB;

class UserRepository implements UserRepositoryInterface{

    public function __construct(private QueryBuilder $queryBuilder){}

    public function findById(int $id): User{

        [$sql, $values] = $this->queryBuilder->select('users',['*'], 'id = ?', [$id]);

        $result = DB::select($sql, $values);

        if(empty($result)){
            throw new EntityNotFound('User', 404);
        }

        return new User((array) $result[0]);
    }

    public function findAll(): array{

        [$sql, $values] = $this->queryBuilder->select('users',['*']);

        $result = DB::select($sql, $values);

        if(empty($result)){
            throw new EntityNotFound('User', 404);
        }

        return $result;
    }

    public function create(array $data): bool{

        [$sql, $values] = $this->queryBuilder->insert('users', $data);

        return DB::insert($sql,$values);
    }

    public function update(array $data, int $id): bool{

        [$sql, $values] = $this->queryBuilder->update('users', $data, 'id = ?', [$id]);

        return DB::update($sql, $values);
    }

    public function delete(int $id): bool {

        [$sql, $values] = $this->queryBuilder->delete('users', 'id = ?', [$id]);

        return DB::delete($sql, $values);
    }
}
