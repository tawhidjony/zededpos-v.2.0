@extends('layouts.app')
@section('title','setting - ')
@push('css')
@endpush
@section('content')
<div class="card-area">
    <div class="row">
        @if((auth()->user()->can('settings/1/edit') || auth()->user()->can('roles.index') || auth()->user()->can('users.index')) || auth()->user()->hasRole('super-admin'))
            <!-- start-->
            @if(auth()->user()->can('settings/1/edit') || auth()->user()->hasRole('super-admin'))
                 <div class="col-xl-3 col-md-6 ">
                    <a href="{{url('settings/1/edit')}}">
                        <div class="card-content card-no-padding">
                            <p>General Settings </p>
                            <span class="bg-dark"><i class="fas fa-cogs"></i></span>
                        </div>
                    </a>
                </div>
            @endif
            <!-- End-->
             <!-- start-->
             @if(auth()->user()->can('settings/1/edit') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6 ">
                    <a href="{{url('invoice_setting/1')}}">
                        <div class="card-content card-no-padding">
                            <p>Invoice Settings </p>
                            <span class="bg-dark"><i class="fas fa-cogs"></i></span>
                        </div>
                    </a>
                </div>
             @endif
            <!-- End-->
            <!-- start-->
            @if(auth()->user()->can('roles.index') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6 ">
                    <a href="{{route('roles.index')}}">
                        <div class="card-content card-no-padding">
                            <p>Create Role</p>
                            <span class="bg-red"><i class="fas fa-pen-square"></i></span>
                        </div>
                    </a>
                </div>
            @endif
            <!-- End-->
            <!-- start-->
            @if(auth()->user()->can('Users.index') || auth()->user()->hasRole('super-admin'))
                <div class="col-xl-3 col-md-6 ">
                    <a href="{{route('Users.index')}}">
                        <div class="card-content card-no-padding">
                            <p>Create Users</p>
                            <span class="bg-green"><i class="fas fa-users"></i></span>
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
