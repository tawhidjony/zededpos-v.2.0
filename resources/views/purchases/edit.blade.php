@extends('layouts.app')
@section('title','edit purchase - ')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" />
@endpush
@section('content')

            <div class="card-body">
                <form id="usersForm" action="{{route('purchase.update',$purchasepro->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    @include('purchases.edit_form')
                    
                </form>
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
            var due = document.getElementById('DueAmount').value = parseInt(totaltk)-parseInt(Payment);


        }
    </script>
@endpush