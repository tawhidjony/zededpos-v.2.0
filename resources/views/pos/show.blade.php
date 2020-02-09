@extends('layouts.app')
@section('title','All invoice - ')
@push('css')
    @include('layouts.datatable_css')
@endpush
@section('content')
    <div class="card">

        <div class="card-body">

            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <div class="row">
                    <div class="col-xs-12">
                        <h2 class="page-header">
                            <i class="fa fa-globe"></i> AdminLTE, Inc.
                            <small class="pull-right">Date: 2/10/2014</small>
                        </h2>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- info row -->
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                            <strong>Admin, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (804) 123-5432<br>
                            Email: info@almasaeedstudio.com
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <strong>John Doe</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            Phone: (555) 539-1037<br>
                            Email: john.doe@example.com
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Invoice #007612</b><br>
                        <br>
                        <b>Order ID:</b> 4F3S8J<br>
                        <b>Payment Due:</b> 2/22/2014<br>
                        <b>Account:</b> 968-34567
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <!-- Table row -->
                <div class="row">
                    <div class="col-xs-12 table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Subtotal</th>
                            </tr>
                            </thead>
                            <tbody>
                                    @foreach($allShow_invoice->sale as $key=> $data)
                                        <tr>
                                            <td>{{ ($key + 1) }} </td>
                                            <td>{{ ($data->product->name) }} </td>
                                            <td>{{ ($data->qty) }} </td>
                                            <td> {{ ($data->price) }} </td>
                                            <td> {{ ($data->subtotal) }} </td>
                                        </tr>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-sm-6">

                    </div>
                    <div class="col-sm-6">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th style="width:50%">Total:</th>
                                    <td>{{$allShow_invoice->total}}</td>
                                </tr>
                                <tr>
                                    <th>Discount</th>
                                    <td>{{$allShow_invoice->discount}}</td>
                                </tr>
                                <tr>
                                    <th>Grand Total:</th>
                                    <td>{{$allShow_invoice->grand_total}}</td>
                                </tr>
                                <tr>
                                    <th>Due Amount:</th>
                                    <td>{{$allShow_invoice->due_amount}}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </section>
        </div>
    </div>



@endsection

@push('js')
    @include('layouts.datatable_js')
@endpush
