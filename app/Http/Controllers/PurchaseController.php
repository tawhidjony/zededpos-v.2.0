<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonDb;
use App\Http\Traits\ResponseMessage;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Models\PurchasesProduct;
use App\Models\Transaction;

class PurchaseController extends Controller
{
    use ResponseMessage,CommonDb;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('purchases.module_page');
    }
    public function index()
    {
        $purchase= PurchasesProduct::orderBy('id', 'desc')->paginate(10);
        return view('purchases.index',compact('purchase'));
    }
    //due Purchase index
    public function DueIndex()
    { 
        $purchase=Purchase::where('due', '>', 0)->paginate(10);
        return view('purchases.dues.due',compact('purchase'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $purchase= New Purchase();
        $suppliers = $this->suppliers();
        $products = $this->products();
        $product  = New Product();
        $categories = $this->categories();
        $sub_categories = $this->subCategories();
        $tag_sub_categories = $this->tagSubCategories();
        $brands = $this->brands();
        $models = $this->pro_models();
        $suppliers=$this->suppliers();
        $units = $this->units();

        return view ('purchases.create',compact('purchase','products', 'product','suppliers', 'categories','sub_categories','tag_sub_categories', 'brands','models','units'));
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
            'supplier_id'   => 'required',
            'voucher_code'  => 'required', 
            'total'         => 'required',
            'paid'          => 'required',  
            'due'          => 'nullable',  
        ]); 
        $data = $request->all();
        if(is_array($data['product']) && count($data['product']) > 0 ){
            $purchases = Purchase::create($data);
            $purchases->purchasesProduct()->createMany($data['product']);
            Transaction::create([
                'payment_from'      => 'stock',
                'payment_method'    => 'cash',
                'sell_stock_id'     => $purchases->id,
                'amount'            => $data['paid'],
            ]);
        }
        //dd($data);

        if ($purchases){
            return redirect()->Route('purchase.index')->with($this->create_success_message);
        }else{
            return redirect()->Route('purchase.create')->with($this->create_fail_message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase=PurchasesProduct::find($id);
        //dd($purchase->purchase->supplier->name);
        return view('purchases.show',compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchasepro = PurchasesProduct::find($id);
        // dd($purchasepro->purchase->voucher_code);
        return view('purchases.edit',compact('purchasepro'));
        // if($purchase) {
        //     $products = $this->products();
        //     $suppliers = $this->suppliers();
        //     return view('purchases.edit',compact('purchase','products','suppliers'));
        // }else{
        //     return back()->with($this->not_found_message);
        // }
    }

    public function DueEdit(Purchase $purchas)
    {
        if($purchas) {
            $products = $this->products();
            return view('purchases.dues.edit',compact('purchas','products'));
        }else{
            return back()->with($this->not_found_message);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => ['required'],
            'buy_price' => 'required',
            'sell_price' => 'required',
        ]);
      
            $data = $request->all();
            $purchasepro = PurchasesProduct::find($id);
            $purchase = $purchasepro->update($data);
            if ($purchase) {
                return redirect()->Route('purchase.index')->with($this->update_success_message);
            } else {
                return redirect('purchase')->with($this->update_fail_message);
            }
       
    }

    //Due purchase Update
    public function DueUpdate(Request $request, Purchase $purchase)
    {
        $request->validate([
            'supplier_id' => 'required',
            'product_id' => ['required'],
            'quantity' => ['required'],
            'alert_qty' => 'required',
            'buy_price' => 'required',
            'sell_price' => 'required',
        ]);
        if($purchase) {
            $data = $request->all();
            $purchase = $purchase->update($data);
            if ($purchase) {
                return redirect()->Route('purchase.index')->with($this->update_success_message);
            } else {
                return redirect('purchase')->with($this->update_fail_message);
            }
        }else{
            return redirect()->back()->withInput()->with($this->not_found_message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $purchase =PurchasesProduct::find($id);

        if ($purchase) {
            if(isset($purchase->photo))
                Storage::delete($purchase->photo);
            $purchase->delete();
            return redirect()->route('purchase.index')->with($this->delete_success_message);
        }else{
            return back()->with($this->not_found_message);
        }
    }
}
