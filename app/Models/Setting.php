<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'name','value',
    ];

    static public function getValue($key){
        if($key){
            $val = self::where('name', $key)->first();
            if($val){
                return isset($val->value) ? $val->value : '';
            }
        }  
        return false;
    }

}
