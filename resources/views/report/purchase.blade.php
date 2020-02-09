@extends('layouts.app')
@section('title','Report - ')
@push('css')
    <link rel="stylesheet" href="{{asset('assets/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    @include('layouts.datatable_css')
@endpush
@section('content')

    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <!--start box Header-->
                <div class="card-body">
                    <h3 >Purchase Report
                    <a href="{{route('report.home')}}" class="btn btn-info pull-right">Back</a>
                    </h3>
                    <hr/>
                    <h5 class="card-title "><!-- start -->
                        <form action="{{url('/report-purchase')}}" method="get" class="inline d-flex justify-content-center">
                            @csrf
                            <div class="row ">

                                <div class="col-lg-5">

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control " required name="start_date"
                                               id="datepicker" placeholder="Start Date" autocomplete="off">
                                    </div>
                                </div>
                                <!-- start -->
                                <div class="col-lg-5">

                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" required name="end_date"
                                               id="datepicker2" placeholder="End Date" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-2">

                                    <div class="input-group mb-3">
                                        <button type="submit" class="btn btn-info">GO</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </h5>
                </div>
                <!--End box Header-->

                <!--Start box body-->
                <div class="card-body">
                    <table id="example" class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Supplier</th>
                                <th>Quantity</th>
                                <th>Buy Price</th>
                                <th>Sell Price</th>
                                <th>Total</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>

                             @foreach($purchase_report as $purchasePeport)
                                <tr>
                                    <td>{{$purchasePeport->product->name}}</td>
                                    <td>{{isset($purchasePeport->purchase->supplier->name) ?
                                    $purchasePeport->purchase->supplier->name:''}}</td>
                                    <td>{{$purchasePeport->quantity}}</td>
                                    <td>{{$purchasePeport->buy_price}}</td>
                                    <td>{{$purchasePeport->sell_price}}</td>
                                    <td>{{$purchasePeport->purchase->total}}</td>
                                    <td>{{ date('d-M-Y',strtotime($purchasePeport->updated_at))}}</td>

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
    <script src="{{asset('assets/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    @include('layouts.datatable_js')

    <script>

        $('#datepicker').datepicker()
            .on('changeDate', function(ev){
                $('#datepicker').datepicker('hide');
            });

        //date-piker 2nd
        $('#datepicker2').datepicker()
            .on('changeDate', function(ev){
                $('#datepicker2').datepicker('hide');
            });
    </script>
@endpush
