<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
   protected $fillable=[
       'employee_name',
       'product_name',
       'quantity',
       'price',
   ];
}
