
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--favicon-->
    
    <link rel="icon" href="{{URL::to('images/'.get_settings($settingdata, 'favicon'))}}" type="image/x-icon">   
    <title>@yield('title'){{ config('app.name', 'Zededpos') }}</title>
    @include('layouts.layout_css')
</head>
<body>

    <div class="wrapper">
        <!-- Sidebar  -->
        @include('layouts.admin_aside')

        <!-- Page Content  -->
    <div id="content">

        @include('layouts.admin_nav')

        <div class="overview-area">
            @yield('content')
        </div>
    </div>

    
    @include('layouts.layout_js')

</body>
</html>
