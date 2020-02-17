<?php

namespace App\Http\Controllers;


use App\Http\Traits\CommonDb;
use App\Http\Traits\ResponseMessage;
use App\Models\Product;
use App\Models\PurchasesProduct;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\SaleDetails;
use App\Models\Invoice_setting;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Mike42\Escpos\Printer; 
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use DB;
class PosController extends Controller
{   use CommonDb,ResponseMessage;

    //Module Component Page Pos
    public function home(){
        return view ('pos.module_page');
    }

    // Product Create page
    public function Create(){
        $categories = $this->categories();
        $subCategories = $this->subCategories();

        $all_pos_product = DB::select("select `products`.*, `purchases_products`.`sell_price`, (SELECT SUM(purchases_products.quantity) FROM purchases_products 
                            WHERE purchases_products.product_id = products.id
                            GROUP BY products.id) as tqty, (SELECT SUM(sale_details.qty) FROM sale_details
                            WHERE sale_details.product_id = products.id
                            GROUP BY products.id) as sqty from purchases_products, products group by `products`.`id`");
        return view ('pos.create',compact('categories','all_pos_product','subCategories'));

    }

    //All Product & Category product Show
    public function allPorduct(Request $request){
        $data = [];
        $subcats = null;
        $all_pos_product = null;
        $cat_id= (int)$request->cat_id;
        if($request->cat_id != '*') {
            $all_pos_product = PurchasesProduct::groupBy('product_id')->get();
            foreach ($all_pos_product as $singelProduct) {
                $searchProduct = $singelProduct->product()->where('category_id', '=', $cat_id)->get();

                if(count($searchProduct) > 0){
                    $product = $searchProduct->first();
                    $data[$product->id] = [
                        'id'    => $product->id,
                        'name'  => $product->name,
                    ];
                    if(!empty($product->photo)){
                        $data[$product->id]['photo'] = asset($product->photo);
                    }else{
                        $data[$product->id]['photo'] = asset('/defaultimg/product-thumb.png');
                    }
                }

            }
        }else{
            $all_pos_product = PurchasesProduct::groupBy('product_id')->get();
            foreach ($all_pos_product as $product) {
                $data[$product->id] = [
                    'id'    => $product->product_id,
                    'name'  => $product->product()->first()->name,
                ];
                if(!empty($product->product()->first()->photo)){
                    $data[$product->id]['photo'] = asset($product->product()->first()->photo);
                }else{
                    $data[$product->id]['photo'] = asset('/defaultimg/product-thumb.jpg');
                }
            }
        }

        if($cat_id){
            $subcats = $this->subCategoriesByParentID($cat_id);
        }
        return ['products'=> $data, 'subcats'=>$subcats];
    }

    //All Product & Subategory product Show
    public function subcatPorduct(Request $request){
        $data = [];
        $all_pos_product = null;
        $subcat_id= (int)$request->subcat_id;
        if($request->$subcat_id != '*') {
            $all_pos_product = PurchasesProduct::all();
            foreach ($all_pos_product as $singelProduct) {
                $searchProduct = $singelProduct->product()->where('sub_category_id', '=', $subcat_id)->get();

                if(count($searchProduct) > 0){
                    $product = $searchProduct->first();
                    $data[$product->id] = [
                        'id'    => $product->id,
                        'name'  => $product->name,
                    ];
                    if(!empty($product->photo)){
                        $data[$product->id]['photo'] = asset($product->photo);
                    }else{
                        $data[$product->id]['photo'] = asset('/defaultimg/product-thumb.jpg');
                    }
                }

            }
        }
        return $data;
    }

    //get Product Details
    public function getProductDetails(Request $request){
        $data = [];

        $product_id= (int)$request->product_id;
        
        if( !empty($product_id)) {
            $productData  = PurchasesProduct::where('product_id', $product_id)->first();
            if($productData) {
                $product = $productData->product()->first();
                $data = $product;
                $data['purchase'] = $productData;
            }
        }
        return $data;
    }

