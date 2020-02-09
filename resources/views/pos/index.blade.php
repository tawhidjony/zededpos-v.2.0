@extends('layouts.app')
@section('title','All invoice - ')
@push('css')
    @include('layouts.datatable_css')
@endpush
@section('content')


    <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <!--start box Header-->
                    <div class="card-body">
                        <h3 >All Invoice</h3>
                        <hr/>
                    </div>
                    <!--End box Header-->

                    <!--Start box body-->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Invoice ID</th>
                                        <th>Cus Name</th>
                                        <th>Total</th>
                                        <th>Discount</th>
                                        <th>Grand Total</th>
                                        <th>Due Amount</th>
                                        <th>Return Amount</th>
                                        <th>Pay Amount</th>
                                        <th>created_at </th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($allSell_invoice as $row)
                                <tr>
                                    <td>#INVCI{{$row->id }}</td>
                                    <td>{{isset($row->customer->name) ? $row->customer->name : ''}}</td>
                                    <td>{{$row->total}}</td>
                                    <td>{{$row->discount}}</td>
                                    <td>{{$row->grand_total}}</td>
                                    <td>{{$row->due_amount}}</td>
                                    <td>{{$row->return_amount}}</td>
                                    <td>{{$row->pay_amount}}</td>
                                    <td>{{$row->created_at}}</td>
                                    <td>
                                        <div class="btn-group m-1">
                                            {{-- <a href="{{route('invoice.pdf',$row->id)}}">
                                                <button class="btn btn-outline-info  ml-2"><i class="fa fa-print"></i></button>
                                            </a> --}}

                                            <form user="deleteForm" method="POST" action="{{route('sell.destroy',$row->id)}}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="javascript:void(0);"
                                                onclick="deleteWithSweetAlert(event,parentNode);">
                                                    <button class="btn btn-outline-danger  ml-2"><i class="fa fa-trash-o "></i></button>
                                                </a>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>
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
