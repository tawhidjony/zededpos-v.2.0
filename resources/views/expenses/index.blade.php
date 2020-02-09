@extends('layouts.app')
@section('title','expense - ')
@push('css')
    @include('layouts.datatable_css')
@endpush
@section('content')


    <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <!--start box Header-->
                    <div class="card-body">
                        <h3 >All Expense
                        <a href="{{route('expenses.create')}}" class="btn btn-info pull-right">Add Expense</a>
                        </h3>
                        <hr/>
                    </div>
                    <!--End box Header-->

                    <!--Start box body-->
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Employee Name</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($expense as $key=> $row)
                            <tr>
                                <td>{{$key + 1 }}</td>
                                <td>{{$row->employee_name}}</td>
                                <td>{{$row->product_name}}</td>
                                <td>{{$row->quantity}}</td>
                                <td>{{$row->price}}</td>
                                <td>
                                    <div class="btn-group m-1">
                                        <a href="{{route('expenses.show',$row->id)}}">
                                            <button class="btn btn-outline-dark  ml-2"><i class="fa fa-eye"></i></button>
                                        </a>
                                        <a href="{{route('expenses.edit',$row->id)}}">
                                            <button class="btn btn-outline-success  ml-2"><i class="fa fa-pencil-square-o"></i></button>
                                        </a>
                                        <form user="deleteForm" method="POST" action="{{route('expenses.destroy',$row->id)}}">
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
                        {{$expense->links()}}
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
