@extends('layouts.app')
@section('title','wastage - ')
@section('content')
    <div class="card">
            <div class="card-body">
                <h3 class="box-title">Wastage Details
                    <a href="{{route('wastages.index')}}" class="btn btn-info pull-right">Back</a>
                </h3>
                <hr/>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">

                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Name : </strong> <span>{{$wastage->name}}</span></label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Code : </strong> <span></span>{{$wastage->code}}</label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Quantity : </strong> <span></span>{{$wastage->quantity}}</label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Price : </strong> <span></span>{{$wastage->price}}</label>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
@endsection