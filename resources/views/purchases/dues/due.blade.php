@extends('layouts.app')
@section('title','purchase - ')
@push('css')
    @include('layouts.datatable_css')
@endpush
@section('content')


    <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <!--start box Header-->
                    <div class="card-body">
                        <h3 >Due Purchase
                        <a href="{{route('purchase.create')}}" class="btn btn-info pull-right">Add Purchase</a>
                        <a href="{{url('/purchases')}}" class="btn btn-info pull-right mr-2">Back</a>
                        </h3>
                        <hr/>
                    </div>
                    <!--End box Header-->

                    <!--Start box body-->
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Voucher ID</th>
                                    <th>Supplier Name</th>
                                    <!-- <th>Product Name</th>
                                    <th>Quantity</th> -->
                                    <th>Total</th>
                                    <th>Pay Amount</th>
                                    <th>Due</th>
                                </tr>
                            </thead>
                            <tbody>
                                 @foreach ($dueAmount as $Amount_due)
                            <tr>
                                <td>{{$Amount_due->id}}</td>
                                <td>{{$Amount_due->voucher_code}}</td>
                                <td>{{$Amount_due->supplier->name}}</td>
                                <!--@foreach($Amount_due->purchasesProduct as $produc_info)
                                    <td>{{$produc_info->product->name}}</td>
                                @endforeach
                                @foreach($Amount_due->purchasesProduct as $produc_info)
                                    <td>{{$produc_info->quantity}}</td>
                                @endforeach -->
                                <td>{{$Amount_due->total}}</td>
                                <td>{{$Amount_due->amount}}</td>
                                <td>{{$Amount_due->due}}</td>

                            </tr>
                            @endforeach
                            </tbody>

                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- End box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

@endsection

@push('js')
    @include('layouts.datatable_js')
@endpush
