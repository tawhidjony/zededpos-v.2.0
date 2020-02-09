<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable=[
        'customer_type',
        'sale_id',
        'customer_id',
        'total',
        'discount',
        'grand_total',
        'return_amount',
        'due_amount',
        'pay_amount',
        'pay_method',
    ];

    public function invoice(){
        return $this->hasMany(InvoiceDetails::class, 'invoice_id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
