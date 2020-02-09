<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonDb;
use App\Http\Traits\ResponseMessage;
use App\Models\PurchasesProduct;
use App\Models\ReturnProduct;
use App\Models\Sale;
use Illuminate\Http\Request;

class ReturnProductController extends Controller
{
    use CommonDb,ResponseMessage;
    //Return Product Index
    Public function HomeIndex(){
        $return_P=ReturnProduct::orderBy('id','desc')->paginate(10);
        return view('pos.return_product.index',compact('return_P'));

    }

    //Return Product Index
    Public function edit(Request $request){
        $order_id = $request->all()['order_id'];
        $categories = $this->categories();
        $all_pos_product=PurchasesProduct::get();
        $return_product_edit=Sale::find($order_id);
        return view('pos.return_product.create',compact('return_product_edit','categories','all_pos_product'));
    }

    //Return Product New Invoice create
    public function ReturnStore(Request $request){
        $data = $request->all();
        $invoice_sale = ReturnProduct::create($data);
        $invoice_sale->return_products()->createMany($data['products']);
        return redirect()->route('return.index')->with($this->create_old_invoice_message);


    }
}
