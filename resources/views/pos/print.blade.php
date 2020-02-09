<!DOCTYPE html>
<html>
<head>
    <title>Invoice PDF DOM Laravel</title>
</head>
<body >
<div id="wapper" style="display:none">

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
                  
                    <li><strong>Invoice:</strong> #INVCI455</li>
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
       <tbody id="receipt-products">
                   
       </tbody>
    </table>


    <table id="product-receipt-preview-print-calculate" style=" position:relative; width: 100%; ">
        <tbody style="float: right;margin-top:10%;width:40%;margin-bottom: 2rem;">
            
        </tbody>
    </table>

    <table style=" position: absolute; bottom: 0; left: 50%; transform: translate(-50%, -50%);">
        <td style="text-align:center">&copy; Civilized Tecnologies</td>
    </table>

</div>
</body>
</html>