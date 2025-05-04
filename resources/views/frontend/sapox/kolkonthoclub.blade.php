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
            border-radius: 25rem;
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
            line-height: 15px;
            font-weight: 400;
            color: #4c4c4c;
        }

        .ab-left h3 {
            position: absolute;
            bottom: 20px;
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

        .c-text, .c-text p {
            font-family: sr;
            line-height: 25px;
            font-weight: 400;
            color: #4c4c4c;
        }


    </style>
@endpush
@section('title') কলকণ্ঠ ক্লাব @endsection
@section('content')
    <section class="bannerhead" style="margin-bottom:0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1>কলকণ্ঠ ক্লাব </h1>
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
                    <a href="{{url('kolkontho-club/'.$area->id)}}"
                       class="tab-btn {{ Request::is('kolkontho-club*') ? 'active' : ''}}">কলকণ্ঠ ক্লাব</a>
                </div>
            </div>
        </div>
    </section>

    {{--    <div class="container" style="margin-top: 30px;">--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-md-12 main-area">--}}
    {{--                <section>--}}
    {{--                    <div class="container">--}}
    {{--                        <div class="row">--}}

    {{--                            <div class="col-md-12 tab-parent nav nav-tabs sapox-tab sapox-subtab">--}}
    {{--                                <a class="tab-btn active show" id="ar1-tab" data-toggle="tab" href="#ar1" role="tab"--}}
    {{--                                   aria-controls="ar1" aria-selected="true"> পরিচিতি ও উদ্দেশ্য</a>--}}
    {{--                                <a class="tab-btn" id="ar2-tab" data-toggle="tab" href="#ar2" role="tab"--}}
    {{--                                   aria-controls="ar2" aria-selected="false">শিক্ষা কার্যক্রম</a>--}}
    {{--                                <a class="tab-btn" id="ar3-tab" data-toggle="tab" href="#ar3" role="tab"--}}
    {{--                                   aria-controls="ar3" aria-selected="false">গ্যালারী</a>--}}
    {{--                                <a class="tab-btn" id="ar4-tab" data-toggle="tab" href="#ar4" role="tab"--}}
    {{--                                   aria-controls="ar4" aria-selected="false">অন্যান্য ও বিজ্ঞপ্তি</a>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}


    {{--                        <div class="retab tab-pane fade  active show" id="ar1" role="tabpanel"--}}
    {{--                             aria-labelledby="ar1-tab">--}}
    {{--                            <div class="row">--}}
    {{--                                <div class="col-md-6">--}}
    {{--                                    <div class="ab-left">--}}
    {{--                                        @if(!empty($purposeOfkolkonto->banner))--}}
    {{--                                        <img src="{{asset('storage/content/banners/'.$purposeOfkolkonto->banner)}}"--}}
    {{--                                             style="width: 368px; height: 304px; margin-top: 100px">--}}
    {{--                                        @endif--}}
    {{--                                        <div class="sbgcolor">--}}
    {{--                                            <h1>পরিচিতি</h1>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}

    {{--                                <div class="col-md-6">--}}
    {{--                                    <div class="ab-right">--}}

    {{--                                        <div class="c-text">--}}
    {{--                                            @if(!empty($purposeOfkolkonto->description_bn))--}}
    {{--                                            {!! $purposeOfkolkonto->description_bn !!}--}}
    {{--                                                @endif--}}

    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="retab tab-pane fade" id="ar2" role="tabpanel" aria-labelledby="ar2-tab">--}}
    {{--                            <div class="row justify-content-center">--}}
    {{--                                <div class="col-md-10">--}}
    {{--                                    <div class="ab-left csr-left">--}}
    {{--                                        --}}{{--                                        <img src="/frontend/assets/images/csr/khomotayon.png">--}}
    {{--                                        <div>--}}
    {{--                                            --}}{{----}}{{--                                            <h1>আমাদের উদ্দেশ্য</h1>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-12" style="margin-top: 80px;">--}}
    {{--                                    <div class="c-text">--}}
    {{--                                    @if(!empty($education_act->description_bn))--}}
    {{--                                        {!! $education_act->description_bn !!}--}}
    {{--                                        @endif--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="retab tab-pane fade" id="ar3" role="tabpanel" aria-labelledby="ar3-tab">--}}
    {{--                            <div class="row justify-content-center">--}}
    {{--                                <div class="col-md-10">--}}
    {{--                                    <div class="ab-left csr-left">--}}

    {{--                                        <div>--}}

    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="col-md-12" style="margin-top: 80px;">--}}
    {{--                                    <div class="c-text">--}}

    {{--                                        <div class="gal">--}}
    {{--                                            @foreach($galleries as $item)--}}
    {{--                                                <li data-fancybox='' href="{{asset('storage/gallery/'.$item->image)}}">--}}
    {{--                                                    <figure>--}}
    {{--                                                        <img title="" alt=""--}}
    {{--                                                             src="{{asset('storage/gallery/'.$item->image)}}">--}}
    {{--                                                    </figure>--}}
    {{--                                                    <div>--}}
    {{--                                                        <h1>{{ $item->title_bn }}</h1>--}}
    {{--                                                    </div>--}}
    {{--                                                </li>--}}

    {{--                                            @endforeach--}}
    {{--                                        </div>--}}

    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="retab tab-pane fade" id="ar4" role="tabpanel" aria-labelledby="ar4-tab">--}}
    {{--                            @foreach($notices as $notice)--}}
    {{--                            <div class="col-md-12">--}}
    {{--                                <div class="notice-layer">--}}
    {{--                                <h1><img src="{{asset('frontend/assets/images/bullet.png')}}">{{ $notice->title_bn  }} </h1>--}}
    {{--                                <p>{{ $notice->notice_date  }}</p>--}}
    {{--                                <div class="c-text">--}}
    {{--                                    {!! $notice->description_bn !!}--}}
    {{--                                    @if(!empty($notice->attachment))--}}
    {{--                                    --}}{{-- <iframe src ="{{ asset('storage/notices/'.$notice->attachment) }}" width="1000px" height="600px"></iframe> --}}
    {{--                                    @endif--}}
    {{--                                </div>--}}

    {{--                                @if(!empty($notice->attachment))--}}
    {{--                                    <button class="btn btn-success r-btn" data-fancybox='' href="{{asset('storage/notices/'.$notice->attachment)}}"><i class="fa fa-eye"></i></button>--}}
    {{--                                <a href="{{url('notice-download/'.$notice->attachment)}}"><i class="fa fa-download"></i></a>--}}
    {{--                                @endif--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                            @endforeach--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </section>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-12 tab-parent nav nav-tabs sapox-tab sapox-subtab">
                    <a class="tab-btn active show" id="ar1-tab" data-toggle="tab" href="#ar1" role="tab"
                       aria-controls="ar1" aria-selected="true"> পরিচিতি ও উদ্দেশ্য</a>
                    <a class="tab-btn" id="ar2-tab" data-toggle="tab" href="#ar2" role="tab" aria-controls="ar2"
                       aria-selected="false">শিক্ষা কার্যক্রম</a>
                    <a class="tab-btn" id="ar3-tab" data-toggle="tab" href="#ar3" role="tab" aria-controls="ar3"
                       aria-selected="false">গ্যালারী</a>
                    <a class="tab-btn" id="ar4-tab" data-toggle="tab" href="#ar4" role="tab" aria-controls="ar4"
                       aria-selected="false">অন্যান্য ও বিজ্ঞপ্তি</a>
                </div>
            </div>


            <div class="retab tab-pane fade  active show" id="ar1" role="tabpanel" aria-labelledby="ar1-tab">
                <div class="row">
                    <div class="col-md-6">
                        <div class="ab-left">
                            {{--                  <img src="/frontend/assets/images/about/spks.png">--}}
                            @if(!empty($purposeOfkolkonto->banner))
                                <img src="{{asset('storage/content/banners/'.$purposeOfkolkonto->banner)}}"
                                     style="width: 368px; height: 304px;">
                            @endif
                            <div class="sbgcolor">
                                <h1>পরিচিতি</h1>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="ab-right">
                            {{--                            <h1>" শিক্ষা ব্যাক্তিকে আলোকিত করার পাশাপাশি পরিবার এবং সমাজকেও আলোকিত করে। যার ফলশ্রুতিতে--}}
                            {{--                                গোটা দেশের উনয়ন ত্বরান্বিত হয় "</h1>--}}
                            <div class="c-text">
                                @if(!empty($purposeOfkolkonto->description_bn))
                                    {!! $purposeOfkolkonto->description_bn !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="retab tab-pane fade" id="ar2" role="tabpanel" aria-labelledby="ar2-tab">
                <div class="row justify-content-center">
                    {{--              <div class="col-md-10">--}}
                    {{--                <div class="ab-left csr-left">--}}
                    {{--                  <img src="/frontend/assets/images/csr/khomotayon.png">--}}
                    {{--                  <div>--}}
                    {{--                    <h1>আমাদের উদ্দেশ্য</h1>--}}
                    {{--                  </div>--}}
                    {{--                </div>--}}
                    {{--              </div>--}}
                    <div class="col-md-12" style="margin-top: 80px;">
                        <div class="c-text">
                            @if(!empty($education_act->description_bn))
                                {!! $education_act->description_bn !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="retab tab-pane fade" id="ar3" role="tabpanel" aria-labelledby="ar3-tab">
                <div class="row justify-content-center">
                    <div class="col-md-12" style="margin-top: 80px;">
                        <div class="c-text">
                            <div class="gal">
                                @foreach($galleries as $item)
                                    <li data-fancybox='gallery' href="{{asset('storage/gallery/'.$item->image)}}">
                                        <figure>--}}
                                            <img title="" alt=""
                                                 src="{{asset('storage/gallery/'.$item->image)}}">
                                        </figure>
                                        <div>
{{--                                            <h1>{{ $item->title_bn }}</h1>--}}
                                        </div>
                                    </li>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="retab tab-pane fade" id="ar4" role="tabpanel" aria-labelledby="ar4-tab">
                @foreach($notices as $notice)
                    <div class="col-md-12">
                        <div class="notice-layer">
                            <h3><img src="{{asset('frontend/assets/images/bullet.png')}}">&nbsp;{{ $notice->title_bn  }}
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
                                <a href="{{url('notice-download/'.$notice->attachment)}}"><i class="fa fa-download"></i></a>
                            @endif

                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </section>

@endsection
@push('js')
@endpush
