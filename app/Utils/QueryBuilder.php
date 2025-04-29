<?php

namespace App\Utils;

use App\Interfaces\QueryBuilderInterface;
use DB;

class QueryBuilder implements QueryBuilderInterface{

    public function select(string $table, array $columns, string $whereClause = '', $whereBindings = []): array{

        $cols = implode(',', $columns);
        $sql  = "SELECT {$cols} FROM {$table}";

        if($whereClause){
            $sql .= " WHERE {$whereClause}";
        }

        return [$sql, $whereBindings];
    }

    public function insert(string $table, array $data): array{

        $columns      = array_keys($data);
        $placeholders = implode(',', $columns);
        $values       = array_values($data);

        $sql = "INSERT INTO {$table} " . implode(',', $columns) . " VALUES ('{$placeholders}')";

        return [$sql, $values];
    }

    public function update(string $table, array $data, string $whereClause = '', array $whereBindings = []): array{

        $columns = array_keys($data);
        $sets    = implode(',', array_map(fn($columns) => "$columns = ?", $columns));
        $values  = array_values($data);

        $sql = "UPDATE {$table} SET {$sets} WHERE {$whereClause}";

        return [$sql, array_merge($values, $whereBindings)];
    }

    public function delete(string $table, string $whereClause = '', array $whereBindings = []): array{

        $sql = "DELETE FROM {$table} WHERE {$whereClause}";

        return [$sql, $whereBindings];
    }
}
