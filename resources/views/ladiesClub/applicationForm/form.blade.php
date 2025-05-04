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
    {{--    <meta http-equiv="Content-Security-Policy"--}}
    {{--          content="script-src 'self' cdn.datatables.net cdnjs.cloudflare.com code.jquery.com stackpath.bootstrapcdn.com 'unsafe-inline';">--}}
    <meta http-equiv="Content-Security-Policy"
          content="script-src 'self' 'nonce-abc123' cdn.datatables.net cdnjs.cloudflare.com code.jquery.com stackpath.bootstrapcdn.com;">

    <?php header('X-Frame-Options: DENY'); ?>
    <title>{{ config('app.name', 'সেপকস') }} - রেজিস্টার</title>
    <!-- Bootstrap core CSS -->
    <link href="{{asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/assets/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('assets/select/select2.min.css')}}" rel="stylesheet">
</head>
<body class="scroll">


<style nonce="abc123">
    body {
        /*background-image: url('/frontend/assets/images/login.png');*/
        /*background-size: cover;*/
        /*background-position: center;*/
    }

    body:before {
        /*background: linear-gradient(112deg, rgb(184 29 29 / 0.85) 58.5%, transparent 12%);*/
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: -1;
    }

    .invalid-feedback {
        display: inline-block;
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #f10808;
    }
