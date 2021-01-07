<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fa/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/auth-user.css') }}">
</head>
<body>
    
<div class="container">
    <div class="wrap">
        <div class="rata-tengah">
            <div class="logo">
                <img src="{{ asset('images/logo-black.png') }}" alt="DSW Logo">
            </div>
        </div>
        @yield('content')
    </div>
</div>

<script src="{{ asset('js/base.js') }}"></script>
@yield('javascript')

</body>
</html>