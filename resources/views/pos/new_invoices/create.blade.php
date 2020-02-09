@extends('layouts.app')
@section('title','pos - ')
@push('css')

    <link rel="stylesheet" href="{{asset('css/pos_custom_css.css')}}">
    <link rel="stylesheet" href="{{asset('assets/owlcarousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/owlcarousel/owl.theme.default.min.css')}}">
@endpush
@section('content')

    <section class="content">

                <div class="row">
                    <div class="col-md-6" >
                        <div class="card pos_card">
                            <form id="usersForm" action="{{route('new.invoice')}}" method="post" enctype="multipart/form-data">
                                <!-- Walk in customer section Start-->
                                <div class="card-header pos_header">
                                    <div class="row">
                                     <div class="col-sm-2">
                                         <span><i class="btn btn-default fa fa-shopping-cart pull-left"></i></span>
                                     </div>
                                     <div class="col-sm-8">
                                         <select name="customer_id" id="" class="form-control">
                                             <option value="0">Walk-in Customer</option>
                                             @php
                                                $data=DB::table('customers')->get();
                                             @endphp
                                             @foreach($data as $customerid)
                                             <option value="{{$customerid->id}}" @if($all_new_invoice_edit->customer_id &&
                                             $all_new_invoice_edit->customer_id == $customerid->id) selected @endif
                                             >{{$customerid->name}}
                                             </option>
                                             @endforeach
                                         </select>
                                     </div>
                                     <div class="col-sm-2">
                                         <a href=""><span><i class="btn btn-info fa fa-users pull-right"></i></span></a>
                                     </div>
                                 </div>
                                </div>
                                <!-- Walk in customer section End-->

                                <!-- pos product section Start-->
                                <div class="card-body pl-1 pr-0 pb-0 pt-0">
                                        @csrf
                                        @include('pos.new_invoices.form')
                                </div>
                                <!-- pos product section End-->

                                <!-- pos footer section Start-->
                                <div class="card-footer pos_footer">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <span><b>Total :</b></span>
                                            <input type="text" name="total" class="pull-right form-control total
                                            mb-2" value="{{$all_new_invoice_edit->total}}" readonly >
                                        </div>
                                        <div class="col-sm-6">
                                            <span><b>Discount :</b></span>
                                            <input type="text" name="discount" class="form-control discunt mb-2"
                                                   value="{{$all_new_invoice_edit->discount}}" placeholder="Discount">
                                        </div>
                                        <div class="col-sm-6">
                                            <span><b>Grand Total :</b></span>
                                            <input type="text" name="grand_total" class="pull-right form-control
                                            grand-totla " value="{{$all_new_invoice_edit->grand_total}}" readonly >
                                          </div>
                                        <div class="col-sm-6">
                                            <span class=" mt-2"><b>Return Amount :</b></span>
                                            <input type="text" name="return_amount" class="pull-right form-control
                                            return-amount" value="{{$all_new_invoice_edit->return_amount}}" readonly >
                                        </div>
                                        <input type="text" name="due_amount" hidden="" class="pull-right form-control
                                         due-amount" value="due_amount" readonly>
                                        <div class="col-sm-6">

                                                    <select name="pay_method" class="form-control mt-2">
                                                        <option value="1">Cash</option>
                                                        <option value="2">Check</option>
                                                        <option value="3">Master Card</option>
                                                    </select>

                                        </div>
                                        <div class="col-sm-6">
                                           <input type="number" name="pay_amount" class="form-control payamount mt-2" value="{{$all_new_invoice_edit->pay_amount}}">
                                        </div>
                                           <input type="number" name="sale_id" style="display: none;"
                                                  value="{{$all_new_invoice_edit->id}}">

                                    </div>
                                    <button class="btn btn-dark w-100 mt-2">Payment</button>
                                </div>
                                <!-- pos footer section End-->
                            </form>
                        </div>
                    </div>


                    <div class="col-md-6 pl-0 pr-0">
                        <div class="card">
                            <div class="card-body product_category_pos">
                                <!--pos product Search Start-->
                                <div class="row">
                                    <div class="col-sm-12 mb-3">

                                            <form action="{{url('/product-search')}}" method="get" id="pos-product-search-form">
                                                <input id="pos-product-search" type="text" placeholder="Search.." name="search" class="form-control" autocomplete="off">
                                            </form>

                                    </div>
                                </div>
                                <!--pos product Search End-->

                                <!--pos product category Start-->
                                <div class="owl-carousel product_category_slider owl-theme">
                                    @include('pos.new_invoices.product_category')
                                </div>
                                <div class="owl-carousel owl-theme mt-2 sub_cat_slider">
                                </div>
                                <!--pos product category End-->

                                <!--pos All product Start-->
                                <div class="row mt-4 pos_product_scroll" id="zeded_pos_ctg">
                                    @foreach ($all_pos_product as $all_product)
                                        <!--start-->
                                        <div class="col-lg-3 ">
                                            <a href="" class="productLink" data-id="{{$all_product->product_id}}">
                                                <div class="card">
                                                    <img class="pos_product_img" src="{{URL::to('public/images/'.$all_product->product()->first()->photo)}}" alt="">
                                                    <span class="text-center pos_product_font" data-toggle="tooltip"
                                                          title="{{$all_product->product()->first()->name}}">{{str_limit($all_product->product()->first()->name,'8')}}</span>
                                                </div>
                                            </a>
                                        </div>
                                        <!--End-->
                                    @endforeach


                                </div>
                                <!--pos All product End-->
                            </div>
                        </div>
                    </div>


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
            productDetailsUrl : '{{url('/products/details')}}',
            productSearchsUrl : '{{url('/product-search')}}'
        }
    </script>
    <script src="{{asset('assets/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/create_pos.js')}}"></script>
@endpush