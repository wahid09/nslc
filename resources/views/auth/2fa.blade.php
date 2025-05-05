<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <meta http-equiv="Content-Security-Policy"
          content="script-src 'self' cdn.datatables.net cdnjs.cloudflare.com code.jquery.com stackpath.bootstrapcdn.com 'unsafe-inline';">

    <?php //header('X-Frame-Options: DENY'); ?>

    <title>{{ config('app.name', 'সেপকস') }} - লগিন</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/responsive.css')}}" rel="stylesheet">
</head>
<body class="scroll">
<style>
    body {
        background-image: url('{{asset('frontend/assets/images/login.png')}}');
        background-size: cover;
        background-position: center;
    }

    body:before {
        background: linear-gradient(112deg, rgb(184 29 29 / 0.85) 58.5%, transparent 12%);
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: -1;
    }

    .log-head h4 {
        color: white;
    }

    .forgotPassword {
        text-align: right;
    }

    .login-form img {
        float: left;
        margin-right: 10px;
    }

    .reg p {
        color: white;
    }

    .reg p a {
        font-size: 20px;
        color: whitesmoke;
    }

    .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: .25rem;
        font-size: 100%;
        color: #fff;
    }
    .hepLine{
        color: #fff;
        margin-bottom: 0px;
    }

</style>
<div class="container" style="min-height: 100vh">
    <div class="row">
        <div class="col-md-12 login-form">
            {{-- <div> --}}
                {{-- <img src="{{asset('frontend/assets/images/logo/logo.png')}}"> --}}
                {{-- <h1>মুল ওয়েবসাইট এ প্রবেশের জন্য লগইন করুন</h1> --}}
                <form method="POST" action="{{ route('2fa.post') }}">
                        @csrf

                        <p class="text-center text-light"><b>
                                {{-- @if(!empty(auth()->user()->email))
                                    {{ auth()->user()->email }}
                                @endif --}}
{{--                                {{ substr(auth()->user()->email, 0, 5) . '******' . substr(auth()->user()->email,  -10) }}--}}
                                <strong> If you log in using your email address, the login code will be sent to your registered email. If you log in using your membership number, the code will be sent to your registered mobile number.</strong>
                            </b></p>

                        @if ($message = Session::get('success'))
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-success alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($message = Session::get('error'))
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="alert alert-danger alert-block">
                                        <button type="button" class="close" data-dismiss="alert">×</button>
                                        <strong>{{ $message }}</strong>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-group row">
                            <label for="code" class="col-md-4 col-form-label text-md-right text-light">Code</label>

                            <div class="col-md-6">
                                <input id="code" type="number" class="form-control @error('code') is-invalid @enderror"
                                       name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>

                                @error('code')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <a class="btn btn-link text-light" href="{{ route('2fa.resend') }}">Resend Code?</a>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Submit
                                </button>

                            </div>
                        </div>
                    </form>
            {{-- </div> --}}
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript -->
<script src='{{asset('frontend/assets/js/jquery-3.5.1.min.js')}}'></script>
<script src="{{asset('frontend/assets/bootstrap/bootstrap.bundle.min.js')}}"></script>
@include('sweetalert::alert')
</body>
</html>
