@extends('layouts.app')
@section('title','product - ')
@push('css')
    @include('layouts.datatable_css')
@endpush
@section('content')


    <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <!--start box Header-->
                    <div class="card-body">
                        <h3 >All Item
                        <a href="{{route('products.create')}}" class="btn btn-info pull-right">Add Item</a>
                        <a href="{{route('product.home')}}" class="btn btn-info pull-right mr-2">Back</a>
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
                                    <th>Image</th>
                                    <th>Code</th>
                                    <th>Category</th>
                                    <th>Model</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($product as $key=> $row)
                            <tr>
                                <td>{{$key + 1 }}</td>
                                <td>{{$row->name}}</td>

                                <td>
                                    @if($row->photo)
                                    <img src="{{URL::to($row->photo)}}" style="width: 60px; height: 60px">
                                    @else
                                    <img id="image" src="{{asset('defaultimg/imguploadicon.png')}}" style="width: 60px; height:60px;">
                                    @endif
                                </td>

                                <td>{{$row->code_id}}</td>
                                <td>{{isset($row->category->name) ? $row->category->name : ''}}</td>



                                <td>{{isset($row->pro_model->name) ? $row->pro_model->name : ''}}</td>

                                <td>
                                    <div class="btn-group m-1">
                                        <a href="{{route('products.show',$row->id)}}">
                                            <button class="btn btn-outline-dark  ml-2"><i class="fa fa-eye"></i></button>
                                        </a>
                                        <a href="{{route('products.edit',$row->id)}}">
                                            <button class="btn btn-outline-success  ml-2"><i class="fa fa-pencil-square-o"></i></button>
                                        </a>
                                        <form user="deleteForm" method="POST" action="{{route('products.destroy',$row->id)}}">
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
                        {{$product->links()}}
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
