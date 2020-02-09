<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SaleDetails;
class Sale extends Model
{
    protected $fillable=[
        'customer_type',
        'customer_id',
        'total',
        'discount',
        'grand_total',
        'return_amount',
        'due_amount',
        'vat_amount',
        'pay_amount',
        'pay_method',
        'check_no',
        'bank_name',
        'check_owner_name',
        'card_invoice_no',
        'card_owner_name',
    ];

    public function sale(){
        return $this->hasMany(SaleDetails::class, 'sale_id');
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }



//    public function sale_detail(){
//        return $this->hasMany(SaleDetails::class);
//    }
//    public function sale_deta(){
//        return $this->sale_details()->groupBy('sale_id')->sum('sale_details.qty');
//    }


}
