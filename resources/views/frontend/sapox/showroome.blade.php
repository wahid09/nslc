@extends('layouts.frontend.app')
@push('css')
<style nonce="abc123">
    .headline {
    font-size: 25px;
    font-weight: 400;
    margin: 20px 0px;
}
    .showroom .content h3, .showroom .content p {
    color: #fff !important;
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
@section('title') শোরুম @endsection
@section('content')
    <section class="bannerhead" style="margin-bottom:0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1>সেপকস শোরুম</h1>
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
                    <a href="{{url('calender-sapox/'.$area->id)}}" class="tab-btn">কর্মসূচী ক্যালেন্ডার</a>
                    <a href="{{url('others/'.$area->id)}}" class="tab-btn">নোটিশ/বিজ্ঞপ্তি</a>
                    <a href="{{url('gallery-sapox/'.$area->id)}}"
                       class="tab-btn {{ Request::is('gallery-sapox*') ? 'active' : ''}}">গ্যালারী</a>
                    {{--                    <a href="{{url('showroome-sapox/'.$area->id)}}"--}}
                    {{--                       class="tab-btn {{ Request::is('showroome-sapox*') ? 'active' : ''}}">সেনাসম্ভার/সেনামালঞ্চ</a>--}}
                    <a href="{{url('showroome-sapox/'.$area->id)}}"
                       class="tab-btn {{ Request::is('showroome-sapox*') ? 'active' : ''}}">শো-রুম সমূহ </a>
                    <a href="{{url('product-sapox/'.$area->id)}}"
                       class="tab-btn {{ Request::is('product-sapox*') ? 'active' : ''}}">পন্য</a>
                    <a href="{{url('kolkontho-club/'.$area->id)}}" class="tab-btn">কলকণ্ঠ ক্লাব</a>
                </div>
            </div>
        </div>
    </section>



    <div class="container" style="margin-top: 30px;">
        <div class="row">
            @foreach($showroomes as $item)
                <div class="col-md-4 showroom-block">
                    <div class="showroom" style="background-image: url('{{asset('storage/showrooms/'.$item->image)}}')">
                        <div class="content">
                            <h3>{{ $item->title}}</h3>
                            <p>{{$item->house}}, {{$item->road}}, {{$item->area}}</p>
                            <p>যোগাযোগঃ {{$item->phone}}</p>
                        </div>
                    </div>
                </div>
            @endforeach


{{--            <div class="col-md-12 text-center">--}}
{{--                <a href="#" class="aro">আরো দেখুন <i class="fa fa-long-arrow-right"></i></a>--}}
{{--            </div>--}}
            <br><br><br><br><br><br>


        </div>
    </div>
@endsection
@push('js')

@endpush
