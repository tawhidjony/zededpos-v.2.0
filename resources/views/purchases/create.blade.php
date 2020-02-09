@extends('layouts.app')
@section('title','purchase create - ')
@push('css')
    <link rel="stylesheet" href="{{asset('assets/Select-List-form/css/jquery-customselect-1.9.1.css')}}"/>
    <link href="{{asset('assets/Select-List-form/src/jquery-customselect.css')}}" rel='stylesheet' />
    <style>
        .card-title {
            border-bottom: 1px solid #ced4da;
            padding: 15px 20px;
        }
        .card-body { 
            padding: 15px 20px 20px;
        }
        .products-row {
            padding: 10px 20px;
            width: 100%;
        }
        .products-row .single-product {
            border: 1px solid #dddddd;
            padding: 0px;
            margin-bottom: 15px;
        }
        .products-row .single-product .title, 
        .products-row .single-product .content {
            margin: 0px;
            padding: 0px;
        }
        .products-row .single-product .title {
            border-bottom: 1px solid #ddd;
            padding: 0px 0px;
            position: relative;
        }
        .products-row .single-product .title h5 {
            padding: 15px 15px;
            display: block;
            width: 100%;
            margin-bottom: 0px;
            cursor: pointer;
            text-transform: capitalize;
        }
        .products-row .single-product .content {
            padding: 20px 0px;
            display: none;
        }
        .products-row .single-product .content .row {
            margin: 0px;
        }
        
        .single-product.active {
            border: 1px solid #00acd6;
        }
        .single-product.active .title h5{
            background: #00acd6;
            color: #fff;
        }
    
        .products-row .single-product .title span.close-row {
            position: absolute;
            right: 0px;
            top: 1px;
            height: 53px;
            width: 55px;
            background: #00c0ef;
            color: #fff;
            font-size: 35px;
            text-align: center;
            cursor: pointer;
        }
        #purchases-data-table tfoot tr td, 
        #purchases-data-table tbody tr td, 
        #purchases-data-table tbody tr th {
            border-top : 1px solid #dee2e6;
            border-left: 1px solid #dee2e6;
        }
        #purchases-data-table tfoot tr td:first-child {
            text-align: right;
            font-weight: 700;
        }
        #purchases-data-table tfoot tr td:last-child, 
        #purchases-data-table tbody tr td:last-child {
            border-right: 1px solid #dee2e6
        }
        #purchases-data-table tfoot tr:last-child td,
        #purchases-data-table tbody tr:last-child td {
            border-bottom: 1px solid #dee2e6
        }
        #purchases-data-table tbody tr.no-data td {
            border: 1px solid #dee2e6;
            font-size: 20px;
            text-align: center;
            font-weight: 900;
            text-transform: uppercase;
        }
    </style>
@endpush
@section('content')
    <section class="content">
        <form id="usersForm" action="{{route('purchase.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            @include('purchases.form')    
        </form>
    </section>

<div class="modal fade" id="selectOldProductModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Select A Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row"> 
                    <div class="col-sm-12">
                        <label for="sellPrice" class="label-sellPrice">Product Name</label>
                        <div class="input-group mb-3 d-flex justify-content-center">
                            <select name="product_id" type="text" class="form-control product-list custom-select">
                                <option value="">Select Product</option>
                                @foreach($products as $key => $Products)
                                    <option value="{{$Products->id}}"
                                            @if($purchase->product_id && $purchase->product_id == $Products->id) selected @endif>{{$Products->name}}
                                    </option>
                                @endforeach
                            </select>  
                        </div>
                    </div>
                </div> 
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="addOldProductToTable" type="submit" class="btn btn-primary">Add Product</button>
            </div>
        </div>
    </div>
</div>

@include('purchases.new_product')
@include('categories.category.form')
@include('categories.sub_category.form')
@include('categories.child_sub_category.form')
@include('categories.brand.form')
@include('categories.pro_model.form')
@include('products.product_units.form')
@include('products.product_suppliers.form')
@endsection
@push('js')
    <script>
        var ajaxUrls = {
            addCat: '{{route('category.store')}}',
            addSubCat: '{{route('sub_category.store')}}',
            addTagSubCat: '{{route('chilTag.store')}}',
            addBrand: '{{route('pro_brands.store')}}',
            addModal: '{{route('pro_models.store')}}',
            addUnit: '{{route('units.store')}}',
            addProduct: '{{route('products.store')}}',
            catbyproductUrl : '{{url('/products/category')}}',
            checkQtyUrl : '{{url('/products/quantitycheck')}}',
            productDetailsUrl : '{{url('/products/details')}}', 
            productSearchsUrl : '{{url('/product-search')}}', 
            getproducts : '{{url('/getproducts')}}'
        }; 
    </script>
    <script src="{{asset('assets/Select-List-form/js/jquery-customselect-1.9.1.min.js')}}"></script>
    <script src="{{asset('js/purchases.js')}}"></script> 
    <script src="{{asset('assets/Select-List-form/src/jquery-customselect.js')}}"></script>

    <script>
        $(function() {
        $(".product-list").customselect();
      });
    </script>
    
@endpush