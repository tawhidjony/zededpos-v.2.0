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
                        <h3 >Create New Invoice</h3>
                        <hr/>
                        {{--<form class="form-inline" action="">--}}
                        {{--<div class="col-sm-12 d-flex justify-content-center">--}}
                            {{--<select type="text" class="form-control w-50 mr-2 old_invoice" name="" id="">--}}
                                {{--<option value="">#civzed12</option>--}}
                                {{--<option value="">#civzed12</option>--}}
                                {{--<option value="">#civzed12</option>--}}
                            {{--</select>--}}
                             {{--<a href="" class="btn btn-primary">Add</a>--}}
                        {{--</div>--}}
                        {{--</form>--}}
                    </div>
                    <!--End box Header-->

                    <!--Start box body-->
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Old Invoice ID</th>
                                    <th>Customer Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($all_new_invoice as $new_invoice)
                                    <tr>
                                       <td>#CIVLID{{$new_invoice->id}}</td>
                                       <td>{{isset($new_invoice->customer->name) ? $new_invoice->customer->name : ''}}</td>
                                        <td>
                                            <div class="btn-group m-1">

                                                <a href="{{route('new_invoices.edit',$new_invoice->id)}}">
                                                    <button class="btn btn-outline-success  ml-2">Create New
                                                        Invoice</button>
                                                </a>
                                            </div>
                                        </td>
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
