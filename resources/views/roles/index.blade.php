@extends('layouts.app')
@section('title','Roles - ')
@push('css')
    @include('layouts.datatable_css')
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="card-action">
                        <h4>
                            Roles

                        <a href="{{url('roles/create')}}" methods="get" class="pull-right">
                            <button class="btn btn-success"> Add Role</button>
                        </a>
                        </h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $key => $role)
                                    <tr>
                                        <td>{{$role->name}}</td>
                                        <td>
                                            <div class="btn-group m-1">
                                               {{-- <a href="{{url('roles/'.$role->id)}}"> <button  class="btn btn-outline-info waves-effect waves-light" ><i class="fa fa-eye" ></i></button> </a> --}}
                                                <a href="{{url('roles/'.$role->id.'/edit')}}"><button class="btn btn-outline-success waves-effect waves-light ml-2"> <i class="fa fa-pencil-square-o "></i> </button></a>
                                               {{--<a href=""> <button  class="btn btn-outline-danger waves-effect waves-light ml-2"><i class="fa fa-trash-o"></i></button></a>--}}
                                                <form user="deleteForm" method="POST" action="{{route('roles.destroy', $role->id)}}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <a href="javascript:void(0);" onclick="deleteWithSweetAlert(event,parentNode);" >
                                                        <button  class="btn btn-outline-danger  ml-2"  ><i class="fa fa-trash-o "></i></button>
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
            </div>
        </div>
    </div><!-- End Row-->


@endsection
@push('js')
    @include('layouts.datatable_js')

@endpush