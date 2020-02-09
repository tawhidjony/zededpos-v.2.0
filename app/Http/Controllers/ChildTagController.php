<?php

namespace App\Http\Controllers;

use App\Models\ChildTag;
use Illuminate\Http\Request;
use App\Http\Traits\ResponseMessage;

class ChildTagController extends Controller
{
    use ResponseMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag_sub_category=ChildTag::orderBy('id','desc')->paginate(10);
        return view('categories.child_sub_category.index',compact('tag_sub_category'));
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
        // $request->validate([
        //     'name' => 'required',
        //     'category_id' => 'nullable',
        //      ]);
            $data = $request->all();
            $tagsub_data = ChildTag::create($data);
            if ($tagsub_data){
                if (isset($data['tag_sub_name']) && $data['tag_sub_name'] == 'tag_sub_cat_name'){
                   return redirect()->route('chilTag.index')->with($this->create_success_message);
                }else{
                    $alltagcat = ChildTag::all();
                    return response()->json(['status'=>'success', 'alltagcat'=>$alltagcat]);
                }
            }else{
                return response()->json("error");
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChildTag  $childTag
     * @return \Illuminate\Http\Response
     */
    public function show(ChildTag $childTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChildTag  $childTag
     * @return \Illuminate\Http\Response
     */
    public function edit(ChildTag $childTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChildTag  $childTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChildTag $childTag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChildTag  $childTag
     * @return \Illuminate\Http\Response
     */
    public function destroy($childTag)
    {
        $tag_sub_categories=ChildTag::find($childTag);

        if ($tag_sub_categories) {
            $tag_sub_categories->delete();
            return redirect()->route('chilTag.index')->with($this->delete_success_message);
        }else{
            return back()->with($this->not_found_message);
        }
    }
}
