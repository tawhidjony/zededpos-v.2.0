<?php

namespace App\Http\Controllers;


use App\Http\Traits\ResponseMessage;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
class SettingController extends Controller
{

    use ResponseMessage;

    public function setting (){
        return view('settings_pages');
    }


    public function edit()
    {
       
        $setting = Setting::all();
        return view('settings', compact('setting'));
    }

    public function upload(Request $request, $key){
        $image = $request->file($key);
        if ($image) {
            $path = Storage::putFile('images/setting', $request->file($key));
            if ($path) { 
                $val = Setting::where('name', $key)->first();
                if (isset($val->value) && !empty($val->value)) {
                    Storage::delete($val->value);
                }
                return $path;
            }
        }
        return false;
    }


    public function update(Request $request)
    {
  

        $data = array();
        $data = $request->all(); 
        $keysArray = array('name', 'favicon', 'vat','currency');
        foreach($keysArray as $key){
            if(array_key_exists($key, $data)){
                if ($request->hasFile($key)) {
                    $src = $this->upload($request, 'favicon');
                    $this->singleKeyUpdate($key, $src);
                }else{
                    $value = $data[$key];
                    $this->singleKeyUpdate($key, $value);
                }
            }
        }   
        return Redirect()->back()->with($this->create_success_message);    
    }

    public function singleKeyUpdate($key, $value){
        if($key){
            $val = Setting::where('name', $key)->first();
            if($val){ 
                $val->value = $value;
                $val->save();
            }else{
                Setting::create(array(
                    'name' => $key,
                    'value' => $value
                ));
            }
        }
    }

}
