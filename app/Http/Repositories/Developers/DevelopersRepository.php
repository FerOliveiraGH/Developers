<?php

namespace App\Http\Repositories\Developers;

use App\Http\Models\Developers\DevelopersModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class DevelopersRepository
{
    private DevelopersModel $model;

    public function __construct(DevelopersModel $model)
    {
        $this->model = $model;
    }

    public function getAll(): array
    {
        $query = $this->model->newQuery();

        $query->select(['developers.*', 'levels.nivel']);

        $query->join('levels', 'levels.id', '=', 'developers.nivel_id');

        return $query->paginate()->toArray();
    }

    public function get(int $id): array
    {
        $query = $this->model->newQuery();

        $query->select(['developers.*', 'levels.nivel']);

        $query->join('levels', 'levels.id', '=', 'developers.nivel_id');

        $data = $query->where('developers.id', '=', $id)->first();

        return $data ? $data->toArray() : [];
    }

    public function create(array $data): array
    {
        $query = $this->model->newQuery();

        $response = $query->create($data);

        return $response->toArray();
    }

    public function update(int $id, array $data): array
    {
        $query = $this->model->newQuery();

        $response = $query->where('id', '=', $id)->first();

        if ($response) {
            $response->update($data);
        }

        return $response ? $response->toArray() : [];
    }

    public function delete(int $id): int
    {
        $query = $this->model->newQuery();

        return $query->where('id', '=', $id)->delete();
    }

    public function getFirstByLevelId(int $id): array
    {
        $query = $this->model->newQuery();

        $data = $query->where('nivel_id', '=', $id)->first();

        return $data ? $data->toArray() : [];
    }
}
