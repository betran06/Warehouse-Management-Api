<?php

namespace App\Http\Controllers;

use App\Http\Requests\WarehouseProductRequest;
use App\Http\Requests\WarehouseProductUpdateRequest;
use App\Services\WarehouseService;

class WarehouseProductController extends Controller
{
    private WarehouseService $warehouseService;

    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    public function attach(WarehouseProductRequest $request, int $warehouseId)
    {
        $this->warehouseService->attachProduct(
            $warehouseId,
            $request->input('product_id'),
            $request->input('stock'),
        );

        return response()->json(['message' => 'Product attached successfully']);
    }

    public function detach(int $warehouseId, int $productId) //product yang ingin dihilangkan dari gudang apa.
    {
        $this->warehouseService->detachProduct($warehouseId, $productId);
        return response()->json(['message' => 'Product detached succesfully']);
    }

    public function update(WarehouseProductUpdateRequest $request, int $warehouseId, int $productId)
    {
        $warehouseProduct = $this->warehouseService->updateStock(
            $warehouseId,
            $productId,
            $request->input('stock'),
        );

        return response()->json([
            'message' => 'Stock updated successfully',
            'data' => $warehouseProduct,
        ]);
    }
}
