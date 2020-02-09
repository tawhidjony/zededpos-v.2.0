@extends('layouts.app')
@section('title','customer - ')
@push('css')
@endpush
@section('content')

@if((auth()->user()->can('customers.create') || auth()->user()->can('customers.index')) || auth()->user()->hasRole('super-admin'))
    <div class="card-area">
        <div class="row">
            <!-- Add Customer -->
             @if(auth()->user()->can('customers.create') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6 ">
                    <a href="{{route('customers.create')}}">
                        <div class="card-content card-no-padding">
                            <p>Add Customer </p>
                            <span class="bg-green"><i class="fas fa-users"></i></span>
                        </div>
                    </a>
                </div>
            @endif

            <!-- All Customer  -->
            @if(auth()->user()->can('customers.index') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6">
                    <a href="{{route('customers.index')}}">
                        <div class="card-content card-no-padding">
                            <p>All Customers </p>
                            <span class="bg-red"><i class="fas fa-th-large"></i></span>
                        </div>
                    </a>
                </div>
            @endif
            <!-- End -->
        </div>
    </div>

@endif


@endsection
@push('js')

@endpush
