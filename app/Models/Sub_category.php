<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
class Sub_category extends Model
{
    // use SoftDeletes;
    protected $fillable=[
        'name',
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
