{{--@extends('layouts.frontend.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Reset Password') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('password.update') }}">--}}
{{--                        @csrf--}}

{{--                        <input type="hidden" name="token" value="{{ $token }}">--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Reset Password') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>সেপকস</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/vendor/bootstrap/css/font-awesome.min.css')}}" rel="stylesheet">
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

/*<<<<<<< HEAD*/
/*    .log-head h4 {*/
/*        color: white;*/
/*    }*/
/*=======*/
    .log-head h5 {
        color: white;
    }
    .invalid-feedback {
    display: none;
    width: 100%;
    margin-top: .25rem;
    font-size: 80%;
    color: #f9f5f5;
}
/*>>>>>>> e9d0a24af8f3ff6fa32a5c514e16de13b68fcf91*/

    .forgotPassword {
        text-align: right;
    }
</style>
<div class="container" style="min-height: 75vh">
    <div class="row">
        <div class="col-md-5 login-form">
            <div class="log-head">
{{--<<<<<<< HEAD--}}
{{--                <h4>মুল ওয়েবসাইট এ প্রবেশের জন্য লগইন করুন</h4>--}}
{{--                <form  method="POST" action="{{ route('password.update') }}">--}}
{{--                    @csrf--}}
{{--=======--}}
                <h5>পাসওয়ার্ড পুনরুদ্ধার জন্য সঠিক ই-মেইল ও পাসওয়ার্ড ব্যবহার করুন</h5>
                <form  method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
{{-->>>>>>> e9d0a24af8f3ff6fa32a5c514e16de13b68fcf91--}}
                    <div class="input-group form-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <span class="floating-label">ই-মেইল </span>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge">
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" required autocomplete="password">
{{--<<<<<<< HEAD--}}
{{--                            <span class="floating-label">পাসওয়ার্ড</span>--}}
{{--=======--}}
                            <span class="floating-label">নতুন পাসওয়ার্ড</span>
{{-->>>>>>> e9d0a24af8f3ff6fa32a5c514e16de13b68fcf91--}}
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group input-group-merge">
                            <input id="password-confirm" type="password"
                                   class="form-control"
                                   name="password_confirmation" required autocomplete="new-password">
                            <span class="floating-label">পুনরায় পাসওয়ার্ড</span>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-center">
{{--<<<<<<< HEAD--}}
{{--                        <button class="s-btn btn btn-block" type="submit">পাসওয়ার্ড পুনঃস্থাপন</button>--}}
{{--=======--}}
                        <button class="s-btn btn btn-block" type="submit">পাসওয়ার্ড পুনরুদ্ধার</button>
{{-->>>>>>> e9d0a24af8f3ff6fa32a5c514e16de13b68fcf91--}}
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript -->
<script src='{{asset('frontend/assets/js/jquery-2.2.4.min.js')}}'></script>
<script src="{{asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('frontend/assets/js/jquery.mousewheel.js')}}"></script>
<script src="{{asset('frontend/assets/js/main.js')}}"></script>

</body>
</html>

