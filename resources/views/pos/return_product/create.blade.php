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
                            @foreach ($all_pos_product as $all_product)
                                <!--start-->
                                <div class="col-lg-3 ">
                                    <a href="" class="productLink" data-id="{{$all_product->product_id}}">
                                        <div class="card">
                                            <img class="pos_product_img" src="{{URL::to($all_product->photo)}}" alt="">
                                            <span class="badge badge-light total-qty ">{{$all_product->qty}}</span>
                                            <span class="text-center pos_product_font" data-toggle="tooltip"
                                                  title="{{$all_product->name}}">{{str_limit($all_product->name,'8')}}</span>
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
                                <div class="col-sm-8">
                                    <select name="customer_id" id="" class="form-control">
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
                                @csrf
                                @include('pos.return_product.form')
                        </div>
                        <!-- pos product section End-->

                        <!-- pos footer section Start-->
                        <div class="card-footer pos_footer">
                            <div class="row">
                                <!-- Total -->
                                <div class="col-sm-6">
                                    <span><b>Total :</b></span>
                                    <input type="text" name="total" class="pull-right form-control total
                                    mb-2" value="{{$return_product_edit->total}}" readonly >
                                </div>
                                <!-- Total -->
                                <!-- Discount -->
                                <div class="col-sm-6">
                                    <span><b>Discount :</b></span>
                                    <input type="text" name="discount" class="form-control{{ $errors->has('discount') ? ' is-invalid' : '' }} discunt mb-2"
                                            value="{{$return_product_edit->discount}}" placeholder="Discount">
                                    @if ($errors->has('discount'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('discount') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <!-- Discount -->

                                <!--Grand Total-->
                                <div class="col-sm-6">
                                    <span><b>Grand Total :</b></span>
                                    <input type="text" name="grand_total" class="pull-right form-control
                                    grand-totla" value="{{$return_product_edit->grand_total}}" readonly >
                                    </div>
                                <!--Grand Total End-->

                                <!--return_amount  -->
                                <div class="col-sm-6">
                                    <span class=" mt-2"><b>Return Amount :</b></span>
                                    <input type="text" name="return_amount" class="pull-right form-control
                                    return-amount" value="{{$return_product_edit->return_amount}}" readonly >
                                </div>
                                <!--return_amount  -->

                                <!--due amount  -->
                                <div class="col-sm-6">
                                    <span class=" mt-2"><b>Due Amount :</b></span>
                                    <input type="text" name="due_amount" class="pull-right form-control current-due" value="{{$return_product_edit->due_amount}}" readonly >

                                    <input type="text"  hidden="" class="pull-right form-control
                                    due-amount" value="{{$return_product_edit->due_amount}}" readonly>
                                </div>
                                <!--due amount  -->



{{--                                <!--extra_payment start-->--}}
{{--                                <div class="col-sm-12">--}}
{{--                                    <input type="text"  class="pull-right form-control due-amount mt-2"--}}
{{--                                           name="due_amount" value="" readonly placeholder="Extra Payment">--}}
{{--                                </div>--}}
{{--                                <!--extra_payment End-->--}}

                                <div class="col-sm-6">
                                    <select required name="pay_method" class="form-control mt-2 {{ $errors->has('pay_method') ? ' is-invalid' : '' }}"
                                            id="PaymentMethods">
                                        <option readonly="" value="">Select Payment Methods</option>
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

{{--                                <div class="col-sm-6">--}}
{{--                                    <input type="number" name="pay_amount" class="form-control payamount mt-2" value="{{$return_product_edit->pay_amount}}">--}}
{{--                                </div>--}}


                                 <input type="number" style="display: none" name="sale_id"  value="{{$return_product_edit->id}}">
                                 <input type="number" style="display: none" name="id"  value="{{$return_product_edit->id}}">


                            </div>

                            <div class="row" id="ShowPaymentFiled"></div>
                            <button class="btn btn-dark w-100 mt-2">Payment</button>



                            <!--Grand Total 2 start-->
{{--                            <div class="col-sm-6">--}}
{{--                                <input type="text" --}}{{--style="display: none"--}}{{-- class="pull-right form-control--}}
{{--                                    grand-totla-two" value="{{$return_product_edit->grand_total}}" readonly >--}}
{{--                            </div>--}}
                            <!--Grand Total 2 End-->

                        </div>
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
            productDetailsUrl : '{{url('/products/details')}}',
            productSearchsUrl : '{{url('/product-search')}}'
        }
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
    <!--Form Validatin Script-->
    <script src="{{asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('assets/owlcarousel/owl.carousel.min.js')}}"></script>
    <script src="{{asset('js/return_product/return_product_pos.js')}}"></script>
    <script src="{{asset('assets/select2/dist/js/select2.full.min.js')}}"></script>


@endpush
