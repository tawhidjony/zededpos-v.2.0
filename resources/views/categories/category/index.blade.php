@extends('layouts.app')
@section('title','category - ')
@push('css')
    @include('layouts.datatable_css')
@endpush
@section('content')


    <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <!--start box Header-->
                    <div class="card-body">
                        <h3 >All Categories
                            <a href="{{route('categories.index')}}" class="btn btn-info pull-right">Back</a>
                        </h3>
                        <hr/>
                    </div>
                    <!--End box Header-->

                    <!--Start box body-->
                    <div class="card-body">
                        <table id="example" class="table table-bordered table-striped">
                            <thead class="table-align-thead">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-align-body">
                            @foreach($category as $key=> $row)
                            <tr>
                                <td>{{$key + 1 }}</td>
                                <td>{{$row->name}}</td>
                                <td>
                                    <div class="btn-group m-1">

                                        {{--<a href="{{url('category/edit')}}" data-id="{{$row->id}}" id="edit">--}}
                                            {{--<button class="btn btn-outline-success  ml-2"><i class="fa fa-pencil-square-o"></i></button>--}}
                                        {{--</a>--}}
                                        <form user="deleteForm" method="POST" action="{{route('category.destroy',$row->id)}}">
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
                        {{$category->links()}}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- End box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    @include('categories.category.edit')
@endsection

@push('js')
    <script src="{{asset('js/category.js')}}"></script>
    @include('layouts.datatable_js')
@endpush
