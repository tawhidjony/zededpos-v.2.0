@extends('layouts.app')
@section('title','Roles - ')
@section('content')
    <div class="row">
        <div class="col-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                   <h4>Roles
                       <a href="{{url('/roles')}}" class="btn btn-success pull-right">Back</a>
                   </h4>
                </div>
                <div class="card-body">
                    <form id="rolesForm" action="{{route('roles.store')}}" method="post">
                    @csrf
                    @include('roles.form')
                        <div class="col-sm-2">
                            <button class="btn btn-success">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection