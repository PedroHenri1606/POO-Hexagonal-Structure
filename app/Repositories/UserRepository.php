<?php

namespace App\Repositories;

use App\Exceptions\EntityNotFound;
use App\Interfaces\QueryBuilder\QueryBuilderInterface;
use App\Interfaces\User\UserRepositoryInterface;
use App\Models\User;
use DB;

class UserRepository implements UserRepositoryInterface{

    public function __construct(private QueryBuilderInterface $queryBuilder){}

    public function selectEquals(string $whereClause, array $whereBindings): array{

        [$sql, $values] = $this->queryBuilder->select('users', ['*'], $whereClause, $whereBindings);

        $result = DB::select($sql, $values);

        if(empty($result)){
            throw new EntityNotFound('User', 404);
        }

        return $result;
    }

    public function findByEmail(string $email): User{

        [$sql, $values] = $this->queryBuilder->select('users', ['*'],  'email = ?', [$email]);

        $result = DB::select($sql, $values);

        if(empty($result)){
            throw new EntityNotFound('User', 404);
        }

        return new User((array) $result[0]);
    }

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
