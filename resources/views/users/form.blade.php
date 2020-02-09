<div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">

        <div class="form-group row">
            <label for="name" class="col-md-3 col-form-label text-md-left">{{ __('Name') }}</label>

            <div class="col-md-8">
                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="@if($user->name){{$user->name}}@else{{ old('name') }}@endif" required autofocus>

                @if ($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('name') }}</strong>
            </span>
                @endif
            </div>

        </div>

        <div class="form-group row">
            <label for="email" class="col-md-3 col-form-label text-md-left">{{ __('E-Mail Address') }}</label>

            <div class="col-md-8">
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="@if($user->email){{$user->email}}@else{{ old('email') }}@endif" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-md-3 col-form-label text-md-left">{{ __('Password') }}</label>

            <div class="col-md-8">
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" @if(!$user->password) required @endif>

                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert"><strong>{{ $errors->first('password') }}</strong>
            </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-3 col-form-label text-md-left">{{ __('Confirm Password') }}</label>

            <div class="col-md-8">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" @if(!$user->password) required @endif>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-md-3 col-form-label text-md-left">User Role</label>

            <div class="col-md-8">
                <select name="role" class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}">
                    <option value="">Select Role</option>
                    @foreach($roles as $key => $role)
                        <option value="{{$role->name}}" @if($user->hasRole($role->name)) selected @endif >{{$role->name}}</option>
                    @endforeach
                </select>

                @if ($errors->has('role'))
                    <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('role') }}</strong>
            </span>
                @endif
            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-3 col-form-label text-md-left">User Image</label>

            <div class="col-md-8">
                <input id="photo" type="file" class="form-control{{ $errors->has('photo') ? ' is-invalid' : '' }}"
                       name="photo" accept="image/*" onchange="readURL(this);" value="@if($user->photo){{$user->photo}}@else{{ old('photo') }}@endif"
                       autofocus>

                @if ($errors->has('photo'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('photo') }}</strong>
                    </span>
                @endif
                @if (!empty($user->photo))
                    <img id="image" src="{{URL::to('public/images/'.$user->photo)}}" style="width: 100px; height: 100px; margin-top: 5px;" >
                @else
                    <img id="image" src="{{asset('images/imguploadicon.svg')}}" style="width: 100px; height: 100px; margin-top: 5px;" >
                @endif
            </div>
        </div>

    </div>
    <div class="col-md-1"></div>
</div>

@push('js')
    <!--Form Validatin Script-->
    <script src="{{asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script>

        $(document).ready(function () {

            $("#personal-info").validate();

            // validate signup form on keyup and submit
            $("#usersForm").validate({
                rules: {
                    name: "required",
                },
                messages: {
                    name: "Please enter your name",
                }
            });

        });

        function readURL(input){
            if (input.files && input.files[0]){
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


    </script>
@endpush