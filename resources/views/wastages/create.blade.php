@extends('layouts.app')
@section('title','Wastage - ')
@push('css')

@endpush
@section('content')

    <section class="content">
        <div class="card">

            <div class="card-body">
                <h3 class="card-title">Add Wastage
                <a href="{{route('wastages.index')}}" class="btn btn-info pull-right">Back</a></h3>
                <hr/>
            </div>

            <div class="card-body">
                <form id="usersForm" action="{{route('wastages.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('wastages.form')

                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-info  pull-right"><i class="fa fa-pencil-square-o"></i> Add</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection