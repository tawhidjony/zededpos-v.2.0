
<div class="row">
    <div class="col-md-1"></div>

        <div class="col-md-9">
            <div class="form-group">
                <!-- Start -->
                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-left">{{ __(' Name :') }}</label>
                    <div class="col-md-9">
                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                               name="name" value="@if($wastage->name){{$wastage->name}}@else{{ old('name') }}@endif"
                               autofocus>

                        @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                 <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <!-- End -->

                <!-- Start -->
                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-left">{{ __('Code :') }}</label>
                    <div class="col-md-9">
                        <input id="code" type="code"
                               class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}"
                               name="code"
                               value="@if($wastage->code){{$wastage->code}}@else{{ old('code') }}@endif"
                               autofocus>

                        @if ($errors->has('code'))
                            <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('code') }}</strong>
                </span>
                        @endif
                    </div>
                </div>
                <!-- End -->

                <!-- Start -->
                <div class="form-group row">
                    <label for="name" class="col-md-3 col-form-label text-md-left">{{ __('Quantity :') }}</label>
                    <div class="col-md-9">
                        <input id="quantity" type="number" class="form-control{{ $errors->has('quantity') ? ' is-invalid' : '' }}"
                               name="quantity" value="@if($wastage->quantity){{$wastage->quantity}}@else{{ old('quantity') }}@endif"
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
                    <label for="name" class="col-md-3  col-form-label text-md-left">{{ __('Price :') }}</label>
                    <div class="col-md-9">
                    <input id="price" type="number" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" name="price"
                           value="@if($wastage->price){{$wastage->price}}@else{{ old('price') }}@endif"
                              autofocus>

                        @if ($errors->has('price'))
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <!-- End -->


            </div>
        </div>

    <div class="col-md-2"></div>
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