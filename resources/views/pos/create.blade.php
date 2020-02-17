    @extends('layouts.app')
    @section('title','pos - ')
    @push('css')

    <link rel="stylesheet" href="{{asset('css/pos_custom_css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/owlcarousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/owlcarousel/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/select2/dist/css/select2.min.css')}}">
    <style>
    .load img{
        width:6%;
     }

    .load{
        
        display: none;
    }
    </style>
    @endpush
    @section('content')
  
    
    <section class="content pos_ui_top">
        <div class="row">
            <!-- Start POS Invoice-->
            <div class="col-md-6 pl-0 pr-0">
                <div class="card">
                    <div class="card-body product_category_pos">
                        <!--pos product Search Start-->
                        <div class="row">
                            <div class="col-sm-12 mb-3">

                                    <form action="{{url('/product-search')}}" method="get" id="pos-product-search-form">
                                        <div class="input-group">
                                         <input id="pos-product-search" type="text" placeholder="Search.." name="search" class="form-control" autocomplete="off" style=" border-radius: inherit !important; border-right: inherit !important;">
                                         <span class="input-group-append">
                                            <div class="input-group-text bg-transparent"><i class="fa fa-spinner fa-pulse load"></i></div>
                                        </span>
                                        </div>

                                    </form>
                            </div>
                        </div>
                        <!--pos product Search End-->

                        <!--pos product category Start-->
                        <div class="owl-carousel owl-theme product_category_slider ">
                               @include('pos.product_category')
                        </div>
                        <div class="owl-carousel owl-theme mt-2 sub_cat_slider">
                        </div>
                
                        <!--pos product category End-->

                        <!--pos All product Start-->
                        <div class="row mt-4 pos_product_scroll" id="zeded_pos_ctg">
                           
                            @foreach ($all_pos_product as $all_product)

                                @if($all_product->photo)
                                    <!--start-->
                                    <div class="col-lg-3 ">
                                        <a href="" class="productLink" data-id="{{$all_product->id}}">
                                            <div class="card">

                                                <img class="pos_product_img product-image-qty" src="{{URL::to($all_product->photo)}}" alt="">
                                                <span class="badge badge-light total-qty ">{{($all_product->tqty)-($all_product->sqty)}}</span>
                                                <span class="text-center pos_product_font" data-toggle="tooltip"
                                                    title="{{$all_product->name}}">{{str_limit($all_product->name,'8')}}</span>
                                            </div>
                                        </a>
                                    </div>
                                    <!--End-->
                                @else
                                    <!--start-->
                                    <div class="col-lg-3 ">
                                        <a href="" class="productLink" data-id="{{$all_product->id}}">
                                            <div class="card">
                                                <img class="pos_product_img product-image-qty" src="{{URL::to('defaultimg/product-thumb.png')}}" alt="">
                                                <span class="badge badge-light total-qty ">{{($all_product->tqty)-($all_product->sqty)}}</span>
                                                <span class="text-center pos_product_font" data-toggle="tooltip"
                                                    title="{{$all_product->name}}">{{str_limit($all_product->name,'8')}}</span>
                                            </div>
                                        </a>
                                    </div>
                                    <!--End-->
                                @endif
                            @endforeach

                        </div>
                        <!--pos All product End-->
                    </div>
                </div>
            </div>
            <div class="col-md-6" >
                    <div class="card pos_card">
                        <form id="usersForm" action="{{route('product.sell')}}" method="post" enctype="multipart/form-data">
                            <!-- Walk in customer section Start-->
                            <div class="card-header pos_header">
                                <div class="row">
                                 <div class="col-sm-2">
                                    
                                 </div>
                                 <div class="col-sm-8 select2-pos">
                                     <select name="customer_id" id="" class="form-control" placeholder="Choose one thing" data-allow-clear="1">
                                         <option value="0">Walk-in Customer</option>
                                         @php
                                            $data=DB::table('customers')->get();
                                         @endphp
                                         @foreach($data as $customerid)
                                            <option value="{{$customerid->id}}">{{$customerid->name}} </option>
                                         @endforeach
                                     </select>
                                 </div>
                                 <div class="col-sm-2">
                               
                                 </div>
                             </div>
                            </div>
                            <!-- Walk in customer section End-->
    
                            <!-- pos product section Start-->
                            <div class="card-body pl-1 pr-0 pb-0 pt-0">
                                    @csrf
                                    @include('pos.form')
                            </div>
                            <!-- pos product section End-->
    
                            <!-- pos footer section Start-->
                            <div class="card-footer pos_footer">
                                <div class="row" id="get_all_cal">
                                    <!-- start -->
                                    <div class="col-sm-6">
                                        <span><b>Total :</b></span>
                                        <input type="text" name="total" class="pull-right form-control total mb-2"
                                            readonly placeholder="0.00" >
                                    </div>
                                    <!-- End -->
                                    <!-- Start -->
                                    <div class="col-sm-6">
                                        <span><b>Discount :</b></span>
                                        <input type="text" name="discount" class="form-control discunt mb-2" value=""
                                            placeholder="0 %" >
                                    </div>
                                    <!-- End -->
                                    <!-- Start -->
                                    <div class="col-sm-6">
                                        <span><b>Grand Total :</b></span>
                                        <input type="text" name="grand_total" class="pull-right form-control grand-totla
                                            " readonly placeholder=" 0.00 " >
                                    </div>
                                    <!-- End -->
                                    <!-- Start -->
                                    <div class="col-sm-6">
                                        <span class=" mt-2"><b>Return Amount :</b></span>
                                        <input type="text" name="return_amount" class="pull-right form-control return-amount" readonly placeholder=" 0.00">
                                     
                                        <input type="text" name="due_amount" class="pull-right form-control due-amount" readonly placeholder="due 0.00">
                                    
                                        <!-- due -->
                                    </div>
                                    <!-- End -->
                                    <!-- Start -->
                                    <div class="col-sm-6">
                                        <span><b>Total Vat: ({{get_settings($settingdata, 'vat')}} %)</b></span>
                                        <input type="hidden" value="{{get_settings($settingdata, 'vat')}}" class="pull-right form-control vat_value" name="vat" >
                                        <input type="text" name="vat_amount" value="" class="pull-right form-control vat-total" readonly placeholder=" 0.00">
                                    </div>
                                    <!-- End -->
                                    <!-- Start -->
                                    <div class="col-sm-6 select2-pos select2-pos-cash">
                                        <select required name="pay_method" class="form-control mt-2 {{ $errors->has('pay_method') ? ' is-invalid' : '' }}"
                                            id="PaymentMethods" placeholder="Choose one thing" data-allow-clear="1">
                                            <option value="cash">Cash</option>
                                            <option value="check">Check</option>
                                            <option value="debit_credit">Debit Credit</option>
                                        </select>
                                        @if ($errors->has('pay_method'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('pay_method') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                     <!-- End -->
                                    <div class="col-sm-6">
                                        <input type="number" name="pay_amount" class="form-control payamount mt-2 " placeholder="Pay Amount" required>
                                    </div>
                                    <div class="col-sm-6">
                                       
                                    </div>
                                  
                                </div>
                                <!-- card payment method -->
                                <div class="row" id="ShowPaymentFiled"></div>
                                <div class="row">
                                    {{-- <div class="col-sm-6">
                                            <button type="submit" class="btn btn-dark w-100 mt-2">Payment with Receipt</button>
                                    </div> --}}
                                    <div class="col-sm-12">
                                        <input type="submit" onclick='printDiv();' class="btn btn-dark w-100 mt-2" name="withoutprint" value="Payment">
                                    </div>
                                    
                                    @include('pos.print')
                                </div>
                            
                            </div>
                            <!-- pos footer section End-->



                        </form>
                    </div>
                </div>
                <!-- End POS Invoice-->
             <!-- Start POS Product-->
           
            <!-- End POS Product-->

            
        </div>
    </section>


    @endsection
    @push('js')
        
    <script>
        function printDiv() {
            updateReceiptPreview();
            var divToPrint = document.getElementById('wapper');
            var newWin = window.open('', '');
            newWin.document.open();
            newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
            newWin.document.close();
            setTimeout(function() {
                newWin.close();
            }, 10);
        }

        function updateReceiptPreview(){
            const products = $('#receipt-editor .products-list');
            const updated_value = []
            products.each(function(index, elem){
                let value = {} 
                const product = $(this)
                const id        = product.get(0).id
                const name     = product.children().text()
                const price    = product.find('.price').val() 
                const quantity = product.find('.qty').val()   
                const subtotal = product.find('.subtotal').val()                                       
                value = {                         
                    id,
                    name,
                    price,
                    quantity,
                    subtotal                        
                }
                
                updated_value.push(value)
            })
            
            let html_print=``;
            updated_value.forEach(product => {                
                html_print += `<tr style=" width: 100%;" id="product-${product.id}"> 
                                        <td style=" text-align: left; padding-left: 1%; width: 40%;">${product.name}</td >
                                        <td style=" text-align: left; padding-left: 1%; width: 20%;">${product.quantity}</td> 
                                        <td style=" text-align: left; padding-left: 1%; width: 20%;">${product.price}</td> 
                                        <td style=" text-align: left; padding-left: 1%; width: 20%;">${product.subtotal}</td>                                            
                                </tr>` 
            });
                                             
            if(html_print != ''){
                $('#product-receipt-preview-print tbody').append(html_print);
            }

            const products2 = $('#get_all_cal');

            const total_amount       = products2.find('.total').val()
            const grand_total        = products2.find('.grand-totla').val()
            const discunt            = products2.find('.discunt').val()
            const return_amount      = products2.find('.return-amount').val()
            const vat_value          = products2.find('.vat_value').val()
            const vat_total          = products2.find('.vat-total').val()
            const payamount          = products2.find('.payamount').val()
            const due_amount         = products2.find('.due-amount').val()

            let html_print_calculate = ``;               
                html_print_calculate += `
                <tr>
                    <th style=" text-align: left; padding-left: 1%; width: 15%;">Total:</th>
                    <td style=" text-align: left; padding-left: 1%; width: 15%;">${total_amount}</td>
                </tr>
                <tr>
                    <th style=" text-align: left; padding-left: 1%; width: 15%;">Discount</th>
                    <td style=" text-align: left; padding-left: 1%; width: 15%;"> ${discunt} %</td>
                </tr>
                <tr>
                    <th style=" text-align: left; padding-left: 1%; width: 15%;">Total VAT +</th>
                    <td style=" text-align: left; padding-left: 1%; width: 15%;"> ${vat_value} %</td>
                </tr>
                <tr>
                    <th style=" text-align: left; padding-left: 1%; width: 15%;">Total VAT Amount</th>
                    <td style=" text-align: left; padding-left: 1%; width: 15%;"> ${vat_total}</td>
                </tr>
                <tr>
                    <th style=" text-align: left; padding-left: 1%; width: 15%;">Grand Total:</th>
                    <td style=" text-align: left; padding-left: 1%; width: 15%;"> ${grand_total}</td>
                </tr>
                <tr>
                    <th style=" text-align: left; padding-left: 1%; width: 15%;">Payment Amount:</th>
                    <td style=" text-align: left; padding-left: 1%; width: 15%;"> ${payamount}</td>
                </tr>
                <tr>
                    <th style=" text-align: left; padding-left: 1%; width: 15%;">Return Amount:</th>
                    <td style=" text-align: left; padding-left: 1%; width: 15%;">${return_amount}</td>
                </tr>
                <tr>
                    <th style=" text-align: left; padding-left: 1%; width: 15%;">Due Amount:</th>
                    <td style=" text-align: left; padding-left: 1%; width: 15%;">${due_amount}</td>
                </tr>` 
                                             
            if(html_print_calculate != ''){
                $('#product-receipt-preview-print-calculate tbody').append(html_print_calculate);
            }

        }


    </script>

    <script type="text/javascript">
        var ajaxUrls = {
            catbyproductUrl : "{{url('/products/category')}}",
            subcatbyproductUrl : "{{url('/products/subcategory')}}",
            checkQtyUrl : "{{url('/products/quantitycheck')}}",
            checkPriceUrl : "{{url('/products/pricecheck')}}",
            productDetailsUrl : "{{url('/products/details')}}",
            productSearchsUrl : "{{url('/product-search')}}",
        }
    </script>
    <script src="{{asset('assets/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/create_pos.js')}}"></script>
    <script src="{{asset('assets/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script>
    $(document).ready(function(){
  
        $('select').each(function () {
            $(this).select2({
            theme: 'bootstrap4',
            width: 'style',
            placeholder: $(this).attr('placeholder'),
            allowClear: Boolean($(this).data('walking-customer')),
            });
        });

    });
    </script>
@endpush