<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title') - {{ config('app.name', 'Army Ladies Club') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/backend/images/logo/logo.PNG') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('assets/ladiesclub/backend/images/logo/logo.PNG') }}" type="image/x-icon">
    <meta name="description" content="Army Ladies Club">
    <meta name="keywords" content="Army Ladies Club">
    <meta name="author" content="Trust Innovation Limited">
{{--    <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'nonce-abc123' cdn.datatables.net cdnjs.cloudflare.com code.jquery.com stackpath.bootstrapcdn.com;">--}}

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ladiesclub/backend/css/fontawesome.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ladiesclub/backend/css/icofont.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ladiesclub/backend/css/themify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ladiesclub/backend/css/flag-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ladiesclub/backend/css/feather-icon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ladiesclub/backend/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ladiesclub/backend/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ladiesclub/backend/css/responsive.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('assets/ladiesclub/backend/css/color-1.css') }}" media="screen">
    <script src="{{ asset('assets/ladiesclub/backend/js/toastr.min.js') }}"></script>
    <link rel='stylesheet' href="{{asset('frontend/assets/css/jquery.fancybox.min.css')}}">

{{--    <style nonce="{{ csp_nonce() }}">--}}
        <style>
        @media (max-width: 576px) {
            #nav-clr {
                margin-top: 42px;
            }
        }

        @media (max-width: 768px) {
            #nav-clr {
                margin-top: 42px;
            }
        }

        @media (max-width: 992px) {
            #nav-clr {
                margin-top: 42px;
            }
        }

        @media (min-width: 576px) {

            #img1 {
                margin-left: 95px;
            }
        }

        @media (min-width: 768px) {

            #img1 {
                margin-left: 95px;
            }
        }

        @media (min-width: 992px) {

            #img1 {
                margin-left: 95px;
            }
        }

        #img1 {
            /* margin-left: 95px; */
            height: 77px;
        }

        #stl_1 {
            font-size: 18px;
            font-weight: bold;
        }

        #stl_2 {
            display: none;
        }

        #bg-clr {
            background-color: rgb(243, 214, 255);
        }

        #hd-clr {
            background-color: #A55AA5;
        }

        #nav-clr {
            background-color: #A55AA5;
        }

        #ftr-clr {
            background-color: #A55AA5;
        }

        #cd-clr-1 {
            background-color: #44CFEA;
        }

        #cd-clr-2 {
            background-color: #02e2c3;
        }

        #cd-clr-3 {
            background-color: #FF9296;
        }

        #cd-clr-4 {
            background-color: #D78AFF;
        }

        #pbw-clr {
            background-color: #ae76ae;
        }

        .css1 {
            margin-left: 100px;
            height: 60px;
        }

        .css2 {
            margin-left: 100px;
            height: 60px;
        }

        .css3 {
            font-size: 18px;
            font-weight: "bold";
        }

        .css4 {
            display: none;
        }
    </style>

    @stack('css')
</head>

<body>
<div class="loader-wrapper">
    <div class="theme-loader">
        <div class="loader-p"></div>
    </div>
</div>
<div class="page-wrapper" id="pageWrapper">
    @include('ladiesClub.partials.header')
    <div class="page-body-wrapper horizontal-menu">
        @php
            //$member = Auth::guard('user')->user();
        @endphp
        @include('ladiesClub.partials.left_sidebar')
        <div class="page-body">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-sm-6">
                            <h3>@yield('title')</h3>
                            <ol class="breadcrumb">
{{--                                <li class="breadcrumb-item"><a href="">@yield('main_menu')</a></li>--}}
{{--                                <li class="breadcrumb-item">@yield('active_menu')</li>--}}
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid dashboard-default-sec">
                @yield('content')
            </div>
        </div>

@include('ladiesClub.partials.footer')
