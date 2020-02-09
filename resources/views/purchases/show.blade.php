@extends('layouts.app')
@section('title','show purchase - ')
@section('content')
    <div class="card">
            <div class="card-body">
                <h3 class="box-title">Single Product Details
                    <a href="{{route('purchase.index')}}" class="btn btn-info pull-right">Back</a>
                </h3>
                <hr/>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">

                        <table class="table  table-bordered">

                            <tbody>
                              <tr>
                                    <td>Supplier Name</td>
                                    <td>{{$purchase->purchase->supplier->name}}</td>
                                </tr>
                                <tr>
                                    <td>Product Name</td>
                                    <td>{{$purchase->product->name}}</td>
                                </tr>
                                <tr>
                                    <td>Product Quantity</td>
                                    <td>{{$purchase->quantity}}</td>
                                </tr>
                                <tr>
                                    <td>Product Buy Price</td>
                                    <td>{{$purchase->buy_price}}</td>
                                </tr>
                                <tr>
                                    <td>Product Sell Price</td>
                                    <td>{{$purchase->sell_price}}</td>
                                </tr>
                                <tr>
                                    <td>Product Total</td>
                                    <td>{{$purchase->purchase->total}}</td>
                                </tr>
                              
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
@endsection