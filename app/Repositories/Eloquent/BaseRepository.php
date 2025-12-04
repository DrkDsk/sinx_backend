<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contract\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getAll(): Collection
    {
       return $this->model->all();
    }

    public function getById(int $id): ?Model
    {
        return $this->model->query()->where('id', $id)->first();
    }

    public function getByField(string $field, string $value): ?Model
    {
        return $this->model
            ->query()
            ->where($field, $value)
            ->first();
    }

    public function deleteById(int $id): ?bool
    {
        $instance = $this->getById($id);
        return $instance ? $instance->delete() : false;
    }

    public function create(array $data): ?Model
    {
        return $this->model->query()->create($data);
    }
}
