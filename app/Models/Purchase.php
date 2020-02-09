<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Purchase extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'voucher_code',
        'supplier_id', 
        'total', 
        'due', 
    ];
    //Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function purchasesProduct(){
        return $this->hasMany('App\Models\PurchasesProduct', 'purchases_id');
    }

    public function transactions(){
        return $this->hasMany('App\Models\Transaction', 'sell_stock_id')->groupBy('sell_stock_id');
    }
}
