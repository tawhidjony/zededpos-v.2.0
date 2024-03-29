@extends('layouts.app')
@section('title','customer details - ')
@section('content')
        <div class="card">

            <div class="card-body">
                <h3 class="box-title">Customer Details
                <a href="{{route('customers.index')}}" class="btn btn-info pull-right">Back</a>
                </h3>
                <hr/>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>ID : </strong> <span>{{$customer->id}}</span></label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Name : </strong> <span>{{$customer->name}}</span></label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Email : </strong> <span></span>{{$customer->email}}</label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Phone : </strong> <span></span>{{$customer->phone}}</label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Address : </strong> <span></span>{{$customer->address}}</label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>About : </strong> <span></span>{{$customer->about}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <p><img src="{{URL::to($customer->photo)}}" style="width: 200px; height: 200px;"></p>
                        </div>
                    </div>
                </div>
            </div>

        </div>



@endsection