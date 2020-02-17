<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleDetails extends Model
{
    protected $fillable=[
        'sale_id',
        'product_id',
        'qty',
        'price',
        'subtotal',
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function sale(){
        return $this->belongsTo(sale::class, 'sale_id');
    }
}
