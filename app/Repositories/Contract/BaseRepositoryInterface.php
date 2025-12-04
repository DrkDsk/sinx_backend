<?php

namespace App\Repositories\Contract;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    public function getAll() : Collection;

    public function getById(int $id) : ?Model;

    public function getByField(string $field, string $value) : ?Model;

    public function deleteById(int $id): ?bool;

    public function create(array $data) : ?Model;
}