    // Product Quantity Check
    public function quantityCheck(Request $request){
        $data = [];
        $product_id= (int)$request->product_id;

        if( !empty($product_id)) {
            $productData  = PurchasesProduct::where('product_id', '=', $product_id)->select(DB::raw("SUM(quantity) as tquantity"))->groupBy('product_id')->first();
            $sellProduct  = SaleDetails::where('product_id', '=', $product_id)->select(DB::raw("SUM(qty) as squantity"))->groupBy('product_id')->first();
            
            
            if($productData) {
                $totalQty = $productData->tquantity;
                $sellQty  = !empty($sellProduct) ? $sellProduct->squantity : 0; 
                $avaiableQty = $totalQty - $sellQty; 
                $data['total_qty'] = $avaiableQty;
            }

            
        }
        return $data;
    }
    //Product Price Check
    public function PriceCheck(Request $request){
        $data = [];
        $product_id= (int)$request->product_id;

        if( !empty($product_id)) {
            $productData  = PurchasesProduct::where('product_id', '=', $product_id)->first();
            if($productData) {
                $data['sell_price'] = $productData->sell_price;
            }
        }
        return $data;
    }
    //all Sell
    public function allSell(){
        $allSell_invoice=Sale::all();
        return view('pos.index',compact('allSell_invoice'));
    }

    //Sell Store
    public function sale(Request $request){
        $request->validate([
            'pay_method' => 'required',
        ]);

        $data =$request->all();
        $sell = $product_sale = Sale::create($data);
        $sellProduct = $product_sale->sale()->createMany($data['products']);
        if ($sell && $sellProduct){
            if( !isset($data['withoutprint']) ){
                $invoicepos = Invoice_setting::all();  
                $this->posPrint($data,$invoicepos);
            }

            return redirect()->back()->with($this->create_success_message);
        }else{
            return redirect()->back()->with($this->create_success_message);
        }
    }

    //show invoice
    public function showInvoice($id){
        $allShow_invoice=Sale::find($id);
        return view('pos.show',compact('allShow_invoice'));
    }

    //PDF Ivoice
    public function PdfInvoice($id){
        $allShow_invoice=Sale::find($id);
        //dd($allShow_invoice->customer);
        $pdf = PDF::loadView('pos.pdf', array('allShow_invoice'=> $allShow_invoice ));

        return $pdf->download('invoice.pdf');
       //return $pdf->stream();
    }

