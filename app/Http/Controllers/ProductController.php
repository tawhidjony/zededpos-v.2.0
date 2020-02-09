<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonDb;
use App\Http\Traits\ResponseMessage;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use ResponseMessage,CommonDb;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product()
    {
        return view('products.module_page');
    }

    public function index()
    {
        $product=Product::orderBy('id','desc')->paginate(10);
        return view('products.index',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $product= New Product();
        $categories = $this->categories();
        $sub_categories = $this->subCategories();
        $brands = $this->brands();
        $models = $this->pro_models();
        $suppliers=$this->suppliers();
        $units = $this->units();

        return view('products.create',compact('product','categories','sub_categories'
            ,'suppliers','brands','models','units'));

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
            'code_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'nullable',
            'brand_id' => 'required',
            'pro_model_id' => 'nullable',
            'unit_id' => 'required',
        ]);
        
        try{
            $data = $request->all();

            $image = $request->file('photo');
            if ($image) {
                $path = Storage::putFile('images/products', $image);
                if ($path) {
                    $data['photo'] = $path;
                }
            }else{
                $path='';
            } 
            
            $newdata = Product::create($data);
            $products = Product::all();
            
            if(isset($data['requestType']) && $data['requestType'] == 'ajax' ){
                if ($data){ 
                    return response()->json(['status'=>'success', 'currentProduct'=>$newdata, 'allProduct'=>$products]);
                }else{ 
                    return response()->json(['status'=>'failed', 'allProduct'=>$products]);
                }
            }else{ 
                if ($data){  
                    return redirect()->Route('products.index')->with($this->create_success_message);
                }else{
                    return redirect()->Route('products.create')->with($this->create_fail_message);
                }
            }
        }catch (\Exception $exception){
            return response()->json(['status'=>'failed']);
            // Log::error($exception->getMessage());
            // return redirect()->back()->withInput()->with($this->create_fail_message);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::find($id);
        return view('products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if($product) {
            $categories = $this->categories();
            $sub_categories = $this->subCategories();
            $brands = $this->brands();
            $models = $this->pro_models();
            $suppliers=$this->suppliers();
            $units = $this->units();

            return view('products.edit',compact('product','categories','sub_categories'
                ,'suppliers','brands','models','units'));
        }else{
            return back()->with($this->not_found_message);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'code_id' => ['required'],
            'category_id' => ['required'],
            'brand_id' => 'required',
            'unit_id' => 'required',
        ]);
        try{
            if($product) {
                $data = $request->all();
                $image = $request->file('photo');
                if ($image) {
                    $path = Storage::putFile('images/products', $image);
                    if ($path) {
                        $data['photo'] = $path;
                        if (isset($product->photo)) {
                            Storage::delete($product->photo);
                        }
                    }
                }else{
                    $path='';
                }
                $product = $product->update($data);
                if ($product) {
                    return redirect('products')->with($this->update_success_message);
                } else {
                    return redirect('products')->with($this->update_fail_message);
                }
            }else{
                return redirect()->back()->withInput()->with($this->not_found_message);
            }
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return redirect()->back()->withInput()->with($this->update_fail_message);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product =Product::find($id);

        if ($product) {
            if(isset($product->photo))
                Storage::delete($product->photo);
            $product->delete();
            $product->purchase_product()->delete();
            
            return redirect()->route('products.index')->with($this->delete_success_message);
        }else{
            return back()->with($this->not_found_message);
        }
    }

    public function getEmptyProducts(){
        $products =Product::where('purchases_id', '=', null)->get();
        return $products;
    }
}
