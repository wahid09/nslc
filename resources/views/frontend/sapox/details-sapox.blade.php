@extends('layouts.frontend.app')
@push('css')
    <style nonce="abc123">
        .mes-area {
            background-color: #EBE4D8;
            padding: 10px;
            border-radius: 25px;
            text-align: center;
        }

        .img-responsive {
            width: 100%;
            margin-left: 5px;
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
@section('title') সেপকস({{$area->name_bn}}) @endsection
@section('content')
    <section class="bannerhead" style="margin-bottom:0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1>সেপকস </h1>
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

    <section style="margin-top: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">{{$area->name_bn}} অঞ্চলের কাঠামো</h3>
                    @if($area->id == 1)
                        <img class="img-responsive"
                             src="{{asset('frontend/assets/images/SPKS_dhaka_about/chart.png')}}">
                    @else
                        <img class="img-responsive"
                             src="{{asset('frontend/assets/images/chart/spks_onnanno club.png')}}">
                    @endif
                </div>
            </div>
        </div>
    </section>
    <section style="margin-top: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-10">

                    <!-- use lbgcolor/cbgcolor class replacing sbgcolor for ladies and children club. Add black class to convert all fontcolor black -->

                    <div class="sovanetri sbgcolor black">
                        @if(!empty($sobanerty->image))
                            <img class="pull-left" src="{{asset('storage/leader/'.$sobanerty->image)}}">
                        @endif
                        <div class="content">
                            <h3>সভানেত্রীর বাণী</h3>
                            <div class="c-text">
                                @if(!empty($sobanerty->description_bn))
                                    {!! $sobanerty->description_bn !!}
                                @endif
                            </div>
                            @if(!empty($sobanerty->name_bn))
                                <h4 class="text-right">{{$sobanerty->name_bn}}</h4>
                            @endif
                            @if(!empty($sobanerty->appt_name))
                                <p>{{$sobanerty->appt_name}}, {{$sobanerty->club_name}}, {{$sobanerty->area_name}}
                                    <br> {{ $sobanerty->appoint_in }} হতে অধ্যাবধি</p>
                            @endif
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>
    <section style="margin-top: 80px;">
        <div class="container">
            <div class="row  justify-content-center">
                {{--                <div class="col-md-12">--}}
                {{--                    <h3 class="text-center">সভানেত্রী</h3>--}}
                {{--                </div>--}}
                {{--                <div class="col-md-4"></div>--}}
                {{--                <div class="col-md-4">--}}
                {{--                    <div class="leads netri">--}}
                {{--                        @if(!empty($sobanerty->image))--}}
                {{--                            <img src="{{asset('storage/leader/'.$sobanerty->image)}}">--}}
                {{--                            <h4>{{$sobanerty->name_bn}}</h4>--}}
                {{--                            <h5>{{$sobanerty->appt_name}}, {{$sobanerty->club_name}},{{$sobanerty->area_name}}</h5>--}}
                {{--                            <p>{{ $sobanerty->appoint_in }} হতে অধ্যাবধি</p>--}}
                {{--                        @else--}}
                {{--                            <img src="{{asset('frontend/assets/images/SPKS_dhaka_about/img_1.png')}}">--}}
                {{--                            <h1>সভানেত্রী, লেডিস ক্লাব, ঢাকা</h1>--}}
                {{--                            <p>১৫-১০-২০১৮ হতে অধ্যাবধি</p>--}}
                {{--                        @endif--}}

                {{--                    </div>--}}
                {{--                </div>--}}
                {{--                <div class="col-md-4">--}}

                {{--                </div>--}}

                {{--                @if(!empty($sobanerty->description_bn))--}}
                {{--                    <div class="col-md-12 mes-area">--}}
                {{--                        <h4 class="text-center">সভানেত্রীর বাণী</h4>--}}
                {{--                        <p class="justify-content">{!! str_limit($sobanerty->description_bn, 400) !!}</p>--}}
                {{--                    </div>--}}
                {{--                @endif--}}
                {{--                <div class="col-md-12">--}}
                {{--                    <div class="col-md-1">--}}
                {{--                    </div>--}}
                {{--                    @if(!empty($sobanerty->description_bn))--}}
                {{--                        <div class="col-md-10 mes-area">--}}
                {{--                            <h5 class="text-center">বাণী</h5>--}}
                {{--                            <p class="justify-content">{!! str_limit($sobanerty->description_bn, 400) !!}</p>--}}
                {{--                        </div>--}}
                {{--                    @endif--}}
                {{--                    <div class="col-md-1">--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                <div class="col-md-12">
                    <h3 class="text-center">সহ-সভানেত্রী</h3>
                </div>
                @foreach($shosobanerty as $leader)
                    <div class="col-md-2">
                        <div class="leads">
                            <img src="{{asset('storage/leader/'.$leader->image)}}">
                            <h4>{{$leader->name_bn}}</h4>
                            <h1>{{$leader->appt_name}}, {{$leader->club_name}}, {{$leader->area_name}}</h1>
                            <p>{{$leader->appoint_in}} হতে অধ্যাবধি</p>
                        </div>
                    </div>
                @endforeach
                @if($area->id == 1)
                    <div class="col-md-12">
                        <h3 class="text-center">সদস্যা</h3>
                    </div>
                    @foreach($uposhosobanerty as $leader)
                        <div class="col-md-2">
                            <div class="leads">
                                <img src="{{asset('storage/leader/'.$leader->image)}}">
                                <h4>{{$leader->name_bn}}</h4>
                                <h1>{{$leader->appt_name}}, {{$leader->club_name}}, {{$leader->area_name}}</h1>
                                <p>{{$leader->appoint_in}} হতে অধ্যাবধি</p>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="col-md-12">
                    @if($area->id == 1)
                        <h3 class="text-center">সচিব ও কোষাধ্যক্ষ</h3>
                    @else
                        <h3 class="text-center">সচিব</h3>
                    @endif
                </div>
                @foreach($socib as $leader)
                    <div class="col-md-2">
                        <div class="leads">
                            <img src="{{asset('storage/leader/'.$leader->image)}}">
                            <h4>{{$leader->name_bn}}</h4>
                            <h1>{{$leader->appt_name}}, {{$leader->club_name}}, {{$leader->area_name}}</h1>
                            <p>{{$leader->appoint_in}} হতে অধ্যাবধি</p>
                        </div>
                    </div>
                @endforeach
                @if($area->id == 1)
                    <div class="col-md-12">
                        <h3 class="text-center">সমন্বয়কারী অফিসার</h3>
                    </div>
                    @foreach($koshadokko as $leader)
                        <div class="col-md-2">
                            <div class="leads">
                                <img src="{{asset('storage/leader/'.$leader->image)}}">
                                <h4>{{$leader->name_bn}}</h4>
                                <h1>{{$leader->appt_name}}, {{$leader->club_name}}, {{$leader->area_name}}</h1>
                                <p>{{$leader->appoint_in}} হতে অধ্যাবধি</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12">
                        <h3 class="text-center">কোষাধ্যক্ষা</h3>
                    </div>
                    @foreach($koshadokkoArea as $leader)
                        <div class="col-md-2">
                            <div class="leads">
                                <img src="{{asset('storage/leader/'.$leader->image)}}">
                                <h4>{{$leader->name_bn}}</h4>
                                <h1>{{$leader->appt_name}}, {{$leader->club_name}}, {{$leader->area_name}}</h1>
                                <p>{{$leader->appoint_in}} হতে অধ্যাবধি</p>
                            </div>
                        </div>
                    @endforeach
                @endif

                @if($area->id == 1)

                @else
                    <div class="col-md-12">
                        <h3 class="text-center">সদস্যা</h3>
                    </div>
                    @foreach($memberArea as $leader)
                        <div class="col-md-2">
                            <div class="leads">
                                <img src="{{asset('storage/leader/'.$leader->image)}}">
                                <h4>{{$leader->name_bn}}</h4>
                                <h1>{{$leader->appt_name}}, {{$leader->club_name}}, {{$leader->area_name}}</h1>
                                <p>{{$leader->appoint_in}} হতে অধ্যাবধি</p>
                            </div>
                        </div>
                    @endforeach
                @endif
                @if($area->id == 1)

                @else
                    <div class="col-md-12">
                        <h3 class="text-center">সমন্বয়কারী অফিসার</h3>
                    </div>
                    @foreach($officerArea as $leader)
                        <div class="col-md-2">
                            <div class="leads">
                                <img src="{{asset('storage/leader/'.$leader->image)}}">
                                <h4>{{$leader->name_bn}}</h4>
                                <h1>{{$leader->appt_name}}, {{$leader->club_name}}, {{$leader->area_name}}</h1>
                                <p>{{$leader->appoint_in}} হতে অধ্যাবধি</p>
                            </div>
                        </div>
                    @endforeach
                @endif

                {{-- <div class="col-md-12">
                    <h1 class="headline text-center">সদস্যগন</h1>
                </div>
                @foreach($leaders as $leader)
                <div class="col-md-2">
                    <div class="leads">
                        <img src="{{asset('storage/leader/'.$leader->image)}}">
                        <h1>{{$leader->appt_name}}, {{$leader->club_name}}, {{$leader->area_name}}</h1>
                        <p>{{$leader->appoint_in}} হতে অধ্যাবধি</p>
                    </div>
                </div>
                @endforeach --}}

            </div>
        </div>
    </section>


    <section style="margin-top: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 tab-parent nav nav-tabs sapox-tab">
                    <a class="tab-btn active show" id="ar1-tab" data-toggle="tab" href="#ar1" role="tab"
                       aria-controls="ar1" aria-selected="true"> প্রশিক্ষণ</a>
                    <a class="tab-btn" id="ar2-tab" data-toggle="tab" href="#ar2" role="tab" aria-controls="ar2"
                       aria-selected="false">পরিদর্শন</a>
                    <a class="tab-btn" id="ar3-tab" data-toggle="tab" href="#ar3" role="tab" aria-controls="ar3"
                       aria-selected="false">আসন্ন কর্মসূচী</a>
                </div>

                <div class="retab  owl-carousel three-slider tab-pane fade  active show" id="ar1" role="tabpanel"
                     aria-labelledby="ar1-tab">
                    @foreach($trainings as $training)
                        <div class="col-md-12">
                            <a href="" class="event-card">
                                <div class="img"
                                     data-fancybox="gallery" data-caption="{{$training->title_bn}}"
                                     href="{{asset('storage/training/'.$training->image)}}"
                                     style="background-image: url({{asset('storage/training/'.$training->image)}});">
                <span class="date">
                    {{$training->training_date}}
                </span>
                                </div>
                                <div class="bottom">
                                    <h1>{{$training->title_bn}} </h1>
                                    {{--                                    <p>সময়ঃ {{$training->start_time}} - {{$training->end_time}}   </p>--}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>


                <div class="retab owl-carousel three-slider tab-pane fade" id="ar2" role="tabpanel"
                     aria-labelledby="ar2-tab">
                    @foreach($visits as $training)
                        <div class="col-md-12">
                            <a href="" class="event-card">
                                <div class="img"
                                     data-fancybox="gallery" data-caption="{{$training->title_bn}}"
                                     href="{{asset('storage/training/'.$training->image)}}"
                                     style="background-image: url({{asset('storage/training/'.$training->image)}});">
                <span class="date">
                    {{$training->training_date}}
                </span>
                                </div>
                                <div class="bottom">
                                    <h1>{{$training->title_bn}} </h1>
                                    {{--                                    <p>সময়ঃ {{$training->start_time}} - {{$training->end_time}}   </p>--}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>


                <div class="retab owl-carousel three-slider tab-pane fade" id="ar3" role="tabpanel"
                     aria-labelledby="ar3-tab">
                    @foreach($upcommingEvents as $training)
                        <div class="col-md-12">
                            <a href="" class="event-card">
                                <div class="img"
                                     data-fancybox="gallery" data-caption="{{$training->title_bn}}"
                                     href="{{asset('storage/training/'.$training->image)}}"
                                     style="background-image: url({{asset('storage/training/'.$training->image)}});">
                <span class="date">
                    {{$training->training_date}}
                </span>
                                </div>
                                <div class="bottom">
                                    <h1>{{$training->title_bn}} </h1>
                                    {{--                                    <p>সময়ঃ {{$training->start_time}} - {{$training->end_time}}   </p>--}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>
    </section>
    <section style=" background-color: #fdfbfb; padding: 40px 0;
">
        <div class="container warea">
            <div class="row  justify-content-center">
                <div class="col-md-12 text-center">
                    <h3 class="">কল্যাণমূলক কার্যক্রম(সেপকস - {{$area->name_bn}})</h3>
                </div>

                <div class="col-md-12 owl-carousel three-slider">
                    @foreach($welfares as $welfare)
                        <div class="col-md-12">
                            <a class="area-work"
                               data-fancybox="gallery" data-caption="{{$welfare->title_bn}}"
                               href="{{asset('storage/welfare/'.$welfare->image)}}"
                               style="background-image: url({{asset('storage/welfare/'.$welfare->image)}});">
                                <p class="sbgcolor">এলাকাঃ {{$welfare->area_name}}</p>
                            </a>
                            <h5>{{ $welfare->title_bn }}</h5>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>
@endsection
@push('js')

@endpush
