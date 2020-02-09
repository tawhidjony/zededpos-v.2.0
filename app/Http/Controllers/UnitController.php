<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseMessage;
use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    use ResponseMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_unit=Unit::orderBy('id','desc')->paginate(10);
        return view('products.product_units.index',compact('product_unit'));
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
        $request->validate([
            'name' => 'required|unique:units|max:255',
        ]);
        $data = $request->all();
        $Unit_data =Unit::create($data);
        if ($Unit_data){
            if (isset($data['unit_name']) && $data['unit_name'] == 'pro_unit'){
                return redirect()->route('units.index')->with($this->create_success_message);
            }else{
                $allUnit = Unit::all();
                return response()->json(['status'=>'success', 'allUnit'=>$allUnit]);
            }
        }else{
            return response()->json("error");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product_unit =Unit::find($id);

        if ($product_unit) {
            $product_unit->delete();
            return redirect()->route('units.index')->with($this->delete_success_message);
        }else{
            return back()->with($this->not_found_message);
        }
    }
}
