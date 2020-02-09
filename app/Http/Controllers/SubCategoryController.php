<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseMessage;
use App\Models\Sub_category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{ use ResponseMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_category=Sub_category::orderBy('id','desc')->paginate(10);
        return view('categories.sub_category.index',compact('sub_category'));
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
        'name' => 'required',
        'category_id' => 'nullable',
         ]);
        $data = $request->all();
        $sub_data = Sub_category::create($data);
        if ($sub_data){
            if (isset($data['sub_name']) && $data['sub_name'] == 'sub_cat_name'){
               return redirect()->route('sub_category.index')->with($this->create_success_message);
            }else{
                $allcat = Sub_category::all();
                return response()->json(['status'=>'success', 'allcat'=>$allcat]);
            }
        }else{
            return response()->json("error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function show(Sub_category $sub_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function edit(Sub_category $sub_category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sub_category $sub_category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sub_category  $sub_category
     * @return \Illuminate\Http\Response
     */
    public function destroy($sub_category)
    {
        $sub_categories= Sub_category::find($sub_category);

        if ($sub_categories) {
            $sub_categories->delete();
            return redirect()->route('sub_category.index')->with($this->delete_success_message);
        }else{
            return back()->with($this->not_found_message);
        }
    }
}
