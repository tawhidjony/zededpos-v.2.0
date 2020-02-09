<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonDb;
use App\Models\Customer;
use App\Models\Purchase;
use App\Models\PurchasesProduct;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    use CommonDb;
    public function home(){
        return view('report.module_page');
    }



    public function saleReport(Request $request)
    {
             $sale_report = Sale::whereBetween('sales.updated_at', [
              date('Y-m-d', strtotime($request->input('start_date'))) . " 00:00:00",
              date('Y-m-d', strtotime($request->input('end_date'))) . " 23:59:59"])
              ->get();
        return view('report.sale',compact('sale_report'));
    }

    //purchase Report
    public function purchase(Request $request)
    {
        //$purchase_report_ = PurchasesProduct::latest()->get();
        //$date = Carbon::today();
//        $stats = PurchasesProduct::whereRaw('date(created_at) = ?', [Carbon::today()]);
//        dd($stats);
        $purchase_report = PurchasesProduct::whereBetween('purchases_products.updated_at', [
            date('Y-m-d', strtotime($request->input('start_date'))) . " 00:00:00",
            date('Y-m-d', strtotime($request->input('end_date'))) . " 23:59:59"])
            ->get();

        return view('report.purchase',compact('purchase_report','stats'));
    }
    //Due Report
    public function dueReport(Request $request)
    {
        $today = Carbon::today()->format('Y-m-d');
        $stats = Sale::whereDate('created_at', '=', $today)->get();
        $due_report = Sale::whereBetween('sales.updated_at', [
            date('Y-m-d', strtotime($request->input('start_date'))) . " 00:00:00",
            date('Y-m-d', strtotime($request->input('end_date'))) . " 23:59:59"])
            ->get();
        return view('report.due',compact('due_report','stats'));
    }

    //Customer Report
    public function customerReport(Request $request)
    {
        $today = Carbon::today()->format('Y-m-d');
        $todayDate = Sale::whereDate('created_at', '=', $today)->get();
        $customer_report = Sale::whereBetween('sales.updated_at', [
            date('Y-m-d', strtotime($request->input('start_date'))) . " 00:00:00",
            date('Y-m-d', strtotime($request->input('end_date'))) . " 23:59:59"])
            ->get();
        return view('report.customer',compact('customer_report','todayDate'));
    }

    //Supplier Report
    public function SupplierReport(Request $request)
    {
        $today = Carbon::today()->format('Y-m-d');
        $todayDate = PurchasesProduct::whereDate('created_at', '=', $today)->get();
        $supplier_report = PurchasesProduct::whereBetween('purchases_products.updated_at', [
            date('Y-m-d', strtotime($request->input('start_date'))) . " 00:00:00",
            date('Y-m-d', strtotime($request->input('end_date'))) . " 23:59:59"])
            ->get();
        return view('report.supplier',compact('supplier_report', 'todayDate'));
    }

}
