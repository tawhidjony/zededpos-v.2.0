<?php

namespace App\Http\Controllers;

use App\Http\Traits\ResponseMessage;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    use ResponseMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function category()
    {
        return view('categories.module_page');
    }

    public function index()
    {
        $category=Category::orderBy('id','desc')->paginate(10);
        return view('categories.category.index',compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
        ]);

        $data = $request->all();
        $catData = Category::create($data);

        if ($catData){
            if(isset($data['name_cat']) && $data['name_cat'] == 'category_nam' ){
                return redirect()->route('category.index')->with($this->create_success_message);
            }else {
                $allcat = Category::all();
                return response()->json(['status' => 'success', 'allcat' => $allcat]);
            }
        }else{
            return response()->json("error");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function Editt(Category $category)
    {
        $id= $category->id;
        $data=Category::find($id);
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Category::find($id);

        if ($customer) {
            $customer->delete();
            return redirect()->route('category.index')->with($this->delete_success_message);
        }else{
            return back()->with($this->not_found_message);
        }
    }
}
