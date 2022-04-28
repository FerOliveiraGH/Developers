<?php

namespace App\Http\Repositories\Developers;

use App\Http\Models\Developers\LevelsModel;

class LevelsRepository
{
    private LevelsModel $model;
    private DevelopersRepository $repository;

    public function __construct(LevelsModel $model, DevelopersRepository $repository)
    {
        $this->model = $model;
        $this->repository = $repository;
    }

    public function getAll(): array
    {
        $query = $this->model->newQuery();

        return $query->paginate()->toArray();
    }

    public function get(int $id): array
    {
        $query = $this->model->newQuery();

        $data = $query->where('id', '=', $id)->first();

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
        $developer = $this->repository->getFirstByLevelId($id);

        if (!empty($developer)) {
            return 0;
        }

        $query = $this->model->newQuery();

        return $query->where('id', '=', $id)->delete();
    }
}
