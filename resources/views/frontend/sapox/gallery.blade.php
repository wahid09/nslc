@extends('layouts.frontend.app')
@push('css')
<style nonce="abc123">
    .headline {
    font-size: 25px;
    font-weight: 400;
    margin: 20px 0px;
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
@section('title') গ্যালারী @endsection
@section('content')
    <section class="bannerhead" style="margin-bottom:0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1>সেপকস গ্যালারী </h1>
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
            <div class="row justify-content">
                <div class="col-md-12 tab-parent nav nav-tabs sapox-tab">
                    <a class="tab-btn active show" id="ar1-tab" data-toggle="tab" href="#ar1" role="tab"
                       aria-controls="ar1" aria-selected="true">ফটো গ্যালারি</a>
                    <a class="tab-btn" id="ar2-tab" data-toggle="tab" href="#ar2" role="tab" aria-controls="ar2"
                       aria-selected="false">ভিডিও গ্যালারি</a>
                </div>

                <div class="retab tab-pane fade  active show" id="ar1" role="tabpanel" aria-labelledby="ar1-tab">
                    <div class="col-md-12">
                        <div class="gal">
                            @foreach($galleries as $item)
                                <li data-fancybox='gallery' href="{{asset('storage/gallery/'.$item->image)}}">
                                    <figure>
                                        <img title="" alt="" src="{{asset('storage/gallery/'.$item->image)}}">
                                    </figure>
                                    <div>
        {{--                                <h1>{{ $item->title_bn }}</h1>--}}
                                    </div>
                                </li>

                            @endforeach
                        </div>
                        <br>
        {{--                <div class="col-md-12 text-center">--}}
        {{--                    <a href="#" class="aro">আরো দেখুন <i class="fa fa-long-arrow-right"></i></a>--}}
        {{--                </div>--}}
                    </div>
                </div>


                <div class="retab tab-pane fade" id="ar2" role="tabpanel" aria-labelledby="ar2-tab" style="margin: auto;">
                    <div class="col-md-12">
                            <h2 class="text-center">Coming soon</h2>
                    </div>
                </div>
            </div>
        </div>
@endsection
@push('js')

@endpush
