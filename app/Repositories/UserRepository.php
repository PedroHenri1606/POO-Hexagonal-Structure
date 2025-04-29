<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Utils\QueryBuilder;
use DB;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserInterface{

    private function __construct(private QueryBuilder $queryBuilder){}

    public function findById(int $id): Collection{

        [$sql, $values] = $this->queryBuilder->select('users',['*'], 'id = ?', [$id]);

        return collect(DB::select($sql, $values));
    }

    public function findAll(): Collection{

        [$sql, $values] = $this->queryBuilder->select('users',['*']);

        return collect(DB::select($sql, $values));
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
