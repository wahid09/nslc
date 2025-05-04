@extends('layouts.frontend.app')
@push('css')
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
        .btn-primary:hover{
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
                            পাসওয়ার্ড পরিবর্তন
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-8">
                                    <form action="{{url('password-change')}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label for="current_pass">বর্তমান পাসওয়ার্ড</label>
                                            <input id="current_pass" type="password"
                                                   class="form-control @error('current_pass') is-invalid @enderror"
                                                   name="current_pass" placeholder="আপনার বর্তমান পাসওয়ার্ডটি দিন">

                                            @error('current_pass')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="password">নতুন পাসওয়ার্ড</label>
                                            <input id="password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password" required autocomplete="password" autofocus
                                                   placeholder="নতুন পাসওয়ার্ড দিন">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="confirm_password">কনফার্ম পাসওয়ার্ড</label>
                                            <input id="confirm_password" type="password"
                                                   class="form-control @error('password') is-invalid @enderror"
                                                   name="password_confirmation" required autocomplete="password"
                                                   autofocus placeholder="নতুন পাসওয়ার্ডটি পূনরায় দিন">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
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
@include('sweetalert::alert')
@endpush
