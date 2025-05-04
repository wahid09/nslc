<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- <meta http-equiv="Content-Security-Policy" content="script-src 'self' cdn.datatables.net cdnjs.cloudflare.com code.jquery.com stackpath.bootstrapcdn.com 'unsafe-inline';"> -->
    <?php //header('X-Frame-Options: DENY'); ?>
{{--    <meta http-equiv="Content-Security-Policy"--}}
{{--          content="script-src 'self' 'nonce-abc123' cdn.datatables.net cdnjs.cloudflare.com code.jquery.com stackpath.bootstrapcdn.com;">--}}
    <?php header('X-Frame-Options: DENY'); ?>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'সেপকস') }} - @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/favicon.png') }}">
    <!-- Bootstrap core CSS -->
{{--    <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.css')}}" rel="stylesheet">--}}
    <link href="{{asset('frontend/assets/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/assets/owlcarousel/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/owlcarousel/owl.theme.default.min.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel='stylesheet' href="{{asset('frontend/assets/css/animate.css')}}">
    <link rel='stylesheet' href="{{asset('frontend/assets/css/jquery.fancybox.min.css')}}">
    <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/responsive.css')}}" rel="stylesheet">
    <style nonce="abc123">
        /* .footer {
        background-color: #2F3241;
        margin-top: 100px;
        max-height: 200px;
    } */
        .holder {
            /* height: 250px; */
            overflow: hidden;
            padding: 10px;
        }

        .holder .mask {
            position: relative;
            left: 0px;
            top: 10px;
            /* height: 200px; */
            overflow: hidden;
            max-height: 80px;
        }
    </style>
    @stack('css')
</head>
<body class="scroll">
@include('layouts.frontend.partials.header')
@yield('content')
@include('layouts.frontend.partials.footer')
<!-- Bootstrap core JavaScript -->
<script src="{{asset('frontend/assets/js/jquery-3.5.1.min.js')}}"></script>
{{--<script src="{{asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>--}}
<script src="{{asset('frontend/assets/bootstrap/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/assets/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.mousewheel.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.tinycarousel.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/main.js')}}"></script>
<script src="{{asset('frontend/assets/js/wow.min.js')}}"></script>
<!-- Scripts -->
@stack('js')
</body>
</html>
