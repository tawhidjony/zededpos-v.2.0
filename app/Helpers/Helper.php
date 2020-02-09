<?php
if (!function_exists('get_settings')) {
    function get_settings($settingdata, $key){
        if( is_a($settingdata, 'Illuminate\Database\Eloquent\Collection') && !empty($key)){ 
            $row = $settingdata->firstWhere('name', $key);
            if($row){
                return $row->value;
            } 
        } 
        return false;
    }
}