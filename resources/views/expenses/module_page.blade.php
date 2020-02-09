@extends('layouts.app')
@section('title','expense - ')
@push('css')
@endpush
@section('content')
<div class="card-area">
    <div class="row">
        @if((auth()->user()->can('expenses.create') || auth()->user()->can('expenses.index')) || auth()->user()->hasRole('super-admin'))
            <!-- start-->
            @if(auth()->user()->can('expenses.create') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6 ">
                    <a href="{{route('expenses.create')}}">
                        <div class="card-content card-no-padding">
                            <p>Add Expenses </p>
                            <span class="bg-green"><i class="fas fa-pen-square"></i></span>
                        </div>
                    </a>
                </div>
            @endif
            <!-- End-->
            <!-- start-->
            @if(auth()->user()->can('expenses.index') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6 ">
                    <a href="{{route('expenses.index')}}">
                        <div class="card-content card-no-padding">
                            <p>All Expenses </p>
                            <span class="bg-red"><i class="fas fa-pen-square"></i></span>
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
