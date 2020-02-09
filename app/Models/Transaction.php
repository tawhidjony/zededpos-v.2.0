<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable=[
        'payment_from',
        'payment_method',
        'sell_stock_id',
        'amount' 
    ];
}
