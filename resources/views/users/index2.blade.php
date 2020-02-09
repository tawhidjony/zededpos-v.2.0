@extends('layouts.app')
@section('title','Users - ')
@push('css')
    @include('layouts.datatable_css')
@endpush
@section('content')


    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-body">
                        <h4 class="card-title"> All Users
                            <a href="{{route('users.create')}}" methods="get">
                                <button class="btn btn-info pull-right"><i class="fa fa-user"></i>  Add User</button>
                            </a>
                        </h4><hr/>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->email}}</td>
                                    <td><img src="{{URL::to($user->photo)}}" style="width: 60px; height: 60px"></td>

                                    <td>
                                        <div class="btn-group m-1">
                                            <a href="{{route('users.edit',$user->id)}}">
                                                <button class="btn btn-outline-success  ml-2"><i class="fa fa-pencil-square-o"></i></button>
                                            </a>

                                            <form user="deleteForm" method="POST" action="{{route('users.destroy', $user->id)}}">
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

            </div>
        </div>
    </div>

@endsection

@push('js')
    @include('layouts.datatable_js')
@endpush
