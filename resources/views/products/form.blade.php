
    <div class="row select-add-product" style="margin: 0;padding: 0;">
    <!--start-->
    <div class="col-sm-6">
        <div class="input-group mb-3">
            <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                   placeholder="Product Name" name="name" value="@if($product->name){{$product->name}}@else{{ old('name') }}@endif"
                   autofocus>
            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <!--End-->

    <!--start-->
    <div class="col-sm-6">
        <div class="input-group mb-3"> 
            <input id="randomCode" type="number" class="form-control{{ $errors->has('code_id') ? ' is-invalid' : '' }}"
                   placeholder="Product Code" name="code_id" value="@if($product->code_id){{$product->code_id}}@else{{ old('code_id') }}@endif"
                   autofocus>
            <div class="input-group-append">
                <span class="input-group-text pb-0 pt-0">
                   <a onclick="randomCodeGenerate()" ><i class="fa fa-random"></i> </a>
                </span>
            </div>
            @if ($errors->has('code_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('code_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <!--End-->

    <!--Start-->
    <div class="col-sm-6 ">
        <div class="input-group mb-3">

            <select id="inputState" type="text" class="form-control{{ $errors->has('category_id') ? ' is-invalid' : '' }}"
                    placeholder="Category" name="category_id" >
                <option value>Select Category</option>
                @foreach($categories as $key => $category)
                    <option value="{{$category->id}}"
                            @if($product->category_id && $product->category_id == $category->id) selected @endif >{{$category->name}}</option>
                @endforeach
            </select>

            @if ($errors->has('category_id'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('category_id') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <!--End-->

    <!--Start-->
    <div class="col-sm-6">
            <select id="inputState2" type="text" class="form-control" name="sub_category_id" >
                <option value >Select SubCategory</option>
                @foreach($sub_categories as $key => $subCategories)
                    <option value="{{$subCategories->id}}"
                            @if($product->sub_category_id && $product->sub_category_id == $subCategories->id) selected @endif >{{$subCategories->name}}</option>
                @endforeach
            </select>
    </div>
    <!--End-->

    <!--Start-->
    <div class="col-sm-6">
            <select id="inputState3" type="text" class="form-control" name="brand_id">
                <option value>Select Brand</option>
                @foreach($brands as $key => $brand)
                    <option value="{{$brand->id}}"
                            @if($product->brand_id && $product->brand_id == $brand->id) selected @endif >{{$brand->name}}</option>
                @endforeach
            </select>
    </div>
    <!--End-->

    <!--Start-->
    <div class="col-sm-6">
            <select id="inputState4" type="text" class="form-control" name="pro_model_id">
                <option value>Select Model</option>
                @foreach($models as $key => $pro_model)
                    <option value="{{$pro_model->id}}"
                            @if($product->pro_model_id && $product->pro_model_id == $pro_model->id) selected @endif >{{$pro_model->name}}</option>
                @endforeach
            </select>
    </div>
    <!--End-->

    <!--Start-->
    <div class="col-sm-6">
        <div class="input-group mb-3 mt-3">
            <select name="unit_id" id=""  type="text" class="form-control">
                <option value>Select Unit</option>
                @foreach($units as $key => $unit)
                    <option value="{{$unit->id}}"
                            @if($product->unit_id && $product->unit_id == $unit->id) selected @endif >{{$unit->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!--End-->

    <!--start-->
    <div class="col-sm-6">
        <div class="input-group mb-3 mt-3">
            <input type="text" class="form-control{{ $errors->has('alart_quantity') ? ' is-invalid' : '' }}"
                   placeholder="Alert Quantity" name="alart_quantity" value="@if($product->alart_quantity){{$product->alart_quantity}}@else{{ old('quantity') }}@endif"
                   autofocus>
            @if ($errors->has('alart_quantity'))
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('alart_quantity') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <!--End-->

    <!--Start-->
    <div class="col-sm-6">
        <div class="input-group mb-3">
            <input id="photo" type="file" class="form-control{{ $errors->has('photo') ? ' is-invalid' : '' }}"
                   name="photo" accept="image/*" onchange="readURL(this);" value="@if($product->photo){{$product->photo}}@else{{ old('photo') }}@endif"
                   autofocus>
          
            @if ($errors->has('photo'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('photo') }}</strong>
                </span>
            @endif
            @if (!empty($product->photo))
                 <img id="image" src="{{URL::to($product->photo)}}" style="width: 100px; height: 100px;" >
            @else
                <img id="image" src="{{asset('defaultimg/imguploadicon.png')}}" style="width: 100px; height:100px; margin-left:10px;" >
            @endif

        </div>
    </div>
    <!--End-->
    <!--start-->
    <div class="col-sm-6">
        <div class="input-group mb-3">
           <textarea type="number" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                     placeholder="Description"  name="description" >@if($product->description){{$product->description}}@else{{ old('description') }}@endif</textarea>
            @if ($errors->has('description'))
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <!--End-->



</div>



 @push('js')
     <script src="{{asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>

     <script>

         $(document).ready(function () {

            $('#inputState').select2();
            $('#inputState1').select2();
            $('#inputState2').select2();
            $('#inputState3').select2();
            $('#inputState4').select2();

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
         function readURL(input) {
             if (input.files && input.files[0]) {
                 var reader = new FileReader();
                 reader.onload = function (e) {
                     $('#image')
                         .attr('src', e.target.result)
                         .width(100)
                         .height(100);
                 };
                 reader.readAsDataURL(input.files[0]);
             }
         }

         function randomCodeGenerate() {
             let x = document.getElementById("randomCode");
             x.value = Math.floor((Math.random() * 1000000) + 1000);
         }
     </script>
 @endpush