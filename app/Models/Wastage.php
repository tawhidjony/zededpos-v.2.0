<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wastage extends Model
{
    protected $fillable=[
        'name',
        'code',
        'quantity',
        'price',
    ];
}
