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
            <div class="col-md-5" >
                <div class="card pos_card">
                    <div class="card-header pos_header">
                        <h4 class="text-center">
                            <span><i class="btn btn-default fa fa-shopping-cart pull-left"></i></span>
                            <b > Point of Sale</b>
                            <a href=""><span><i class="btn btn-info fa fa-users pull-right"></i></span></a>
                        </h4>
                    </div>
                    <form id="usersForm" action="#" method="post" enctype="multipart/form-data">
                        <div class="card-body pl-1 pr-0 pb-0 pt-0">
                            @csrf
                            @include('pos.form')

                        </div>
                        <div class="card-footer pos_footer">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>Total: <span class="pull-right">1000.00 TK </span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p>Discount: <span class="pull-right">10 % </span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p>Grand Total: <span class="pull-right">100000.00 TK </span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p>Return Amount: <span class="pull-right">50000.00 </span></p>
                                </div>
                                <div class="col-sm-6">
                                    <p>
                                        <select name="" id="" class="form-control">
                                            <option value="">Cash</option>
                                            <option value="">Check</option>
                                            <option value="">Master Card</option>
                                        </select>
                                    </p>
                                </div>
                                <div class="col-sm-6">
                                    <p> <input type="number" class="form-control" placeholder="Pay Amount"></p>
                                </div>

                            </div>
                            <button class="btn btn-dark w-100">Payment</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--pos product category-->
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body product_category_pos">
                        <div class="owl-carousel owl-theme">
                            <a href="{{route('pos.create')}}" class="pos_slider_category_hover">
                                <div class="item">
                                    <div class="pos_category">
                                        <p class="text-center pos_c_padding">ALl</p>
                                    </div>
                                </div>
                            </a>
                            @foreach($categories2 as $pos_category)
                                <a href="{{url('category-products/'.$pos_category->id)}}" class="pos_slider_category_hover">
                                    <div class="item">
                                        <div class="pos_category">
                                            <p class="text-center pos_c_padding">{{$pos_category->name}}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                        <div class="row mt-4 pos_product_scroll" id="zeded_pos_ctg">
                                @foreach($all_category_product as  $product_category)
                                    <!--start-->
                                        <div class="col-sm-3">
                                            <a href="#" class="A_color">
                                                <div class="card">
                                                    <img class="pos_product_img" src="{{URL::to('public/images/'.$product_category->purchase->photo)}}" alt="">
                                                    <span class="text-center pos_product_font" data-toggle="tooltip" title="{{$product_category->name}}">{{str_limit($product_category->name,'10')}}</span>
                                                </div>
                                            </a>
                                        </div>
                                        <!--End-->
                                    @endforeach

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>
@endsection
@push('js')
    <script src="{{asset('assets/owlcarousel/owl.carousel.min.js')}}"></script>


    <script type="text/javascript">
        $('.owl-carousel').owlCarousel({
            loop:true,
            dots: false,
            margin:10,
            nav:false,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:5
                }
            }
        })
    </script>
@endpush