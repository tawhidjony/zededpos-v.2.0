@extends('layouts.app')
@section('title','Users Edit- ')
@section('content')

    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 >Edit User
                <a href="{{route('Users.index')}}" class="btn btn-info pull-right">Back</a></h3>
            </div>
            <div class="card-body">

                <form id="usersForm" action="{{route('Users.update',$user->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('users.form')
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success  pull-right"> <i class="fa fa-pencil-square-o"></i> Update</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection
