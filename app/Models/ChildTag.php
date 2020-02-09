<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class ChildTag extends Model
{
    use SoftDeletes;
    protected $fillable=[
        'name',
        'sub_category_id',
    ];

    public function sub_category()
    {
        return $this->belongsTo(Sub_category::class,'sub_category_id');
    }
}
