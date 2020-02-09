
<div class="row">
    <!--Start-->
    <div class="col-sm-6">
        <label for="sellPrice">Supplier Name</label>
        <div class="input-group mb-3">

            <select type="text" class="form-control {{ $errors->has('supplier_id') ? ' is-invalid' : '' }}" id="select2" name="supplier_id" disabled>
                <option >Select Supplier Name</option>
                @foreach($products as $key => $Products)
                    <option value="{{$Products->supplier->id}}"
                            @if($edit_purchase->supplier_id && $edit_purchase->supplier_id == $Products->supplier->id) selected @endif >{{$Products->supplier->name}}</option>
                @endforeach
            </select>
            @if ($errors->has('supplier_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('supplier_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <!--End-->
    <!--Start-->
    <div class="col-sm-6">
        <label for="sellPrice">Product Name</label>
        <div class="input-group mb-3">
            <select name="product_id" type="text" class="form-control{{ $errors->has('product_id') ? ' is-invalid' : '' }}" id="select1" disabled>
                <option value="">Select Product</option>
                @foreach($products as $key => $Products)
                    <option value="{{$Products->id}}"
                            @if($edit_purchase->product_id && $edit_purchase->product_id == $Products->id) selected @endif>{{$Products->name}}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('product_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('product_id') }}</strong>
                </span>
            @endif

        </div>
    </div>
    <!--End-->

    <!--Start-->
    <div class="col-sm-6">
        <label for="sellPrice">Quantity</label>
        <div class="input-group mb-3">
            <input type="number" class="form-control {{ $errors->has('quantity') ? ' is-invalid' : '' }}" placeholder="Quantity" id="quantity" name="quantity"
                   value="@if($edit_purchase->quantity){{$edit_purchase->quantity}}@else{{ old('quantity') }}@endif" onchange="cal()" disabled>
            @if ($errors->has('quantity'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('quantity') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <!--End-->

    <!--Start-->
    <div class="col-sm-6">
        <label for="sellPrice">Alert Quantity</label>
        <div class="input-group mb-3">
            <input type="number" disabled class="form-control {{ $errors->has('alert_qty') ? ' is-invalid' : '' }}" placeholder="Alert Quantity" name="alert_qty"
                   value="@if($edit_purchase->alert_qty){{$edit_purchase->alert_qty}}@else{{ old('alert_qty') }}@endif" disabled>
            @if ($errors->has('alert_qty'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('alert_qty') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <!--End-->

    <!--Start-->
    <div class="col-sm-6">
        <label for="sellPrice">Buy Price</label>
        <div class="input-group mb-3">
            <input type="number" class="form-control {{ $errors->has('buy_price') ? ' is-invalid' : '' }}" placeholder="Set Buy Price" name="buy_price"
                   value="@if($edit_purchase->buy_price){{$edit_purchase->buy_price}}@else{{ old('buy_price') }}@endif" disabled>
            @if ($errors->has('buy_price'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('buy_price') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <!--End-->
    <!--Start-->
    <div class="col-sm-6">
        <label for="sellPrice">Sell Price</label>
        <div class="input-group mb-3">
            <input type="number" class="form-control{{ $errors->has('sell_price') ? ' is-invalid' : '' }}"
                   placeholder="Set Sell Price" id="sellPrice" onchange="cal()" name="sell_price" value="@if($edit_purchase->sell_price){{$edit_purchase->sell_price}}@else{{ old('sell_price') }}@endif" disabled>
            @if ($errors->has('sell_price'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('sell_price') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <!--End-->

</div>

<div class="row">
    <div class="col-sm-8">
        <!-- Start -->
            <label for="sellPrice">Description</label>
        <div class="form-group row">
            <div class="col-md-9">
                <textarea id="name" type="text" class="form-control"
                          name="description" value=""  placeholder="Description"></textarea>
            </div>
        </div>
        <!-- End -->
    </div>
    <div class="col-sm-4">

        <!-- Start -->
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-left ">Total:</label>
            <div class="col-md-8">
                <input id="Total" type="number" class="form-control {{ $errors->has('total') ? ' is-invalid' : '' }}" name="total"
                       value="@if($edit_purchase->total){{$edit_purchase->total}}@else{{ old('total') }}@endif" onchange="cal()" readonly>
            </div>
        </div>
        <!-- End -->
        <!-- Start -->
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-left">payment:</label>
            <div class="col-md-8">
                <input id="PayAmount" type="number" class="form-control" onchange="cal()">
            </div>
        </div>
        <!-- End -->

        <!-- Start -->
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-left">Paid:</label>
            <div class="col-md-8">
                <input id="PaidAmount" type="number"  class="form-control {{ $errors->has('paid') ? ' is-invalid' : '' }}" name="paid"
                       value="@if($edit_purchase->paid){{$edit_purchase->paid}}@else{{ old('paid') }}@endif" onchange="cal()" readonly>
            </div>
        </div>
        <!-- End -->
        <!-- Start -->
        <div class="form-group row">
            <label for="name" class="col-md-4 col-form-label text-md-left">Due:</label>
            <div class="col-md-8">
                <input id="DueAmount" type="number" class="form-control {{ $errors->has('due') ? ' is-invalid' : '' }}" name="due"
                       value="@if($edit_purchase->due){{$edit_purchase->due}}@else{{ old('due') }}@endif" onchange="cal()" readonly>
            </div>
        </div>
        <!-- End -->
    </div>
</div>



 @push('js')
    <!--Form Validatin Script-->
    <script src="{{asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>

    <script>

        $(document).ready(function () {

            // validate form on keyup and submit
            $("#storeForm").validate({
                rules: {
                    name: "required",
                },
                messages: {
                    name: "Please enter name",
                }
            });

        });
    </script>
 @endpush