@extends('layouts.app')
@section('title','edit product - ')
@section('content')

        <div class="card">

            <div class="card-body">
                <h3 class="box-title">Edit Item
                <a href="{{route('products.index')}}" class="btn btn-info pull-right">Back</a>
                </h3>
                <hr/>
            </div>

            <div class="card-body">
                <form id="usersForm" action="{{route('products.update',$product->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('products.form')
                    @method('PUT')

                    <div class="col pr-0">
                        <button type="submit" class="btn btn-info  pull-right"><i class="fa fa-pencil-square-o"></i> Update</button>
                    </div>
                </form>
            </div>

        </div>

@endsection
