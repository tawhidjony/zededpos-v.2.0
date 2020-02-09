@extends('layouts.app')
@section('title','edit wastage - ')
@section('content')

        <div class="card">

            <div class="card-body">
                <h3 class="box-title">Edit Wastage
                <a href="{{route('wastages.index')}}" class="btn btn-info pull-right">Back</a>
                </h3>
                <hr/>
            </div>

            <div class="card-body">
                <form id="usersForm" action="{{route('wastages.update',$wastage->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('wastages.form')
                    @method('PUT')

                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-info  pull-right"><i class="fa fa-pencil-square-o"></i> Update</button>
                    </div>
                </form>
            </div>

        </div>

@endsection