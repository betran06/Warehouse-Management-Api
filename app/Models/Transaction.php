<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Soft;

class Transaction extends Model
{
    //
    use SoftDeletes;

    protected $fillable = ['name', 'phone', 'sub_total', 'tax_total', 'grand_total', 'merchant_id'];

    public function merchant() //transaksi ini dimiliki toko yang mana
    {
        return $this->belongsTo(Merchant::class);    
    }

    public function transactionProducts() //dalam satu transaksi ada produk apa saja yang dibeli
    {
        return $this->hasMany(TransactionProduct::class);
    }
}
