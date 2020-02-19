@extends('layouts.app')
@section('title','show product - ')
@section('content')
    <div class="card">
            <div class="card-body">
                <h3 class="box-title">Single Item Details
                    <a href="{{route('products.index')}}" class="btn btn-info pull-right">Back</a>
                </h3>
                <hr/>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">

                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Name : </strong> <span>{{$product->name}}</span></label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Code : </strong> <span></span>{{$product->code_id}}</label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Category : </strong> <span></span>{{$product->category->name}}</label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>SubCategory : </strong> <span></span>{{isset($product->sub_category->name) ? $product->sub_category->name : ''}}</label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Product Brand : </strong> <span></span>{{$product->brand->name}}</label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Product Model : </strong> <span></span>{{isset($product->pro_model->name) ? $product->pro_model->name : ''}}</label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Unit : </strong> <span></span>{{$product->unit->name}}</label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Create Date : </strong> <span></span>{{$product->created_at}}</label>
                            </div>
                        </div>
                        <!-- start -->
                        <div class="col-lg-12">
                            <div class="form-group row">
                                <label for="input-1" class="col-sm-12 "><strong>Update Date : </strong> <span></span>{{$product->updated_at}}</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" style="border: 1px solid;width: 200px; height: 200px;">
                            <p>
                                @if($product->photo)
                                    <img src="{{URL::to($product->photo)}}" style="width: 200px; height: 200px;">
                                @else
                                     <img src="{{URL::to('defaultimg/imguploadicon.png')}}" style="width: 200px; height: 200px;">
                                @endif
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
@endsection