    //Pos Product Search
    public function getProductByNameKeyword(Request $request){
        $responceData = [];
        $srData=$request->get('search');
        
        if(!empty($srData)){
            $products_name = DB::select("SELECT purchases_products.*, sell_price, products.name AS name, products.photo AS photo, categories.name AS cat_name, sub_categories.name AS 
            subcat_name, child_tags.name AS child_tag_name, 
            (SELECT SUM(purchases_products.quantity) FROM purchases_products
                WHERE purchases_products.product_id = products.id
                GROUP BY products.id) as total_product_qty,
            (SELECT SUM(sale_details.qty) FROM sale_details
                WHERE sale_details.product_id = products.id
                GROUP BY products.id) as total_sell_qty
            FROM purchases_products 
            LEFT JOIN products ON products.id = purchases_products.product_id  
            LEFT JOIN categories ON categories.id = products.category_id 
            LEFT JOIN sub_categories ON sub_categories.id = products.sub_category_id 
            LEFT JOIN child_tags ON child_tags.id = products.tag_sub_category_id  

            WHERE products.name LIKE '%$srData%' OR categories.name LIKE '%$srData%' OR sub_categories.name LIKE '%$srData%' OR child_tags.name LIKE '%$srData%' 
            GROUP BY purchases_products.product_id");
        }else{
            $products_name = DB::select("SELECT purchases_products.*, sell_price, products.name AS name, products.photo AS photo, categories.name AS cat_name, sub_categories.name 
            AS subcat_name, child_tags.name AS child_tag_name,
            (SELECT SUM(purchases_products.quantity) FROM purchases_products
                WHERE purchases_products.product_id = products.id
                GROUP BY products.id) as total_product_qty,
            (SELECT SUM(sale_details.qty) FROM sale_details
                WHERE sale_details.product_id = products.id
                GROUP BY products.id) as total_sell_qty
            FROM purchases_products
            LEFT JOIN products ON products.id = purchases_products.product_id
            LEFT JOIN categories ON categories.id = products.category_id
            LEFT JOIN sub_categories ON sub_categories.id = products.sub_category_id
            LEFT JOIN child_tags ON child_tags.id = products.tag_sub_category_id 
            GROUP BY purchases_products.product_id");
        }
        return response()->json($products_name);
     
    }

    public function deleteSell($id)
    {
        $all_Sale = Sale::find($id);

        if ($all_Sale) {
            $all_Sale->delete();
            return redirect()->route('sell.index')->with($this->delete_success_message);
        }else{
            return back()->with($this->not_found_message);
        }
    }

    private function addPreSpaces($string = '', $valid_string_length = 11) {
        $tlen = strlen($string);
        $pspac = $valid_string_length - $tlen;
        $nstring = '';
        for($i= 1; $i<= $pspac; $i++){
            $nstring .=' ';
        }
        $string = (string)$string;
        $nstring = $nstring.$string;
        return $nstring;
    } 

    private function addSpaces($string = '', $valid_string_length = 0) {
        if (strlen($string) < $valid_string_length) {
            $spaces = $valid_string_length - strlen($string);
            for ($index1 = 1; $index1 <= $spaces; $index1++) {
                $string = $string . ' ';
            }
        }
    
        return $string;
    } 

    private function posPrint($data,$invoicepos){

        $connector = new WindowsPrintConnector("RONGTA RPP300 Series Printer");
        $printer = new Printer($connector);

        $products = $data["products"]; 
       
        
        $printer->setJustification(Printer::JUSTIFY_CENTER); 
        /* Name of shop */
        $printer -> selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
        $shopName = $invoicepos->first()->shop_name;
        $printer -> text("$shopName.\n");
        $printer -> feed(1);
        $printer -> selectPrintMode();
        $shopAddress = $invoicepos->first()->shop_address;
        $shopEmail = $invoicepos->first()->shop_email;
        $shopPhone = $invoicepos->first()->shop_phone;
        $printer -> text("Address: $shopAddress\n");
        $printer -> text("Email: $shopEmail \n");
        $printer -> text("Phone: $shopPhone \n");
        $printer -> feed();

        /* Title of receipt */
        $printer -> setEmphasis(true);
        $printer -> text("SALES INVOICE\n");
        $printer -> text("-------------\n");
        $printer -> setEmphasis(false);
        $printer -> feed();

        /*Item of receipt */ 
        $printer->text($this->addSpaces('SL', 5).$this->addSpaces('Name', 28).$this->addSpaces('QTY',7).$this->addSpaces('Price', 10)."  \n"); 
        $printer -> setJustification(Printer::JUSTIFY_LEFT);
        $singleLine = '';
        $i = 1;
        foreach($products as $item){
            $item["product_name"] = $item["product_name"];
            if(strlen($item["product_name"]) < 30){
                $singleLine = $this->addSpaces((string)$i, 4).$this->addSpaces($item["product_name"], 30).$this->addSpaces($item["qty"], 5).$this->addSpaces($item["price"], 10);
                $singleLine = (string)$singleLine."\n"; 
                $printer->text( $singleLine );
            }else{
                $name = substr($item["product_name"], 0, 28);
                $singleLine = $this->addSpaces((string)$i, 5).$this->addSpaces($name, 30).$this->addSpaces($item["qty"], 5).$this->addSpaces($item["price"], 10);
                // $singleLine = (string)$singleLine."\n"; 
                $singleLine = (string)$singleLine; 
                $nextName   = substr($item["product_name"], 28);
                $singleLine = $singleLine.$this->addSpaces('', 5).$nextName."\n"; 
                $printer->text( $singleLine ); 
                $printer -> feed();
            }  
           $i++;
        }  
        $printer->text("------------------------------------------------");
        $subtotal   =    "                  Subtotal      :".$this->addPreSpaces($data['total'])."\n";
        $vat        =    "                  Vat           :".$this->addPreSpaces($data['vat'].'%')."\n";
        $discount   =    "                  Discount      :".$this->addPreSpaces($data['discount'])."\n";
        $total      =    "                  Total         :".$this->addPreSpaces($data['grand_total'])."\n";
        $payAm      =    "                  Pay Amount    :".$this->addPreSpaces($data['pay_amount'])."\n";
        $retAm      =    "                  Return Amount :".$this->addPreSpaces($data['return_amount'])."\n";
        $printer -> setEmphasis(true);
        $printer -> text($subtotal);
        $printer -> text($vat);
        $printer -> text($discount);
        $printer -> text($total);
        $printer -> text($payAm);
        $printer -> text($retAm);
        $printer -> setEmphasis(false);
        
        /* Footer */
        $printer -> feed(2);
        $printer -> setJustification(Printer::JUSTIFY_CENTER);
        $printer -> text("Thank you for shopping at Bike Solution\n");
        $printer -> text("For trading hours, please visit bikesolution.com\n");
        $printer -> feed(2);
        $date =  Carbon::now()->format("h:i:s d-m-Y");
        $time = date("d-m-Y g:i A ", strtotime($date));
        $printer -> text($time . "\n");
        $printer -> feed(1);
        $printer -> text("Developed by www.civilizedtechnologies.com\n");
        $printer -> feed(1);
        // $printer->setEmphasis(true);
        $printer->cut();
        $printer->close();
    }






}
