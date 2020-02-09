@extends('layouts.app')
@section('title','expense - ')
@section('content')
        <div class="card">

            <div class="card-body">
                <h3 class="box-title">Expense Details
                <a href="{{route('expenses.index')}}" class="btn btn-info pull-right">Back</a>
                </h3>
                <hr/>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">

                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Employee Name : </strong> <span>{{$expense->employee_name}}</span></label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Product Name : </strong> <span></span>{{$expense->product_name}}</label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Quantity : </strong> <span></span>{{$expense->quantity}}</label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Price : </strong> <span></span>{{$expense->price}}</label>
                            </div>
                        </div>

                </div>
            </div>

        </div>
        </div>



@endsection