<?php

namespace App\Repositories;

use App\Models\WarehouseProduct;
use Illuminate\Validation\ValidationException;

class ProductWarehouseRepository
{
    public function getByWarehouseAndProduct(int $warehouseId, int $productId) //untuk memastikan pada warehouse tersedia product tsb.
    {
        return WarehouseProduct::where('warehouse_id', $warehouseId)
            ->where('product_id', $productId)
            ->first();
    }

    public function updateStock(int $warehouseId, int $productId, int $stock) //melakukan edit stock pada merchant. tapi mengurangi stock pada warehouse tsb.
    {
        $warehouseProduct = $this->getByWarehouseAndProduct($warehouseId, $productId);

        if (!$warehouseProduct) {
            throw ValidationException::withMessages([
                'product_id' => ['Product not found for this warehouse.']
            ]);
        }

        $warehouseProduct->update(['stock' => $stock]);

        return $warehouseProduct;
    }


}
