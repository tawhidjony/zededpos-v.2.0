@extends('layouts.app')
@section('title','product - ')
@push('css')
@endpush
@section('content')

<div class="card-area">
    <div class="row">

        <!--Product Start-->
        @if((auth()->user()->can('products.create') || auth()->user()->can('products.index')) || auth()->user()->hasRole('super-admin'))
            <!-- start -->
            @if(auth()->user()->can('products.create') || auth()->user()->hasRole('super-admin'))
            <div class="col-xl-3 col-md-6">
                <a href="{{route('products.create')}}">
                    <div class="card-content card-no-padding">
                        <p>Add Item</p>
                        <span class="bg-green"><i class="fas fa-pen-square"></i></span>
                    </div>
                </a>
            </div>
            @endif
            <!-- start -->
            @if(auth()->user()->can('products.index') || auth()->user()->hasRole('super-admin'))
            <div class="col-xl-3 col-md-6">
                <a href="{{route('products.index')}}" class="">
                    <div class="card-content card-no-padding">
                        <p>All Items</p>
                        <span class="bg-red"><i class="fas fa-list-alt"></i></span>
                    </div>
                </a>
            </div>
            @endif
            <!-- end -->
        @endif
        <!--Product End-->

        <!--Product unit Start-->
        @if((auth()->user()->can('units.create') || auth()->user()->can('units.index')) || auth()->user()->hasRole('super-admin'))
            <!-- Start -->
            @if(auth()->user()->can('units.create') || auth()->user()->hasRole('super-admin'))
            <div class="col-xl-3 col-md-6">
                <a href="#" data-toggle="modal" data-target="#ProductUnit">
                    <div class="card-content card-no-padding">
                        <p>Add Product unit</p>
                        <span class="bg-green"><i class="fas fa-pen-square"></i></span>
                    </div>
                </a>
            </div>
            @endif
            <!--End-->

            <!--Start-->
            @if(auth()->user()->can('units.index') || auth()->user()->hasRole('super-admin'))
            <div class="col-xl-3 col-md-6">
                <a href="{{route('units.index')}}">
                    <div class="card-content card-no-padding">
                        <p>All Item unit</p>
                        <span class="bg-red"><i class="fas fa-list-alt"></i></span>
                    </div>
                </a>
            </div>
            @endif
            <!--End-->
        @endif
        <!--Product unit End-->

         <!--Product Supplier Start-->
        @if((auth()->user()->can('suppliers.create') || auth()->user()->can('suppliers.index')) || auth()->user()->hasRole('super-admin'))
            <!-- Start -->
            @if(auth()->user()->can('suppliers.create') || auth()->user()->hasRole('super-admin'))
            <div class="col-xl-3 col-md-6">
                <a href="#" data-toggle="modal" data-target="#SupplierModal">
                    <div class="card-content card-no-padding">
                        <p>Add Item Supplier</p>
                        <span class="bg-green"><i class="fas fa-user"></i></span>
                    </div>
                </a>
            </div>
            @endif
            <!--End-->

            <!--Start-->
            @if(auth()->user()->can('suppliers.index') || auth()->user()->hasRole('super-admin'))
            <div class="col-xl-3 col-md-6">
                <a href="{{route('suppliers.index')}}" class="">
                    <div class="card-content card-no-padding">
                        <p>All Item Supplier</p>
                        <span class="bg-red"><i class="fas fa-users"></i></span>
                    </div>
                </a>
            </div>
            @endif
            <!-- End -->
        @endif
        <!-- All Product Supplier End-->
    </div>
</div>

    @include('products.product_units.unit_form')
    @include('products.product_suppliers.form')
@endsection
@push('js')
    <script src="{{asset('js/purchases.js')}}"></script>
@endpush
