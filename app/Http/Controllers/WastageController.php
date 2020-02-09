<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseMessage;
use App\Models\Wastage;
use Illuminate\Http\Request;

class WastageController extends Controller
{
    use ResponseMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function wastage()
    {
       return view('wastages.module_page');
    }
    //index
    public function index()
    {
        $wastage=Wastage::orderBy('id','desc')->paginate();
        return view('wastages.index',compact('wastage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wastage= New Wastage();
        return view('wastages.create',compact('wastage'));
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
            'name' => 'required',
            'code' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);
        $data = $request->all();
        $wastage = Wastage::create($data);
        if ($wastage){
            return redirect()->Route('wastages.index')->with($this->create_success_message);
        }else{
            return redirect()->Route('wastages.create')->withInput()->with($this->create_fail_message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Wastage  $wastage
     * @return \Illuminate\Http\Response
     */
    public function show($wastage)
    {
        $wastage=Wastage::find($wastage);
        return view('wastages.show',compact('wastage'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Wastage  $wastage
     * @return \Illuminate\Http\Response
     */
    public function edit($wastage)
    {
        $wastage=Wastage::find($wastage);
        return view('wastages.edit',compact('wastage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Wastage  $wastage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);
        $data = $request->all();
        $wastage = Wastage::find($id);
        $wastage->update($data);
        if ($wastage){
            return redirect()->Route('wastages.index')->with($this->create_success_message);
        }else{
            return redirect()->Route('wastages.create')->withInput()->with($this->create_fail_message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Wastage  $wastage
     * @return \Illuminate\Http\Response
     */
    public function destroy($wastage)
    {
        $wastage = Wastage::find($wastage);

        if ($wastage) {

            $wastage->delete();
            return redirect()->route('wastages.index')->with($this->delete_success_message);
        }else{
            return back()->with($this->not_found_message);
        }
    }
}
