@extends('layouts.app')
@section('title','edit purchase - ')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" />
@endpush
@section('content')

        <div class="card">

            <div class="card-body">
                <h3 class="box-title">Edit Due Purchase
                <a href="{{route('purchase.index')}}" class="btn btn-info pull-right">Back</a>
                </h3>
                <hr/>
            </div>

            <div class="card-body">
                <form id="usersForm" action="{{url('/purchase/update',$edit_purchase->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @include('purchases.dues.due_from')

                    <div class="col pr-0">
                        <button type="submit" class="btn btn-info  pull-right"><i class="fa fa-pencil-square-o"></i>Due Update</button>
                    </div>
                </form>
            </div>

        </div>

@endsection
@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#select2').select2();
            $('#select1').select2();

        });

        cal = function()
        {
            var qty = document.getElementById('quantity').value;
            var SellPrice = document.getElementById('sellPrice').value;
            var totaltk = document.getElementById('Total').value = parseInt(qty)*parseInt(SellPrice);

            var Payment = document.getElementById('PayAmount').value;
            var Paid = document.getElementById('PaidAmount').value=(Payment);
            var due = document.getElementById('DueAmount').value = parseInt(totaltk)-parseInt(Paid);


        }
    </script>
@endpush