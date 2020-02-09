<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\SaleDetails;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchasesProduct extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'purchases_id',
        'product_id',
        'quantity',
        'buy_price', 
        'sell_price' 
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchases_id');
    }
    public function sellDetails()
    {
        return $this->belongsTo(SaleDetails::class, 'product_id', 'product_id');
    }
}
