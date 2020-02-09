<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Traits\ResponseMessage;
use App\Models\Invoice_setting;
use Illuminate\Support\Facades\Storage;
class InvoiceSettingController extends Controller
{
    use ResponseMessage;
    


    public function Invoiceedit($id)
    {
        $invoice=Invoice_setting::find($id);
        return view('invoice_setting', compact('invoice'));
    }

    public function invoice_update(Request $request, $id)
    {
    
        $data = $request->all();
        $invoice = Invoice_setting::find($id);
        if($invoice){
            $image = $request->file('shop_photo');
            if ($image) {
                $path = Storage::putFile('images/invoice',$image);

                if ($path) {
                    $data['shop_photo'] = $path;
                    if (isset($invoice->shop_photo)) {
                        Storage::delete($invoice->shop_photo);
                    }
                }
            }
            $invoice->update($data);
            return redirect()->back()->with($this->update_success_message);
        }else{
            return redirect()->back()->withInput()->with($this->create_fail_message);
        }
    }
}
