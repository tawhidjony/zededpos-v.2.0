@extends('layouts.app')
@section('title','Customer - ')
@push('css')

@endpush
@section('content')

    
        <div class="card">

            <div class="card-body">
                <h3 class="card-title">Add Customer
                <a href="{{route('customers.index')}}" class="btn btn-info pull-right">Back</a></h3>
                <hr/>
            </div>

            <div class="card-body">
                <form id="usersForm" action="{{route('customers.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('customers.form')

                   
                    <div class="col-sm-11">
                        <button type="submit" class="btn btn-info  pull-right"><i class="fa fa-pencil-square-o"></i> Add</button>
                    </div>
                </form>
            </div>

        </div>
  
@endsection