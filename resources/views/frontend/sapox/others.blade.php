@extends('layouts.frontend.app')
@push('css')
    <style nonce="abc123">
        .main-area {
            background-color: #F5F5F5;
        }

        .ptext {
            text-align: center;
        }

        .r-btn {
            border-radius: 20rem;
        }

        .headline {
            font-size: 25px;
            font-weight: 400;
            margin: 20px 0px;
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

        .c-text, .c-text p {
            font-family: sr;
            line-height: 25px;
            font-weight: 400;
            color: #4c4c4c;
        }
        .breadcumb p {
            margin-bottom: 0;
            padding: 4px 0;
            color: #0a0a0a;
        }

        .area-work p {
            color: #080808;
            position: absolute;
            padding: 4px 24px;
            right: 0;
            bottom: -17px;
            border-bottom-right-radius: 15px;
        }
        .tab-btn.active, .tab-btn:hover {
    background-color: #B81D1D;
    color: #060606;
}
    </style>
@endpush
@section('title') অন্যান্য @endsection
@section('content')
    <section class="bannerhead" style="margin-bottom:0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1>অন্যান্য </h1>
                </div>
            </div>
        </div>
        <div class="breadcumb sbgcolor">
            <p>হোম / সেপকস ({{$area->name_bn}})</p>
        </div>
    </section>

    <section style="margin-top: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 tab-parent sapox-tab">
                    <a href="{{url('details-sapox/'.$area->id)}}"
                       class="tab-btn {{ Request::is('details-sapox*') ? 'active' : ''}}"> আমাদের সম্পর্কে</a>
                    <a href="{{url('calender-sapox/'.$area->id)}}"
                       class="tab-btn {{ Request::is('calender-sapox*') ? 'active' : ''}}">কর্মসূচী ক্যালেন্ডার</a>
                    <a href="{{url('others/'.$area->id)}}" class="tab-btn {{ Request::is('others*') ? 'active' : ''}}">নোটিশ/বিজ্ঞপ্তি</a>
                    <a href="{{url('gallery-sapox/'.$area->id)}}"
                       class="tab-btn {{ Request::is('gallery-sapox*') ? 'active' : ''}}">গ্যালারী</a>
                    {{--                    <a href="{{url('showroome-sapox/'.$area->id)}}"--}}
                    {{--                       class="tab-btn {{ Request::is('showroome-sapox*') ? 'active' : ''}}">সেনাসম্ভার/সেনামালঞ্চ</a>--}}
                    <a href="{{url('showroome-sapox/'.$area->id)}}"
                       class="tab-btn {{ Request::is('showroome-sapox*') ? 'active' : ''}}">শো-রুম সমূহ </a>
                    <a href="{{url('product-sapox/'.$area->id)}}"
                       class="tab-btn {{ Request::is('product-sapox*') ? 'active' : ''}}">পন্য</a>
                    <a href="{{url('kolkontho-club/'.$area->id)}}"
                       class="tab-btn {{ Request::is('kolkontho-club*') ? 'active' : ''}}">কলকণ্ঠ ক্লাব</a>
                </div>
            </div>
        </div>
    </section>

    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-md-12">
                @if(count($notices)>0)
                    @foreach($notices as $notice)
                        <div class="col-md-12">
                            <div class="notice-layer">
                                <h3><img
                                        src="{{asset('frontend/assets/images/bullet.png')}}">&nbsp;{{ $notice->title_bn  }}
                                </h3>
                                <p>{{ $notice->notice_date  }}</p>
                                <div class="c-text">
                                    {!! $notice->description_bn !!}
                                    @if(!empty($notice->attachment))
                                        {{-- <iframe src ="{{ asset('storage/notices/'.$notice->attachment) }}" width="1000px" height="600px"></iframe> --}}
                                    @endif
                                </div>

                                @if(!empty($notice->attachment))
                                    <button class="btn btn-success r-btn" data-fancybox=''
                                            href="{{asset('storage/notices/'.$notice->attachment)}}"><i
                                            class="fa fa-eye"></i></button>
                                    <a href="{{url('notice-download/'.$notice->attachment)}}"><i
                                            class="fa fa-download"></i></a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

@endsection
@push('js')
@endpush
