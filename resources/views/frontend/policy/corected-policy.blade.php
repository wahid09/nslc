@extends('layouts.frontend.app')
@push('css')
    <style>
        .r-btn {
            border-radius: 30rem;
        }

        .notice-layer h3 {
            font-size: revert;
            letter-spacing: 0px;
            color: #292929;
            display: block;
            border-bottom: 1px solid #B81D1D;
            padding-bottom: 14px;
            margin-bottom: 16px;
        }
    </style>
@endpush
@section('title') সংশোধিত নীতিমালা @endsection
@section('content')
    <section class="bannerhead">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1>সংশোধিত নীতিমালা</h1>
                </div>
            </div>
        </div>
        <div class="breadcumb">
            <p>হোম / সংশোধিত নীতিমালা</p>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @foreach($policies as $policy)
                        <div class="notice-layer">
                            <h3><img
                                    src="{{asset('frontend/assets/images/bullet.png')}}">&nbsp;{{ $policy->club_name  }}
                            </h3>
                            {{--                                <p>{{$policy->club_name}}</p>--}}
                            <div class="c-text">
                                {{$policy->title}}
                            </div>
                            @if(!empty($policy->attachment))
                                <button class="btn btn-success r-btn" data-fancybox=''
                                        href="{{asset('storage/policy/'.$policy->attachment)}}"><i
                                        class="fa fa-eye"></i></button>
                                <a href="{{url('filedpwmload/'.$policy->attachment)}}"><i
                                        class="fa fa-download"></i></a>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
