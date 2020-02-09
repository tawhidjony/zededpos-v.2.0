<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseMessage;
use App\Models\Pro_model;
use Illuminate\Http\Request;

class ProModelController extends Controller
{ use ResponseMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pro_models=Pro_model::orderBy('id','desc')->paginate(10);
        return view('categories.pro_model.index',compact('pro_models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $model_data = Pro_model::create($data);
        if ($model_data){
            if (isset($data['model_name']) && $data['model_name'] == 'new_model' ){
                return redirect()->route('pro_models.index')->with($this->create_success_message);
            }else{
                $allBModal = Pro_model::all();
                return response()->json(['status'=>'success', 'allBModal'=>$allBModal]);
            }
        }else{
            return response()->json("error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pro_model  $pro_model
     * @return \Illuminate\Http\Response
     */
    public function show(Pro_model $pro_model)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pro_model  $pro_model
     * @return \Illuminate\Http\Response
     */
    public function edit(Pro_model $pro_model)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pro_model  $pro_model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pro_model $pro_model)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pro_model  $pro_model
     * @return \Illuminate\Http\Response
     */
    public function destroy($pro_model)
    {
        $pro_models =Pro_model::find($pro_model);

        if ($pro_models) {
            $pro_models->delete();
            return redirect()->route('pro_models.index')->with($this->delete_success_message);
        }else{
            return back()->with($this->not_found_message);
        }
    }
}
