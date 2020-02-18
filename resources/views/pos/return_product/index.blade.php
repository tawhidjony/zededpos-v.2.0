@extends('layouts.app')
@section('title','All invoice - ')
@push('css')
    <link rel="stylesheet" href="{{asset('assets/select2/dist/css/select2.min.css')}}">
    @include('layouts.datatable_css')
@endpush
@section('content')

    <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <!--start box Header-->
                    <div class="card-body">
                        <h3 >Create Return Invoice</h3>
                        <hr/>
                        <form class="form-inline" action="{{route('return.edit')}}" method="POST"
                              enctype="multipart/form-data">
                            @csrf
                        <div class="col-sm-12 d-flex justify-content-center return-product-select-parent">
                            <select type="text" class="form-control w-50 mr-2 return-product-select" name="order_id"
                                    id="" style="height:38px;" required>
                                <option value="">Select Return Product</option>
                                @php
                                    $return_product=DB::table('sales')->get();
                                @endphp
                                @foreach($return_product as $old_invoice_id)
                                    <option value="{{$old_invoice_id->id}}">#ZEDPOS{{$old_invoice_id->id}}</option>
                                @endforeach
                            </select>
                             <button type="submit" class="btn btn-primary ml-2">Add Return Invoice</button>
                        </div>
                        </form>
                    </div>
                    <!--End box Header-->

                    <!--Start box body-->
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Old Invoice ID</th>
                                    <th>Customer Name </th>
                                    <th>New Invoice ID </th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Due</th>
                                    <th>Payment Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                    {{-- @foreach($return_P as $Return_Row)
                                    <tr>
                                       <td>#ZEDPOS{{$Return_Row->sale_id}}</td>
                                       <td>{{$Return_Row->customer->name}}</td>
                                       <td>#ZEDPOS{{$Return_Row->id}}</td>
                                        <td>
                                            @foreach($Return_Row->return_products as $key=> $retuProduct)
                                                {{$key + 1}}. <span style="margin-bottom: 0;">{{$retuProduct->product->name}}</span><br>
                                            @endforeach
                                        </td>
                                        <td> @foreach($Return_Row->return_products as $key=> $retProduct)
                                                ({{$retProduct->qty}})<br>
                                            @endforeach
                                        </td>
                                        <td>{{$Return_Row->grand_total}}</td>
                                        <td>{{$Return_Row->due_amount}}</td>
                                        <td>{{$Return_Row->pay_amount}}</td>
                                    </tr>
                                    @endforeach --}}
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
    <script src="{{asset('assets/select2/dist/js/select2.full.min.js')}}"></script>
    @include('layouts.datatable_js')

    <script type="text/javascript">

        $(document).ready(function() {
            $('.return-product-select').select2();

        });
    </script>
@endpush
