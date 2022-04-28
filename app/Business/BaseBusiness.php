<?php

namespace App\Business;

abstract class BaseBusiness
{
    public function pagination(array $data, int $currentPage, int $lastPage, int $perPage, int $total): array
    {
        return [
            'data' => $data,
            'meta_data' => [
                'current_page' => $currentPage,
                'last_page' => $lastPage,
                'per_page' => $perPage,
                'total' => $total
            ]
        ];
    }

    public function adaptResponse(array $data): array
    {
        return [
            'data' => $data,
        ];
    }
}