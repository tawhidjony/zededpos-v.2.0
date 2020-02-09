@extends('layouts.app')
@section('title','supplier - ')
@push('css')
    @include('layouts.datatable_css')
@endpush
@section('content')


    <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <!--start box Header-->
                    <div class="card-body">
                        <h3 >All Supplier

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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($supplier as $key=> $row)
                            <tr>
                                <td>{{$key + 1 }}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>{{$row->phone}}</td>
                                <td>{{$row->address}}</td>
                                <td>
                                    <div class="btn-group m-1">

                                        {{--<a href="{{url('category/edit')}}" data-id="{{$row->id}}" id="edit">--}}
                                            {{--<button class="btn btn-outline-success  ml-2"><i class="fa fa-pencil-square-o"></i></button>--}}
                                        {{--</a>--}}
                                        <form user="deleteForm" method="POST" action="{{route('suppliers.destroy',$row->id)}}">
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
                        {{$supplier->links()}}
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
