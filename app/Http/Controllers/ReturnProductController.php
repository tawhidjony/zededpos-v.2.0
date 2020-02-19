<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonDb;
use App\Http\Traits\ResponseMessage;
use App\Models\PurchasesProduct;
use App\Models\ReturnProduct;
use App\Models\Sale;
use App\Models\SaleDetails;
use Illuminate\Http\Request;
use DB;
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
        $all_pos_product=DB::table('sale_details')
                            ->join('products', 'products.id', '=', 'sale_details.product_id')
                            ->select('sale_details.*', 'products.photo', 'products.name')
                            ->where('sale_id', $order_id)
                            ->get();
        $return_product_edit=Sale::find($order_id);
        return view('pos.return_product.create',compact('return_product_edit','all_pos_product'));
    }

    //Return Product New Invoice create
    public function ReturnStore(Request $request){
        $data = $request->all();
        $products = $data['products'];
        $product_keys = array_keys($products);
        foreach ($product_keys as $value){
            $sd = SaleDetails::where('sale_id', $data['sale_id'])
                ->where('product_id', $products[$value]['product_id']);
            $sd->decrement('qty',$products[$value]['qty']);
            $sd->decrement('subtotal',$products[$value]['subtotal']);

        }
        $sale_return = Sale::where('id', $data['id']);
        $sale_return->decrement('total',$data['total']);
        $sale_return->decrement('grand_total',$data['grand_total']);
        SaleDetails::where('qty', '=', '0')->delete();
        $invoice_sale = ReturnProduct::create($data);
        $invoice_sale->return_products()->createMany($data['products']);
        return redirect()->route('return.index')->with($this->create_old_invoice_message);
    }
}
