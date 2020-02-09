<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Reset</title>
    <link rel="stylesheet" href="{{asset('auth/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('auth/style.css')}}">
</head>
<body>
<div id="login">
    <div class="container">
        <div id="login-row" class="row justify-content-center align-items-center">
            <div id="login-column" class="col-md-6">
                <div id="login-box" class="col-md-12">

                    <form id="login-form" class="form" method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <h3 class="text-center text-info">Password Reset</h3>
                        <div class="form-group">
                            <label for="username" class="text-info">Email:</label><br>
                            <input id="username" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}"
                                   required autofocus placeholder="Email">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>

                        <div class="form-group">



                            <button type="submit" class="col-md-5 btn btn-secondary">
                                {{ __('Login') }}
                            </button>


                        </div>

                    </form>



                </div>
            </div>
        </div>
    </div>
</div>
<script rel="stylesheet" href="{{asset('auth/bootstrap.min.js')}}"></script>
</body>
</html>