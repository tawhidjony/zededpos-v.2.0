@extends('layouts.app')
@section('title','Product Return - ')
@push('css')

    <link rel="stylesheet" href="{{asset('css/pos_custom_css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/owlcarousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/owlcarousel/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/select2/dist/css/select2.min.css')}}">
@endpush
@section('content')

    <section class="content">

        <div class="row">
            <!--Return Invoice   -->
            <div class="col-md-6 pl-0 pr-0">
                <div class="card">
                    <div class="card-body product_category_pos" style="height: 694px !important;">
                       

                     

                        <!--pos All product Start-->
                        <div class="row mt-4 pos_product_scroll" id="zeded_pos_ctg">
                         <?php $i=0 ?>
                            @foreach ($return_product_edit  as $all_product)
                                  <?php $i++ ?>
                                <div class="col-lg-3 ">
                                    <a id="{{$i}}" class="productLink" data-id="{{$all_product->id}}" onclick="returnProducts(this)">
                                            <div class="card">
                                                <p id="rp-price-{{$i}}" style="display:none">{{$all_product->price}}</p>
                                                <img class="pos_product_img" src="{{URL::to($all_product->photo? $all_product->photo : 'defaultimg/product-thumb.png')}}" alt="">
                                                <span id= "rp-qty-{{$i}}"class="badge badge-light total-qty ">{{($all_product->qty)}}</span>
                                                <span id= "rp-name-{{$i}}" class="text-center pos_product_font" data-toggle="tooltip"
                                                    title="{{$all_product->name}}">{{str_limit($all_product->name,'8')}}</span>
                                            </div>
                                        </a>
                                </div>
                             
                            @endforeach

                        </div>
                        <!--pos All product End-->
                    </div>
                </div>
            </div>
            <!--Return Invoice   -->
             <!--Return Invoice   -->
             <div class="col-md-6" >
                <div class="card pos_card">
                    <form id="usersForm" action="{{url('/return-invoice')}}" method="POST"
                            enctype="multipart/form-data">
                        @csrf
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
                                        <option value="{{$customerid->id}}" @if($return_product_edit->customer_id &&
                                        $return_product_edit->customer_id == $customerid->id) selected @endif
                                        >{{$customerid->name}}
                                        </option>
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
                            @include('pos.return_product.form')
                        </div>
                        <!-- pos product section End-->

                        <!-- pos footer section Start-->
                        <div class="card-footer pos_footer">
                            <div class="row">

                                 <!--Start Total-->
                                <div class="col-sm-6">
                                    <span><b>Total :</b></span>
                                    <input type="text" name="total" class="pull-right form-control total mb-2" value="" readonly >
                                </div>
                                <!--End Total-->

                                <!-- Start Grand Total-->
                                <div class="col-sm-6">
                                    <span><b>Grand Total :</b></span>
                                    <input type="text" name="grand_total" class="pull-right form-control grand-totla" 
                                        value="" readonly >
                                    </div>
                                <!--End Grand Total -->
                                
                                <!-- Start Return Amount-->
                                <div class="col-sm-6">
                                    <span class=" mt-2"><b>Return Amount :</b></span>
                                    <input type="text" name="return_amount" class="pull-right form-control
                                return-amount" value="0" readonly >
                                </div>
                                <!-- End Return Amount-->

                                <!-- start Due Amount-->
                                <div class="col-sm-6">
                                <span class=" mt-2"><b>Due Amount :</b></span>
                                <input type="text" name="due_amount" placeholder="Due"  class="pull-right form-control due-amount" value="0" readonly>
                                {{-- <input type="text" name="" class="pull-right form-control old-due-amount" placeholder="du" value="" readonly> --}}
                                </div>
                                <!-- End Due Amount-->

                              
                           


                                <div class="col-sm-6">
                                    <input type="number" name="pay_amount" class="form-control payamount mt-2" value="">
                                </div>

                                    {{-- <input type="number"  name="sale_id"  value=""> --}}


                            </div>
                            <div class="row" id="ShowPaymentFiled"></div>
                            <button class="btn btn-dark w-100 mt-2">Return Item Payment</button>
                            <input type="number"  name="sale_id"  value="{{$all_product->sale_id}}">
                        <!-- pos footer section End-->


                    </form>
                </div>
            </div>
            <!--Return Invoice   -->
            
        </div>
    </section>
@endsection
@push('js')
    <script type="text/javascript">
        var ajaxUrls = {
            catbyproductUrl : '{{url('/products/category')}}',
            subcatbyproductUrl : '{{url('/products/subcategory')}}',
            checkQtyUrl : '{{url('/products/quantitycheck')}}',
            checkPriceUrl : '{{url('/products/pricecheck')}}',

            returnProductDetailsUrl : '{{url('/return/products/details')}}',

            productSearchsUrl : '{{url('/product-search')}}'
        }
    </script>
    <!--Form Validatin Script-->
    <script src="{{asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    {{-- <script src="{{asset('assets/owlcarousel/owl.carousel.min.js')}}"></script> --}}
    <script src="{{asset('js/return_product/return_product_pos.js')}}"></script>
    <script src="{{asset('assets/select2/dist/js/select2.full.min.js')}}"></script>
    <script>

        $(document).ready(function () {

            // validate form on keyup and submit
            $("#storeForm").validate({
                rules: {
                    name: "required",
                },
                messages: {
                    name: "Please enter name",
                }
            });

        });
    </script>

@endpush