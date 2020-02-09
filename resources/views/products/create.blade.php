@extends('layouts.app')
@section('title','product create - ')
@push('css')

@endpush
@section('content')

    <section class="content">
        <div class="card">

            <div class="card-body">
                <h3 class="card-title">Add Item
                <a href="{{route('products.index')}}" class="btn btn-info pull-right">Back</a></h3>
                <hr/>
            </div>

            <div class="card-body ">
                <form id="usersForm" action="{{route('products.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('products.form')

                    <div class="col pr-0">
                        <button type="submit" class="btn btn-info  pull-right"><i class="fa fa-pencil-square-o"></i> Add</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection
@push('js')
   
@endpush