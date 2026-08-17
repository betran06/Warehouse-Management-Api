<?php

namespace App\Services;

use App\Repositories\WarehouseRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

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
        $fields = ['*'];
        $warehouse = $this->warehouseRepository->getById($id, $fields);

        if (isset($data['photo']) && $data['photo'] instanceof UploadedFile) {
            if ($warehouse->photo) {
                $this->deletePhoto($warehouse->photo);
            }
            $data['photo'] = $this->uploadPhoto($data['photo']);
        }

        return $this->warehouseRepository->update($id, $data);
    }

    public function delete(int $id)
    {
        $field = ['*'];
        $warehouse = $this->warehouseRepository->getById($id, $field);

        if ($warehouse->photo) {
            $this->deletePhoto($warehouse->photo);
        }

        return $this->warehouseRepository->delete($id);
    }

    public function attachProduct(int $warehouseId, int $productId, int $stock)
    {
        $warehouse = $this->warehouseRepository->getById($warehouseId, ['id']);

        $warehouse->products()->syncWithoutDetaching([
            $productId => ['stock' => $stock]
        ]);

    }

    public function detachProduct(int $warehouseId, int $productId) //manager hapus data dari gudang.
    {
        $warehouse = $this->warehouseRepository->getById($warehouseId, ['id']);

        $warehouse->products()->detach($productId);
    }

    public function updateStock(int $warehouseId, int $productId, int $stock)
    {
        $warehouse = $this->warehouseRepository->getById($warehouseId, ['id']);

        $warehouse->products()->updateExistingPivot($productId, ['stock' => $stock]);

        return $warehouse->products()->where('product_id', $productId)->first();
    }

    private function uploadPhoto(UploadedFile $photo)
    {
        return $photo->store('warehouses', 'public');
    }

    private function deletePhoto(string $photoPath)
    {
        $relativePath = 'warehouses/' . basename($photoPath);
        if (Storage::disk('public')->exists($relativePath)) {
            Storage::disk('public')->delete($relativePath);
        }
    }
}
