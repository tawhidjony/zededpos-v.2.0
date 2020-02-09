@extends('layouts.app')
@section('title','Users - ')
@push('css')
    @include('layouts.datatable_css')
@endpush
@section('content')


    <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <!--start box Header-->
                    <div class="card-body">
                        <h3 >All Customer
                        <a href="{{route('customers.create')}}" class="btn btn-info pull-right">Add New Customer</a>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($customer as $key=> $row)
                            <tr>
                                <td>{{$key + 1 }}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->phone}}</td>
                                <td>{{str_limit($row->address,20)}}</td>
                                <td>
                                    @if($row->photo)
                                    <img src="{{asset($row->photo)}}" style="width: 60px; height: 60px">
                                    @else 
                                    <img src="{{asset('public/images/imguploadicon.svg')}}" style="width: 60px; height: 60px">
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group m-1">
                                        <a href="{{route('customers.show',$row->id)}}">
                                            <button class="btn btn-outline-dark  ml-2"><i class="fa fa-eye"></i></button>
                                        </a>
                                        <a href="{{route('customers.edit',$row->id)}}">
                                            <button class="btn btn-outline-success  ml-2"><i class="fa fa-pencil-square-o"></i></button>
                                        </a>
                                        <form user="deleteForm" method="POST" action="{{route('customers.destroy',$row->id)}}">
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
                        {{$customer->links()}}
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
