@extends('layouts.app')
@section('title','pos - ')
@push('css')
@endpush
@section('content')
    <div class="row">




    @if((auth()->user()->can('pos.create') || auth()->user()->can('sell.index') || auth()->user()->can('new_invoices.index') || auth()->user()->can('return.index') || auth()->user()->can('return.index')
    ) || auth()->user()->hasRole('super-admin'))
            <!-- start-->
            @if(auth()->user()->can('pos.create') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6 ">
                    <a href="{{route('pos.create')}}">
                        <div class="card-content card-no-padding">
                            <p>Point of sale</p>
                            <span class="bg-green"><i class="fas fa-cash-register"></i></span>
                        </div>
                    </a>
                </div>
            @endif
            <!-- End-->
            <!-- start-->
            @if(auth()->user()->can('sell.index') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6 ">
                    <a href="{{route('sell.index')}}">
                        <div class="card-content card-no-padding">
                            <p>All Invoice</p>
                            <span class="bg-red"><i class="fas fa-receipt"></i></span>
                        </div>
                    </a>
                </div>
            @endif
            <!-- End-->
{{--            <!-- start-->--}}
{{--            @if(auth()->user()->can('new_invoices.index') || auth()->user()->hasRole('super-admin'))--}}
{{--                <div class="col-xl-3 col-md-6 ">--}}
{{--                    <a href="{{route('new_invoices.index')}}">--}}
{{--                        <div class="card-content card-no-padding">--}}
{{--                            <p>Add New Invoice</p>--}}
{{--                            <span class="bg-green"><i class="fas fa-pen-square"></i></span>--}}
{{--                        </div>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            @endif--}}
{{--            <!-- End-->--}}
            <!-- start-->
            @if(auth()->user()->can('return.index') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6 ">
                    <a href="{{route('return.index')}}">
                        <div class="card-content card-no-padding">
                            <p>Return Product</p>
                            <span class="bg-red"><i class="fas fa-pen-square"></i></span>
                        </div>
                    </a>
                </div>
            @endif
            <!-- End-->

        @endif
    </div>
    <hr/>

@endsection
@push('js')

@endpush
