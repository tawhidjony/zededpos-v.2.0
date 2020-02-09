@extends('layouts.app')
@section('title','purchase - ')
@push('css')
@endpush
@section('content')
    <div class="card-area">
        <div class="row">
            @if((auth()->user()->can('purchase.create') || auth()->user()->can('purchase.index') || auth()->user()->can('purchase.due')) || auth()->user()->hasRole('super-admin'))
                <!-- start-->
                @if(auth()->user()->can('purchase.create') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6">
                    <a href="{{route('purchase.create')}}">
                        <div class="card-content card-no-padding">
                            <p>Add Purchase</p>
                            <span class="bg-green"><i class="fas fa-pen-square"></i></span>
                        </div>
                    </a>
                </div>
                @endif
                <!-- End-->
        
                <!-- start-->
                @if(auth()->user()->can('purchase.index') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6">
                    <a href="{{route('purchase.index')}}">
                        <div class="card-content card-no-padding">
                            <p>All Purchase</p>
                            <span class="bg-red"><i class="fas fa-list"></i></span>
                        </div>
                    </a>
                </div>
                @endif
                <!-- End-->
                
                <!-- start-->
                @if(auth()->user()->can('purchase.due') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6">
                    <a href="{{route('purchase.due')}}">
                        <div class="card-content card-no-padding">
                            <p>All Due Purchase</p>
                            <span class="bg-red"><i class="fas fa-list"></i></span>
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
