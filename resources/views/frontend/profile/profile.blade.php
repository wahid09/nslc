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
.res{
border-radius: 2rem;
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
                           class="list-group-item-action list-group-item {{Request::is('user-profile*') ? 'active' : ''}}">প্রোফাইল</a>
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
                            ব্যবহারকারীর তথ্য
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    @if(!empty($users->image))
                                        <img class="res" src="{{asset('storage/users/'.$users->image)}}" alt="">
                                    @else
                                        <img src="{{asset('frontend/assets/images/user/avatar.jpg')}}" alt="" style="width: 290px; height: 250px;">
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <table class="table">
                                        <thead>

                                        </thead>
                                        <tbody>
                                        <tr>
                                            <th scope="row">নাম:</th>
                                            <td>@if(!empty($users->name_bn)){{$users->name_bn}} @endif</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">স্বামী/স্ত্রীর নাম:</th>
                                            <td>@if(!empty($users->spouse)) {{$users->spouse}} @endif</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">ই-মেইল:</th>
                                            <td>@if(!empty($users->email)) {{$users->email}} @endif</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">পদমর্যাদা:</th>
                                            <td>@if(!empty($users->rank_name)) {{$users->rank_name}} @endif</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">অঞ্চল :</th>
                                            <td>@if(!empty($users->area_name)) {{$users->area_name}} @endif</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