</style>
<div class="container" style="min-height: 100vh">
    <div class="row">
        <div class="col-md-12">
            <img src="{{asset('frontend/assets/images/logo/logo.png')}}">
            <h1>মূল ওয়েবসাইট এ প্রবেশ এর জন্য নিবন্ধন করুন</h1>
            <form method="POST" action="{{ route('application.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-header text-center text-uppercase">
                        <span class="">Member's Information</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Member Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           name="name"
                                           placeholder="Enter Member's Name" required value="{{old('name')}}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>BA No. (If Applicable) <span class="text-danger">* অনুগ্রহ করে "BA-"
                                                ছাড়া BA নম্বর লিখুন। শুধুমাত্র সংখ্যার অংশ লিখুন।</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">BA-</span>
                                        <input class="form-control @error('member_ba_no') is-invalid @enderror"
                                               type="text" name="member_ba_no"
                                               autocomplete="off" placeholder="Example: 7896"
                                               value="{{old('member_ba_no')}}"
                                               fdprocessedid="cc6mw">
                                    </div>
                                    {{--                                        <span id="error_member_ba_no" class="text-danger error_field"></span>--}}
                                    @error('member_ba_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Member Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input class="form-control @error('member_email') is-invalid @enderror"
                                           type="email" name="member_email" autocomplete="off"
                                           placeholder="Enter Email Address" value="{{old('member_email')}}"
                                           fdprocessedid="w2usf5" required>
                                    @error('member_email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Member Name (In Bangla)
                                    </label>
                                    <input type="text" class="form-control @error('name_bn') is-invalid @enderror"
                                           name="name_bn"
                                           placeholder="সদস্যের নাম লিখুন" value="{{old('name_bn')}}">
                                    @error('name_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="required">Member Phone No. <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control @error('member_phone_no') is-invalid @enderror"
                                           type="text" name="member_phone_no"
                                           autocomplete="off" placeholder="Example: 01700000000"
                                           value="{{old('member_phone_no')}}"
                                           fdprocessedid="hhrq7k" required>
                                    {{--                                        <span id="error_member_phone_no" class="text-danger error_field"></span>--}}
                                    @error('member_phone_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="required">Select Area for Ladies Club <span
                                            class="text-danger">*</span></label>
                                    <select name="area_id" id="area_id"
                                            class="areaSelect form-control @error('area_id') is-invalid @enderror"
                                            value="{{ old('area_id') }}" required>
                                        <option></option>
                                        @foreach ($areas as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="required">Blood Group <span
                                            class="text-danger">*</span></label>
                                    <select name="blood_group_id"
                                            class="bloodSelect form-control @error('blood_group_id') is-invalid @enderror"
                                            value="{{ old('blood_group_id') }}" required>
                                        <option></option>
                                        @foreach ($bloodGroups as $item)
                                            <option value="{{$item->id}}">{{$item->group_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-center text-uppercase">
                        <span class="">Spouse's Information</span>
                    </div>
                    <div class="card-body">
                        {{--                        <div class="headline text-center">Spouse's Information</div>--}}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Husband's Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           class="form-control @error('spouse_name_en') is-invalid @enderror"
                                           name="spouse_name_en"
                                           placeholder="Enter Husband's Name" value="{{old('spouse_name_en')}}">
                                    @error('spouse_name_en')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>BA No. (If Applicable) <span class="text-danger">* অনুগ্রহ করে "BA-"
                                                ছাড়া BA নম্বর লিখুন। শুধুমাত্র সংখ্যার অংশ লিখুন।</span></label>
                                    <div class="input-group">
                                        <span class="input-group-text">BA-</span>
                                        <input class="form-control @error('spouse_ba_no') is-invalid @enderror"
                                               type="text" name="spouse_ba_no"
                                               autocomplete="off" placeholder="Example: 7896"
                                               value="{{old('spouse_ba_no')}}"
                                               fdprocessedid="cc6mw" required>
                                    </div>
                                    {{--                                        <span id="error_member_ba_no" class="text-danger error_field"></span>--}}
                                    @error('spouse_ba_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="required">Working Unit <span
                                            class="text-danger">*</span></label>
                                    <select name="unit_id" id=""
                                            class="unitSelect form-control @error('unit_id') is-invalid @enderror"
                                            value="{{ old('unit_id') }}" required>
                                        <option></option>
                                        @foreach ($units as $item)
                                            <option value="{{$item->id}}">{{$item->unit_name_en}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Husband's Name (In Bangla)
                                    </label>
                                    <input type="text"
                                           class="form-control @error('spouse_name_bn') is-invalid @enderror"
                                           name="spouse_name_bn"
                                           placeholder="স্বামীর নাম লিখুন" value="{{old('spouse_name_bn')}}">
                                    @error('spouse_name_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="required">Rank <span
                                            class="text-danger">*</span></label>
                                    <select name="rank_id" id=""
                                            class="rankSelect form-control @error('rank_id') is-invalid @enderror"
                                            value="{{ old('rank_id') }}" required>
                                        <option></option>
                                        @foreach ($ranks as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="required">Phone No. <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control @error('spouse_phone_number') is-invalid @enderror"
                                           type="text" name="spouse_phone_number"
                                           autocomplete="off" placeholder="Example: 01700000000"
                                           value="{{old('spouse_phone_number')}}"
                                           fdprocessedid="hhrq7k" required>
                                    {{--                                        <span id="error_member_phone_no" class="text-danger error_field"></span>--}}
                                    @error('spouse_phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header text-center text-uppercase">
                        <span class="">Upload Images</span>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">Member's Picture <span class="text-danger">*</span></label>
                                    <input class="form-control-file" type="file" name="member_image" accept="image/*"
                                           required value="{{old('member_image')}}">
                                    <span id="error_avatar" class="text-danger error_field"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="required">Member's Signature <span
                                            class="text-danger">*</span></label>
                                    <input class="form-control-file" type="file" name="member_signature"
                                           accept="image/*" required value="{{old('member_signature')}}">
                                    <span id="error_signature" class="text-danger error_field"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-center">
                    <button class="btn btn-primary mb-5" type="submit" id="form_submission_button"
                            fdprocessedid="ixym4f">Save
                        Information
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript -->
<script src='{{asset('frontend/assets/js/jquery-3.5.1.min.js')}}'></script>
<script src="{{asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/select/select2.min.js')}}"></script>
<script nonce="abc123">
    $(document).ready(function () {
        $('.bloodSelect').select2({
            placeholder: "Select Option",
            allowClear: true
        });
    });
    $(document).ready(function () {
        $('.areaSelect').select2({
            placeholder: "Select Option",
            allowClear: true
        });
    });
    $(document).ready(function () {
        $('.rankSelect').select2({
            placeholder: "Select Option",
            allowClear: true
        });
    });
    $(document).ready(function () {
        $('.unitSelect').select2({
            placeholder: "Select Option",
            allowClear: true
        });
    });
</script>

</body>
</html>
