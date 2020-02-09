@extends('layouts.app')
@section('title','Roles - ')
@section('content')
    <div class="row">
        <div class="col-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    Roles
                </div>
                <div class="card-body">
                    <form id="rolesForm" action="{{route('roles.update',$role->id)}}" method="post">
                        @csrf
                        @method('PUT')
                        @include('roles.form')
                        <div class="col-sm-2">
                            <button class="btn btn-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection