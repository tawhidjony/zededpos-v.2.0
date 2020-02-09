<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice_setting extends Model
{
    protected $fillable=[
        'shop_name',
        'shop_address',
        'shop_phone',
        'shop_email',
        'shop_photo',
    ];
}
