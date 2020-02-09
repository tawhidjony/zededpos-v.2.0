<?php

namespace App\Http\Controllers;

use App\Http\Traits\CommonDb;
use App\Http\Traits\ResponseMessage;
use App\Models\Purchase;
use Illuminate\Http\Request;
use DB;

class DuePurchaseController extends Controller
{   use ResponseMessage,CommonDb;


    //due Purchase index
    public function DueIndex()
    {
        $dueAmount =Purchase::leftJoin('transactions', 'purchases.id', '=', 'transactions.sell_stock_id')
            ->get();
          
        // $purchase=Purchase::where('due', '>', 0)->paginate(10);
       return view('purchases.dues.due',compact('dueAmount'));
    }

    //Due Purchase Edit
    public function DueEdit($id)
    {
        $edit_purchase=Purchase::leftJoin('transactions', 'purchases.id', '=', 'transactions.sell_stock_id')->find($id);
        if($edit_purchase) {
            $products = $this->products();
            return view('purchases.dues.edit',compact('edit_purchase','products'));
        }else{
            return back()->with($this->not_found_message);
        }
    }



    //Due purchase Update
    public function DueUpdate(Request $request, $id)
    {
        $request->validate([
            'supplier_id' => '->nullable',
            'product_id' => ['->nullable'],
            'quantity' => ['->nullable'],
            'alert_qty' => '->nullable',
            'buy_price' => '->nullable',
            'sell_price' => '->nullable',
        ]);

            $data = $request->all();
            $purchase=Purchase::find($id);
            $purchase->update($data);
            if ($purchase) {
                return redirect()->Route('purchase.due')->with($this->update_success_message);
            } else {
                return redirect('purchase')->with($this->update_fail_message);
            }

    }


}
