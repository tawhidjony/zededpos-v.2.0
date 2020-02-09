<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login</title>
        <link rel="stylesheet" href="{{asset('auth/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('auth/style.css')}}">
    </head>
    <body>
        <div id="login">
            <div class="container">
                <div id="login-row" class="row justify-content-center align-items-center">
                    <div id="login-column" class="col-md-6">
                        <div id="login-box" class="col-md-12">

                            <form id="login-form" class="form" method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                                @csrf
                                <h3 class="text-center text-info">Login</h3>
                                <div class="form-group">
                                    <label for="username" class="text-info">Username:</label><br>
                                    <input id="username" type="text" 
                                            class="form-control
                                            {{ $errors->has('email') ? ' is-invalid' : '' }}
                                            {{ $errors->has('name') ? ' is-invalid' : '' }}" 
                                            name="email" 
                                            @if ($errors->has('email'))
                                                value="{{ old('email') }}" 
                                            @elseif ($errors->has('name'))
                                                value="{{ old('name') }}" 
                                            @endif
                                         autofocus placeholder="Email">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ 'These user email do not match our records.' }}</strong>
                                        </span>
                                        
                                    @endif

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ 'These user name do not match our records.' }}</strong>
                                        </span>
                                        
                                    @endif
                                   
                                </div>
                                <div class="form-group">
                                    <label for="password" class="text-info">Password:</label><br>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                           name="password" required placeholder="Password">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>
                                           <input  type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        Remember me

                                    </label><br>


                                    <button type="submit" class="col-md-5 btn btn-secondary">
                                    {{ __('Login') }}
                                    </button>


                                </div>
                                <div id="register-link" class="text-right">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
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