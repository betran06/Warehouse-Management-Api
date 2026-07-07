<?php

namespace App\Services;

use App\Repository\WarehouseRepository;
use GuzzleHttp\Psr7\UploadedFile;

class WarehouseService
{
    private WarehouseRepository $warehouseRepository;

    public function __construct(WarehouseRepository $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function getAll(array $fields)
    {
        return $this->warehouseRepository->getAll($fields);
    }

    public function getById(int $id, array $fields)
    {
        return $this->warehouseRepository->getById($id, $fields ?? ['*']);
    }

    public function create(array $data)
    {
        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }
        return $this->warehouseRepository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->warehouseRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->warehouseRepository->delete($id);
    }
}
