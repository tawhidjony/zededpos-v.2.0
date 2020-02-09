<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnProductDetails extends Model
{
    protected $fillable=[
        'return_product_id',
        'product_id',
        'qty',
        'price',
        'subtotal',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
