<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnProduct extends Model
{
    protected $fillable=[
        'customer_type',
        'sale_id',
        'customer_id',
        'total',
        'discount',
        'grand_total',
        'return_amount',
        'extra_payment',
        'due_amount',
        'pay_amount',
        'pay_method',
        'check_no',
        'bank_name',
        'check_owner_name',
        'card_invoice_no',
        'card_owner_name',
    ];

    public function return_products(){
        return $this->hasMany(ReturnProductDetails::class, 'return_product_id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
