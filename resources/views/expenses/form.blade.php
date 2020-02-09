
<div class="row">
<div class="col-md-1"></div>

<div class="col-md-10">
    <div class="form-group">
<!-- Start -->
<div class="form-group row">
    <label for="employee_name" class="col-md-3 col-form-label text-md-left">{{ __(' Employee Name :') }}</label>
    <div class="col-md-9">
        <input id="employee_name" type="text" class="form-control{{ $errors->has('employee_name') ? ' is-invalid' : '' }}"
               name="employee_name" value="@if($expense->employee_name){{$expense->employee_name}}@else{{ old('employee_name') }}@endif"
               autofocus>

        @if ($errors->has('employee_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('employee_name') }}</strong>
            </span>
        @endif
    </div>
</div>
<!-- End -->

<!-- Start -->
<div class="form-group row">
    <label for="employee_name" class="col-md-3 col-form-label text-md-left">{{ __('Expense Name :') }}</label>
    <div class="col-md-9">
        <input id="product_name" type="text"
               class="form-control{{ $errors->has('product_name') ? ' is-invalid' : '' }}"
               name="product_name"
               value="@if($expense->product_name){{$expense->product_name}}@else{{ old('product_name') }}@endif"
               autofocus>

        @if ($errors->has('product_name'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('product_name') }}</strong>
            </span>
        @endif
    </div>
</div>
<!-- End -->

<!-- Start -->
<div class="form-group row">
    <label for="employee_name" class="col-md-3 col-form-label text-md-left">{{ __('Quantity :') }}</label>
    <div class="col-md-9">
        <input id="quantity" type="number" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}"
               name="quantity" value="@if($expense->quantity){{$expense->quantity}}@else{{ old('quantity') }}@endif"
               autofocus>

        @if ($errors->has('quantity'))
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('quantity') }}</strong>
                    </span>
        @endif
    </div>
</div>
<!-- End -->

<!-- Start -->
<div class="form-group row">
    <label for="employee_name" class="col-md-3  col-form-label text-md-left">{{ __('Price :') }}</label>
    <div class="col-md-9">
                <input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price"
                       value="@if($expense->price){{$expense->price}}@else{{ old('price') }}@endif" autofocus>

                   

        @if ($errors->has('price'))
            <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
        @endif
    </div>
</div>
<!-- End -->


<div class="col-md-1"></div>
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
                    employee_name: "required",
                },
                messages: {
                    employee_name: "Please enter employee_name",
                }
            });

        });
        function readURL(input){
            if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image')
                        .attr('src', e.target.result)
                        .width(140)
                        .height(120);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

    </script>
@endpush