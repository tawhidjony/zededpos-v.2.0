<!DOCTYPE html>
<html>
<head>
    <title>Invoice PDF DOM Laravel</title>
</head>
<body onload="window.print();window.close();">
<div id="wapper" >

    <table style="width:100%">
        <tr >
            <td style="width:70%">
                @php
                    $shop_address=DB::table('invoice_settings')->get();
                @endphp
                @foreach($shop_address as $row)
                    <img class="logo" src="{{asset($row->shop_photo)}}" style="width:100px; height:70px; margin-left:2rem">
                @endforeach
            </td>
            <td style="width:30%">
                <ul class="invoice-info" style="list-style-type: none;">

                    <li><strong>Invoice:</strong> #INVID{{$allShow_invoice->id}}</li>
                    <li><strong>Payment Date:</strong><?php
                        date_default_timezone_set("Asia/Dhaka");
                        echo date("d-m-Y g:i A ");
                        ?></li>

                </ul>
            </td>
        </tr>
        <tr class="address-row">
            <td>
                <ul style="list-style-type: none;">
                    @php
                        $shop_address=DB::table('invoice_settings')->get();
                    @endphp
                    @foreach($shop_address as $row)
                    @endforeach
                    <li><strong>From : </strong></li>
                    <li>{{isset($row->shop_name) ? $row->shop_name:''}}</li>
                    <li>{{isset($row->shop_address) ? $row->shop_address:''}}</li>
                    <li>Phone: {{isset($row->shop_phone) ? $row->shop_phone:''}}</li>
                    <li>Email: {{isset($row->shop_email) ? $row->shop_email:''}}</li>
                </ul>
            </td>
            <td>
                <ul class="address-to" style="list-style-type: none;">
                    <li><strong>TO : </strong></li>
                    <li>Customer Name</li>
                    <li>Adress</li>
                    <li>Phone: </li>
                    <li>Email: </li>
                </ul>
            </td>
        </tr>
    </table>

    <table id="product-receipt-preview-print" style="width:100%">
        <thead>
            <tr style=" width: 100%; background: darkgoldenrod; ">
                <th style=" text-align: left; padding-left: 1%; width: 40%; ">Name</th>
                <th style=" text-align: left; padding-left: 1%; width: 25%; ">Quantity</th>
                <th style=" text-align: left; padding-left: 1%; width: 25%; ">Price</th>
                <th style=" text-align: left; padding-left: 1%; width: 25%; ">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($allShow_invoice->sale as $key=> $row)

            <tr>
                <td>{{ ($row->product->name) }} </td>
                <td>{{ ($row->qty) }} </td>
                <td> {{ ($row->price) }} </td>
                <td> {{ ($row->subtotal) }} </td>
            </tr>
            @endforeach
        </tbody>
    </table>


    <table id="product-receipt-preview-print-calculate" style=" position:relative; width: 100%; ">
        <tbody style="float: right;margin-top:10%;width:40%;margin-bottom: 2rem;">


        <tr>
            <th style=" text-align: left; padding-left: 1%; width: 15%;">Total:</th>
            <td style=" text-align: left; padding-left: 1%; width: 15%;">{{$allShow_invoice->total}}</td>
        </tr>
        <tr>
            <th style=" text-align: left; padding-left: 1%; width: 15%;">Discount</th>
            <td style=" text-align: left; padding-left: 1%; width: 15%;"> {{$allShow_invoice->discount}} %</td>
        </tr>
{{--        <tr>--}}
{{--            <th style=" text-align: left; padding-left: 1%; width: 15%;">Total VAT +</th>--}}
{{--            <td style=" text-align: left; padding-left: 1%; width: 15%;"> %</td>--}}
{{--        </tr>--}}
        <tr>
            <th style=" text-align: left; padding-left: 1%; width: 15%;">Total VAT Amount</th>
            <td style=" text-align: left; padding-left: 1%; width: 15%;"> {{$allShow_invoice->vat_amount}}</td>
        </tr>
        <tr>
            <th style=" text-align: left; padding-left: 1%; width: 15%;">Grand Total:</th>
            <td style=" text-align: left; padding-left: 1%; width: 15%;"> {{$allShow_invoice->grand_total}}</td>
        </tr>
        <tr>
            <th style=" text-align: left; padding-left: 1%; width: 15%;">Payment Amount:</th>
            <td style=" text-align: left; padding-left: 1%; width: 15%;"> {{$allShow_invoice->pay_amount}}</td>
        </tr>
        <tr>
            <th style=" text-align: left; padding-left: 1%; width: 15%;">Return Amount:</th>
            <td style=" text-align: left; padding-left: 1%; width: 15%;">{{$allShow_invoice->return_amount}}</td>
        </tr>
        <tr>
            <th style=" text-align: left; padding-left: 1%; width: 15%;">Due Amount:</th>
            <td style=" text-align: left; padding-left: 1%; width: 15%;">{{$allShow_invoice->due_amount}}</td>
        </tr>
        </tbody>
    </table>

    <table style=" position: absolute; bottom: 0; left: 50%; transform: translate(-50%, -50%);">
        <td style="text-align:center">&copy; Civilized Tecnologies</td>
    </table>

</div>
</body>
</html>
