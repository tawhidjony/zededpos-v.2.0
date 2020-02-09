<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'code_id',
        'name',
        'photo', 
        'alart_quantity',
        'description',
        'category_id',
        'sub_category_id',
        'tag_sub_category_id',
        'brand_id',
        'pro_model_id',
        'unit_id' 
    ];


    //
    public function purchase_product()
    {
        return $this->hasMany(PurchasesProduct::class);
    }
    //code
    public function code()
    {
        return $this->belongsTo(Code::class);
    }
    //category
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    //sub_category
    public function sub_category()
    {
        return $this->belongsTo(Sub_category::class);
    }
    //brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    //pro_model
    public function pro_model()
    {
        return $this->belongsTo(Pro_model::class);
    }
    //supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    //unit
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
