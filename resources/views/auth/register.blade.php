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
    <?php header('X-Frame-Options: DENY'); ?>
    <title>{{ config('app.name', 'সেপকস') }} - রেজিস্টার</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('frontend/assets/bootstrap/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/bootstrap/style.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/responsive.css')}}" rel="stylesheet">
</head>
<body class="scroll">


<style>
    body {
        background-image: url('/frontend/assets/images/login.png');
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

    .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #fff;
    }
</style>
<div class="container" style="min-height: 100vh">
    <div class="row">
        <div class="col-md-5 login-form">
            <div>
                <img src="{{asset('frontend/assets/images/logo/logo.png')}}">
                <h1>মূল ওয়েবসাইট এ প্রবেশ এর জন্য নিবন্ধন করুন</h1>
                <form method="POST" action="{{ route('register.store') }}">
                    @csrf
                    <div class="input-group form-group mb-3">
                        <select name="club" id="" class="form-control @error('club') is-invalid @enderror" required=""
                                value="{{ old('club') }}">
                            <option></option>
                            @foreach ($clubs as $item)
                                <option value="{{$item->id}}">{{$item->name_bn}}</option>
                            @endforeach
                        </select>
                        <span class="floating-label">ক্লাবের নাম </span>
                    </div>
                    <div class="input-group form-group mb-3">
                        <select name="area" id="" class="form-control @error('area') is-invalid @enderror" required=""
                                value="{{ old('area') }}">
                            <option></option>
                            @foreach ($areas as $item)
                                <option value="{{$item->id}}">{{$item->name_bn}}</option>
                            @endforeach
                        </select>
                        <span class="floating-label">অঞ্চলের নাম </span>
                    </div>
                    <div class="input-group form-group mb-3">
                        <input id="text" type="text" class="form-control @error('username') is-invalid @enderror"
                               name="username" required="" value="{{ old('username') }}">
                        <span class="floating-label">সদস্যর নাম </span>
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="input-group form-group mb-3">
                        <input id="text" type="text" class="form-control @error('spouse') is-invalid @enderror"
                               name="spouse" required="" value="{{ old('spouse') }}">
                        <span class="floating-label">স্পাউসের নাম </span>
                        @error('spouse')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="input-group form-group mb-3 pull-left" style="width: 22%;">
                            <select name="initial" id="" class="form-control" required=""
                                    style="border-right: 0px !important;">
                                <option></option>
                                <option value="ba">বিএ</option>
                                <option value="bss">বিএসএস</option>
                            </select>
                            <span class="floating-label">বিএ নং </span>
                        </div>
                        <div class="input-group input-group-merge pull-left" style="width: 28%;margin-right: 2%;">
                            <input type="text" class="form-control @error('ba_no') is-invalid @enderror" name="ba_no"
                                   required="" placeholder="000" value="{{ old('ba_no') }}">
                        </div>
                        <div class="input-group form-group mb-3" style="width: 48%;">
                            <select name="rank" id="" class="form-control @error('rank') is-invalid @enderror"
                                    required=""
                                    value="{{ old('rank') }}">
                                <option></option>
                                @foreach ($ranks as $item)
                                    <option value="{{$item->id}}">{{$item->name_bn}}</option>
                                @endforeach
                            </select>
                            <span class="floating-label">পদবী </span>
                            @error('rank')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="input-group form-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                               name="email" required="" value="{{ old('email') }}">
                        <span class="floating-label">সদস্যের ইমেইল </span>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="form-row mb-3">
                        <div class="input-group input-group-merge pull-left" style="width: 48.5%;margin-right: 2%;">
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password"
                                   required="" autocomplete="off">
                            <span class="floating-label">পাসওয়ার্ড</span>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="input-group input-group-merge" style="width: 48.5%;">
                            <input id="password" type="password" class="form-control" name="password_confirmation"
                                   required="" autocomplete="off">
                            <span class="floating-label">কনফার্ম পাসওয়ার্ড</span>
                        </div>
                    </div>

                    <div class="form-group mb-0 text-center">
                        <button class="s-btn btn btn-block" type="submit"> নিবন্ধন</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript -->
<script src='{{asset('frontend/assets/js/jquery-3.5.1.min.js')}}'></script>
<script src="{{asset('frontend/assets/bootstrap/bootstrap.bundle.min.js')}}"></script>

</body>
</html>

