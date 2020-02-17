<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonDb;
use App\Http\Traits\ResponseMessage;
use App\Models\PurchasesProduct;
use App\Models\ReturnProduct;
use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DB;
class ReturnProductController extends Controller
{
    use CommonDb, ResponseMessage;
    //Return Product Index
    Public function HomeIndex(){
        $return_P=ReturnProduct::orderBy('id','desc')->paginate(10);
        return view('pos.return_product.index',compact('return_P'));

    }

    //Return Product Index
    Public function edit(Request $request){
        
       $order_id = $request->all()['sale_id'];

        // $categories = $this->categories();

        // $all_pos_product=PurchasesProduct::get();

        // $all_pos_product = DB::select("select `products`.*, `purchases_products`.`sell_price`, (SELECT SUM(purchases_products.quantity) FROM purchases_products 
        // WHERE purchases_products.product_id = products.id
        // GROUP BY products.id) as tqty, (SELECT SUM(sale_details.qty) FROM sale_details
        // WHERE sale_details.product_id = products.id
        // GROUP BY products.id) as sqty from purchases_products, products group by `products`.`id`");

        $return_product_edit  = DB::select("SELECT sd.id, p.name,p.photo,sd.qty,sd.price, sd.sale_id, s.total
                                                  FROM products as p 
                                                  INNER JOIN sale_details as sd on p.id = sd.product_id AND sd.sale_id=$order_id
                                                  INNER JOIN sales as s on s.id = sd.sale_id"
                                                );




        return view('pos.return_product.create',compact('return_product_edit'));
    }

    //Return Product New Invoice create
    public function ReturnStore(Request $request){
     try{
         
        $data = $request->all();
        dd($data);
        $products = $data['products'];

        $t= count($products);
      
        for($i=1; $i<=$t; $i++){
            $sd=SaleDetails::where('sale_id',$data['sale_id'])->where('product_id',$products[$i]['product_id'])->decrement('qty',$products[$i]['qty']);
        } 
        
        $invoice_sale = ReturnProduct::create($data);
        $invoice_sale->return_products()->createMany($data['products']);
        return redirect()->route('return.index')->with($this->create_old_invoice_message);
     }
     catch(Exception $ex){
        return $ex;
    }

    }


        //get Product Details
        public function getReturnProductDetails(Request $request){

           

            $return_product_edit  = DB::select("SELECT sd.id, p.name,p.photo,sd.qty,sd.price, sd.sale_id, s.total, s.price
            FROM products as p 
            INNER JOIN sale_details as sd on p.id = sd.product_id AND sd.sale_id=$order_id
            INNER JOIN sales as s on s.id = sd.sale_id"
            );

            return $return_product_edit;
        }
    
}
