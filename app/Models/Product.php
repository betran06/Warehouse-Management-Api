<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Product extends Model
{
    use softDeletes;

    protected $fillable = ['name', 'thumbnail', 'about', 'price', 'category_id', 'is_popular'];

    public function category()
    {
        return $this->belongsTo(Category::class); 
    }

    public function merchants()
    {
        return $this->belongsToMany(Merchant::class, 'merchant_product')
                    ->withPivot('stock') //digunakan untuk update stock dengan baik
                    ->withTimestamps();
    }

    public function warehouses()
    {
        return $this->belongsToMany(Warehouse::class, 'warehouse_products')
                    ->withPivot('stock')
                    ->withTimestamps();
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class); //untuk ngecek product ini ada berapa transaksi
    }

    public function getWarehouseProductStock(): int
    {
        return $this->warehouses()->sum('stock');
    }

    public function getMerchantProductStock(): int
    {
        return $this->merchants()->sum('stock');
    }

    public function getThumbnailAttribute($value)
    {
        if (!$value) {
            return null; // no image available
        }

        return url(Storage::url($value)); // domain.com/storage/products/nama-photo.png
    }
}
