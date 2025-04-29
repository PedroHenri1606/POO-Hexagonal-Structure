<?php

namespace App\Interfaces;

interface QueryBuilderInterface{

    public function select(string $table, array $columns, string $whereClause = '', array $whereBindings = []): array;

    public function insert(string $table, array $data): array;

    public function update(string $table, array $data, string $whereClause = '', array $whereBindings = []): array;

    public function delete(string $table, string $whereClause = '', array $whereBindings = []);
}
