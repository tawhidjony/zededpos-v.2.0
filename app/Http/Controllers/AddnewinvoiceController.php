<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonDb;
use App\Http\Traits\ResponseMessage;
use App\Models\Invoice;
use App\Models\PurchasesProduct;
use App\Models\Sale;
use Illuminate\Http\Request;

class AddnewinvoiceController extends Controller
{
    use CommonDb, ResponseMessage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_new_invoice=Sale::all();
        return view('pos.new_invoices.index',compact('all_new_invoice'));
    }

    public function edit($id)
    {
        $categories = $this->categories();
        $all_pos_product=PurchasesProduct::get();
        $all_new_invoice_edit=Sale::find($id);
        return view('pos.new_invoices.create',compact('all_new_invoice_edit','categories','all_pos_product'));
    }

    public function NewInvoice( Request $request){
        $data =$request->all();
        $invoice_sale = Invoice::create($data);
        $invoice_sale->invoice()->createMany($data['products']);
        return redirect()->route('new_invoices.index')->with($this->create_old_invoice_message);

    }

    public function destroy($id)
    {
        //
    }
}
