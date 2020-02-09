@extends('layouts.app')
@section('title','Report - ')
@push('css')
@endpush
@section('content')
<div class="card-area">
    <div class="row">
        @if((auth()->user()->can('sale.report') || auth()->user()->can('purchase.report')) ||auth()->user()->can('due.report') || 
        auth()->user()->can('customer.report') || auth()->user()->can('supplier.report') || auth()->user()->hasRole('super-admin'))
            <!-- start-->
            @if(auth()->user()->can('sale.report') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6 ">
                    <a href="{{route('sale.report')}}">
                        <div class="card-content card-no-padding">
                            <p>Sale Report </p>
                            <span class="bg-green"> <img class="report-img" src="{{asset('assets/new-theme/images/report_icn/sale_report.png')}}" alt=""></i></span>
                        </div>
                    </a>
                </div>
            @endif
            <!-- End-->

            <!-- start-->
            @if(auth()->user()->can('purchase.report') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6 ">
                    <a href="{{route('purchase.report')}}">
                        <div class="card-content card-no-padding">
                            <p>Purchase Report </p>
                            <span class="bg-red"><i class="fas fa-shopping-bag"></i></span>
                        </div>
                    </a>
                </div>
            @endif
             <!-- End-->

            <!-- start-->
            @if(auth()->user()->can('due.report') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6 ">
                    <a href="{{route('due.report')}}">
                        <div class="card-content card-no-padding">
                            <p>Due Report </p>
                            <span class="bg-dark"><i class="fas fa-pen-square"></i></span>
                        </div>
                    </a>
                </div>
            @endif
            <!-- End-->
            <!-- start-->
            @if(auth()->user()->can('customer.report') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6 ">
                    <a href="{{route('customer.report')}}">
                        <div class="card-content card-no-padding">
                            <p>Customer Report </p>
                            <span class="bg-green"><i class="fas fa-users"></i></span>
                        </div>
                    </a>
                </div>
            @endif
            <!-- End-->
            <!-- start-->
            @if(auth()->user()->can('supplier.report') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6 ">
                    <a href="{{route('supplier.report')}}">
                        <div class="card-content card-no-padding">
                            <p>Supplier Report </p>
                            <span class="bg-red"><i class="fas fa-truck"></i></span>
                        </div>
                    </a>
                </div>
            @endif
            <!-- End-->

        @endif
    </div>
</div>

@endsection
@push('js')

@endpush
