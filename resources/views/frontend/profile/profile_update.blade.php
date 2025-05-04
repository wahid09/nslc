@extends('layouts.frontend.app')
@push('css')
    <link href="{{asset('assets/dropify/dropify.min.css')}}" rel="stylesheet">
    <style>
        .list-group-item.active {
            z-index: 2;
            color: #fff;
            background-color: #B81D1D;
            border-color: #B81D1D;
        }

        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: #B81D1D;
            border-bottom: 1px solid rgba(0, 0, 0, .125);
            color: white;
        }

        .btn-primary {
            color: #fff;
            background-color: #B81D1D;
            border-color: #B81D1D;
        }

        .btn-primary:hover {
            color: #fff;
            background-color: #B81D1D;
            border-color: #B81D1D;
        }
    </style>
@endpush
@section('title') প্রোফাইল @endsection
@section('content')
    <section class="bannerhead">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1>প্রোফাইল</h1>
                </div>
            </div>
        </div>
        <div class="breadcumb">
            <p>হোম / প্রোফাইল</p>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <ul class="list-group">
                        <a href="{{url('user-profile')}}"
                           class="list-group-item-action list-group-item {{Request::is('user-profile') ? 'active' : ''}}">প্রোফাইল</a>
                        <a href="{{url('user-profile-update')}}"
                           class="list-group-item-action list-group-item {{Request::is('user-profile-update*') ? 'active' : ''}}">প্রোফাইল
                            পরিবর্তন</a>
                        <a href="{{url('password-view')}}"
                           class="list-group-item-action list-group-item {{Request::is('password-view') ? 'active' : ''}}">পাসওয়ার্ড
                            পরিবর্তন</a>
                    </ul>
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            তথ্য হালনাগাদ
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8">
                                    <form action="{{url('user-profile-updated')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name_bn">নাম</label>
                                            <input type="text"
                                                   class="form-control @error('name_bn') is-invalid @enderror"
                                                   id="name_bn" name="name_bn" placeholder="নাম"
                                                   value="{{ $user->name_bn ?? old('name_bn') }}">
                                            @error('name_bn')
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="spouse">স্বামী/স্ত্রীর নাম</label>
                                            <input type="text"
                                                   class="form-control @error('spouse') is-invalid @enderror"
                                                   id="spouse" placeholder="স্বামী/স্ত্রীর নাম"
                                                   name="spouse" value="{{ $user->spouse ?? old('spouse') }}">
                                            @error('spouse')
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="rank">পদমর্যাদা</label>
                                            <select id="rank"
                                                    class="form-control @error('rank') is-invalid @enderror roleSelect"
                                                    name="rank" required autofocus>
                                                <option></option>
                                                @foreach ($ranks as $rank)
                                                    <option
                                                        value="{{$rank->id}}" {{($user->rank_id == $rank->id) ? 'selected' : ''}}
                                                    >{{ $rank->name_bn}}</option>
                                                @endforeach
                                            </select>
                                            @error('rank')
                                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="avatar">ছবি</label>
                                            <input id="avatar" type="file"
                                                   class="dropify form-control @error('image') is-invalid @enderror"
                                                   name="image" onchange="showImage(this, 'slider_photo')">
{{--                                            <span>Image size will be: 368 X 305</span>--}}
                                            @error('image')
                                            <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>

                                        {{--                                        <div class="form-group">--}}
                                        {{--                                            <label for="phone">মোবাইল নাম্বার</label>--}}
                                        {{--                                            <input id="phone" type="text"--}}
                                        {{--                                                   class="form-control @error('phone') is-invalid @enderror"--}}
                                        {{--                                                   name="phone"--}}
                                        {{--                                                   maxlength="15" placeholder="(XXX) XXX-XXXX"--}}
                                        {{--                                                   value="{{ $userInfo->phone ?? old('phone') }}">--}}

                                        {{--                                            @error('phone')--}}
                                        {{--                                            <span class="invalid-feedback" role="alert">--}}
                                        {{--                                                <strong>{{ $message }}</strong>--}}
                                        {{--                                                </span>--}}
                                        {{--                                            @enderror--}}
                                        {{--                                        </div>--}}
                                        <button type="submit" class="btn btn-primary">পরিবর্তন</button>
                                    </form>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('js')
    <script src="{{asset('assets/dropify/dropify.min.js')}}"></script>
    @include('sweetalert::alert')
    <script>
        $('.dropify').dropify();
    </script>
@endpush
