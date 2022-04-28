<?php

namespace App\Business;

use App\Exceptions\BusinessException;
use App\Http\Repositories\Developers\LevelsRepository;

class LevelsBusiness extends BaseBusiness
{
    private LevelsRepository $repository;

    public function __construct(LevelsRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAll(): array
    {
        $response = $this->repository->getAll();

        return $this->pagination(
            $response['data'],
            $response['current_page'],
            $response['last_page'],
            $response['per_page'],
            $response['total'],
        );
    }

    public function get(int $id): array
    {
        $data = $this->repository->get($id);

        return $this->adaptResponse($data);
    }

    public function create(array $data): array
    {
        $data = $this->repository->create($data);

        return $this->adaptResponse($data);
    }

    /** @throws BusinessException */
    public function update(int $id, array $data): array
    {
        $data = $this->repository->update($id, $data);

        if (!$data) {
            throw new BusinessException('Error update level.');
        }

        return $this->adaptResponse($data);
    }

    /** @throws BusinessException */
    public function delete(int $id): void
    {
        $response = $this->repository->delete($id);

        if (!$response) {
            throw new BusinessException('Error delete level.');
        }
    }
}
