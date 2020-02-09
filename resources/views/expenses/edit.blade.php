@extends('layouts.app')
@section('title','edit expense - ')
@section('content')

        <div class="card">

            <div class="card-body">
                <h3 class="box-title">Edit Expense
                <a href="{{route('expenses.index')}}" class="btn btn-info pull-right">Back</a>
                </h3>
                <hr/>
            </div>

            <div class="card-body">
                <form id="usersForm" action="{{route('expenses.update', $expense->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('expenses.form')
                    @method('PUT')

                    <div class="col-sm-11">
                        <button type="submit" class="btn btn-info  pull-right"><i class="fa fa-pencil-square-o"></i> Update</button>
                    </div>
                </form>
            </div>

        </div>

@endsection