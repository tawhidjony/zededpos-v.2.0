@extends('layouts.app')
@section('title','wastages - ')
@push('css')
@endpush
@section('content')
<div class="card-area">
    <div class="row">
        @if((auth()->user()->can('wastages.create') || auth()->user()->can('wastages.index')) || auth()->user()->hasRole('super-admin'))
            <!-- start-->
            @if(auth()->user()->can('wastages.create') || auth()->user()->hasRole('super-admin'))
            <div class="col-xl-3 col-md-6 ">
                <a href="{{route('wastages.create')}}">
                    <div class="card-content card-no-padding">
                        <p>Add Wastage </p>
                        <span class="bg-green"><i class="fas fa-pen-square"></i></span>
                    </div>
                </a>
            </div>
            @endif
            <!-- End-->
        
            <!-- start-->
            @if(auth()->user()->can('wastages.index') || auth()->user()->hasRole('super-admin'))
            <div class="col-xl-3 col-md-6 ">
                <a href="{{route('wastages.index')}}">
                    <div class="card-content card-no-padding">
                        <p>All Wastage </p>
                        <span class="bg-red"><i class="fas fa-list-alt"></i></span>
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
