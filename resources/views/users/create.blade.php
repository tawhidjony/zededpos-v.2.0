@extends('layouts.app')
@section('title','create - ')
@section('content')


    <section class="content">
        <div class="card">

            <div class="card-body">
                    <h3 class="card-title">Add User
                    <a href="{{route('Users.index')}}" class="btn btn-info pull-right">Back</a></h3><hr>
            </div>

            <div class="card-body">
                <form id="usersForm" action="{{route('Users.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('users.form')

                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-success  pull-right"><i class="fa fa-pencil-square-o"></i> Add</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection