<!DOCTYPE html>
<html>
<head>
    <title>Invoice PDF DOM Laravel</title>
    <style type="text/css">
        *,*::after,*::before {
            box-sizing: border-box;
        }
        html, body {
            margin: 0px;
            padding: 0px;
        }
        body {
            font-size: 14px;
            line-height: 20px;
        }
        #wapper{
            width: 100%;
            max-width: 100%;
            height: 100%;
            margin: auto;
            background-color: #E8EAED;
            padding: 0px 0px 0px 0px;
            position: relative;
            overflow: hidden;
        }

        ul {
            list-style: none;
            display: block;
            margin: 0px;
            padding: 0px;
        }
        table {
            width: 100%;
        }
        table tr td {
            width: 50%;
        }
        table.header {
            padding-top: 10px;
            padding-bottom: 10px;
            padding-left: 20px;
            padding-right: 20px;
        }
        .header .logo {
            width: 150px;
            display: block;
            margin-top: 10px;

        }
        ul.invoice-info{
            /* text-align: right; */
        }
        ul.invoice-info, ul.address-to {
            padding-left: 45%;
        }
        .address-row {
            border: 1px solid #000;
        }

        /* ------- */
        #InvoiceTable {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            font-size: 15px;
            margin-top: 20px;
        }
        #InvoiceTable th {
            text-align: center;
            padding: 8px;
        }

        #InvoiceTable td, #InvoiceTable th {
            text-align: center;
            padding:6px;
        }

        #InvoiceTable tr:nth-child(even){
            background-color: #f2f2f2;
        }

        #InvoiceTable tr:hover{
            background-color: #ddd;
        }

        #InvoiceTable th {
            text-align: center;
            padding-top: 12px;
            padding-bottom: 12px;
            background-color: #737477;
            color: white;
        }
        .NetAmountTable{
            border-collapse: collapse;
            width: 50%;
            float: right;
            margin-top:100px;
        }
        .NetAmountTable tr:nth-child(even){
            background-color: #f2f2f2;
        }
        .NetAmountTable tr td{
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            text-align: left;
        }
        .NetAmountTable tr th{
            text-align: left;
            padding: 6px 6px 5px 6px;
            line-height: 25px;
        }
        #TotalAmount{
            width: 100%;
            height: 200px;
            background: wheat;
        }
        #footersection {
            width:100%;
            background-color: #6D6E6A;
            color: white;
            text-align: center;
            position: absolute;
            bottom: 0px;
            left: 0px;
            right: 0px;
            width: 100%;
        }
        #footersection p{
            padding: 6px 6px 6px 6px;
            margin: 0px;
        }
    </style>
</head>
<body>
<div id="wapper">
    <table class="header">
        <tr>
            <td>
                @php
                    $shop_address=DB::table('invoice_settings')->get();
                @endphp
                @foreach($shop_address as $row)
                    <img class="logo" src="{{asset('public/images/'.$row->shop_photo)}}" style="width:100px; height:70px">
                @endforeach
               
            </td>
            <td>
                <ul class="invoice-info">
                    <li><strong>Invoice:</strong> #INVCI{{$allShow_invoice['id']}}</li>
                    <li><strong>Payment Date:</strong> {{ $allShow_invoice->created_at}}</li>

                </ul>
            </td>
        </tr>
        <tr class="address-row">
            <td>
                <ul>
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
                <ul class="address-to">
                    <li><strong>TO : </strong></li>
                    <li>{{isset($allShow_invoice->customer->name) ? $allShow_invoice->customer->name:'' }}</li>
                    <li>{{ isset($allShow_invoice->customer->address) ? $allShow_invoice->customer->address:''}}</li>
                    <li>Phone: {{ isset($allShow_invoice->customer->phone) ? $allShow_invoice->customer->phone:''}}</li>
                    <li>Email: {{ isset($allShow_invoice->customer->email) ? $allShow_invoice->customer->email:''}}</li>
                </ul>
            </td>
        </tr>
    </table>

    <table id="InvoiceTable">
        <tr>
            <th>#Serial</th>
            <th>Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
        </tr>
            @foreach($allShow_invoice->sale as $key => $invoice)
        <tr>
                <td> {{($key + 1) }}</td>
                <td> {{($invoice->product->name)}}</td>
                <td> {{($invoice->qty )}}</td>
                <td> {{($invoice->price )}}</td>
                <td> {{($invoice->subtotal )}}</td>
        </tr>
            @endforeach
    </table>
    <table class="NetAmountTable">
        <tr>
            <th>Total:</th>
            <td> {{ $allShow_invoice['total'] }}</td>
        </tr>
        <tr>
            <th>Discount</th>
            <td> {{ $allShow_invoice['discount'] }} %</td>
        </tr>
        <tr>
            <th>Total VAT +</th>
            <td> {{get_settings($settingdata, 'vat')}} %</td>
        </tr>
        <tr>
            <th>Total VAT Amount</th>
            <td> {{ $allShow_invoice['vat_amount'] }}</td>
        </tr>
        <tr>
            <th>Grand Total:</th>
            <td> {{ $allShow_invoice['grand_total'] }}</td>
        </tr>
        <tr>
            <th>Payment Amount:</th>
            <td> {{ $allShow_invoice['pay_amount'] }}</td>
        </tr>
        <tr>
            <th>Return Amount:</th>
            <td> {{ $allShow_invoice['return_amount'] }}</td>
        </tr>
        <tr>
            <th>Due Amount:</th>
            <td> {{ $allShow_invoice['due_amount'] }}</td>
        </tr>
    </table>
    <footer id="footersection">
        <p>&copy; Civilized Tecnology</p>
    </footer>

</div>
</body>
</html>