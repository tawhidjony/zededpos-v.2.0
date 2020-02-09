<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleDetails;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    { 
        //Today Sale Amount
        $startOfMonth   = Carbon::now()->startOfMonth()->format('Y-m-d');
        $endOfMonth     = Carbon::now()->endOfMonth()->format('Y-m-d');
        
        $chartData = Sale::select('created_at', DB::raw('sum(grand_total) as ctotal '))
        ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
        ->groupBy('created_at')->get();
        
        $newData = array();
        foreach ( $chartData as $item ) {
            $obj = new \stdClass;
            $obj->t = $item->created_at->format('F d Y');
            $obj->y = $item->ctotal;
            $newData[] = $obj; 
        } 
        $chartData = $newData;
        // dd($chartData);
        
        $today      = Carbon::now()->format('Y-m-d');
        $todayDate  = Sale::whereDate('created_at', '=', $today)->sum('pay_amount');

        //Current month Amount
        $currentMonth = date('m');
        $thisMonth = DB::table("sales")
            ->whereRaw('MONTH(created_at) = ?',[$currentMonth])
            ->sum('pay_amount');

        //Daily Sale Quantity
        $todaySaledate = Carbon::now()->format('Y-m-d');
        $todaySaleQty = SaleDetails::whereDate('created_at', '=', $todaySaledate)->sum('qty');

        //Total Member
        $totalMember=Customer::count();

        $alartProducts = DB::table(DB::raw('products, purchases_products, sale_details'))
            ->select(array(
                "products.*",
                "purchases_products.sell_price",
                DB::raw("(SELECT SUM(purchases_products.quantity) FROM purchases_products 
                            WHERE purchases_products.product_id = products.id
                            GROUP BY products.id) as tqty, (SELECT SUM(sale_details.qty) FROM sale_details
                            WHERE sale_details.product_id = products.id
                            GROUP BY products.id) as sqty") 
                
            )) 
            ->groupBy('products.id')
            ->get(); 
            
            $alartProducts = $alartProducts->filter(function ($value, $key) {
                $tqty = $value->tqty;
                $sqty = !empty($value->sqty) ? $value->sqty : 0;
                $avQty = $tqty - $sqty;
                if($avQty <= $value->alart_quantity ){
                    $value->avQty = $avQty;
                    return $value;
                }  
            });

        return view('dashboard',compact( 'todayDate','thisMonth','todaySaleQty','totalMember', 'alartProducts', 'chartData'));
    }
}
