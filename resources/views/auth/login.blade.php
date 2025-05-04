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
          content="script-src 'self' 'nonce-abc123' cdn.datatables.net cdnjs.cloudflare.com code.jquery.com stackpath.bootstrapcdn.com;">

    <?php header('X-Frame-Options: DENY'); ?>

    <title>{{ config('app.name', 'সেপকস') }} - লগিন</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('frontend/assets/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/bootstrap/style.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/responsive.css')}}" rel="stylesheet">

</head>
<body class="scroll">
<style nonce="abc123">
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

    .hepLine {
        color: #fff;
        margin-bottom: 0px;
    }

    .membership-btn {
        background-color: #ff0097;
        border: none;
        border-radius: 30px;
        padding: 12px 24px;
        color: white;
        font-size: 18px;
        /* font-weight: bold; */
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

</style>
<div class="container" style="min-height: 100vh">
    <div class="row">
        <div class="col-md-5 login-form">
            <div>
                <img src="{{asset('frontend/assets/images/logo/logo.png')}}">
                <h1>মুল ওয়েবসাইট এ প্রবেশের জন্য লগইন করুন</h1>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="input-group form-group mb-3">
                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror"
                               name="email" value="{{ old('email') }}" required autofocus>
                        <span class="floating-label">পরিচালনা পর্ষদ/সদস্য আইডি </span>
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
                                   name="password" required autocomplete="off">
                            <span class="floating-label">পাসওয়ার্ড</span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group mb-0 text-center">
                        <button class="s-btn btn btn-block" type="submit"> লগইন</button>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="" style="color: white">হেল্প লাইন: <br/>
                                    <p class="hepLine">টেলিফোন : <a href="#"

                                                                    style="color: white">৮৮৭৮(সামরিক)</a></p>
                                    <p class="hepLine"> মোবাইল : <a href="#"

                                                                    style="color: white">০১৭৬৯-০১২২৩৮</a></p>
                            </div>
                            <div class="col-md-6 forgotPassword">
                                @if (Route::has('password.request'))
                                    <h6 style="color: white"><a href="{{ route('password.request') }}"
                                                                style="color: white">পাসওয়ার্ড পুনরুদ্ধার ?</a>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2">

                            </div>
                            <div class="col-md-8 reg">
                                <p>একাউন্ট নেই ? <a href="{{route('register.create')}}">নিবন্ধন করুন এখানে</a></p>
                            </div>
                            <div class="col-md-2">

                            </div>
                        </div>

                    </div>

                </form>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12 reg">
                        <a class="btn btn-primary membership-btn" href="{{route('application.form')}}">
                            <span>Click Here for Membership Application Form<strong>(Ladies Club Dhaka)</strong></span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript -->
<script src='{{asset('frontend/assets/js/jquery-3.5.1.min.js')}}'></script>
<script src="{{asset('frontend/assets/bootstrap/bootstrap.bundle.min.js')}}"></script>
@include('sweetalert::alert')
</body>
</html>
