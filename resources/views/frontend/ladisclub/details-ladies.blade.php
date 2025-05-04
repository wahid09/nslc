@extends('layouts.frontend.app')
@push('css')
    <link href='{{asset('assets/lib/main.css')}}' rel='stylesheet'/>
    <style>


        #calendar {
            max-width: 1100px;
            margin: 0 auto;
        }

        .fc-h-event {
            display: block;
            border: 1px solid #b22134;
            border: 1px solid #b22134;
            background-color: #b22134;
            background-color: #b22134;
        }

        .mes-area {
            background-color: #EBE4D8;
            padding: 10px;
            border-radius: 25px;
            text-align: center;
        }

        .headline {
            font-size: 25px;
            font-weight: 400;
            margin: 20px 0px;
        }

    </style>
@endpush
@section('title') লেডিস ক্লাব({{$area->name_bn}}) @endsection
@section('content')
    <section class="bannerhead" style="margin-bottom:0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1>লেডিস ক্লাব</h1>
                </div>
            </div>
        </div>
        <div class="breadcumb lbgcolor">
            <p>হোম / লেডিস ক্লাব ({{$area->name_bn}})</p>
        </div>
    </section>

    <section style="margin-top: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 tab-parent ladies-tab">
                    <a href="{{url('details-ladiesclub/'.$area->id)}}"
                       class="tab-btn {{Request::is('details-ladiesclub*') ? 'active' : ''}}"> আমাদের সম্পর্কে</a>
                    <a href="{{url('ladiesclub-calender/'.$area->id)}}"
                       class="tab-btn {{Request::is('ladiesclub-calender*') ? 'active' : ''}}">কর্মসূচী ক্যালেন্ডার</a>
                    <a href="{{url('notice-ladiesclub/'.$area->id)}}"
                       class="tab-btn {{Request::is('notice-ladiesclub*') ? 'active' : ''}}">নোটিশ/বিজ্ঞপ্তি</a>
                    <a href="{{url('ladiesclub-gallery/'.$area->id)}}"
                       class="tab-btn {{Request::is('ladiesclub-gallery*') ? 'active' : ''}}">গ্যালারী</a>
                    @if($area->id == 1)
                        <a href="{{url('protiva-school/'.$area->id)}}"
                           class="tab-btn {{Request::is('protiva-school*') ? 'active' : ''}}">প্রতিভা স্কুল</a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section style="margin-top: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="headline text-center">{{$area->name_bn}} অঞ্চলের কাঠামো</h1>
                    @if($area->id == 1)
                        <img class="img-responsive" src="{{asset('frontend/assets/images/ladiesclub/chart.png')}}">
                    @else
                        <img class="img-responsive"
                             src="{{asset('frontend/assets/images/chart/onnanno onchol_ladies club.png')}}">
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

                    <div class="sovanetri lbgcolor">
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
            <div class="row justify-content-center">
{{--                <div class="col-md-12">--}}
{{--                    <h1 class="headline text-center">সভানেত্রী</h1>--}}
{{--                </div>--}}
{{--                <div class="col-md-4"></div>--}}
{{--                <div class="col-md-4">--}}
{{--                    <div class="leads netri">--}}
{{--                        @if(!empty($sobanerty->image))--}}
{{--                            <img src="{{asset('storage/leader/'.$sobanerty->image)}}">--}}
{{--                            <h4>{{$sobanerty->name_bn}}</h4>--}}
{{--                            <h1>{{$sobanerty->appt_name}}, {{$sobanerty->club_name}}, {{$sobanerty->area_name}}</h1>--}}
{{--                            <p>{{$sobanerty->appoint_in}} হতে অধ্যাবধি</p>--}}
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
                <div class="col-md-12">
                    <h1 class="headline text-center">সহ-সভানেত্রী</h1>
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
                        <h1 class="headline text-center">সচিব</h1>
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
                @endif
                @if($area->id == 1)
                    <div class="col-md-12">
                        <h1 class="headline text-center">সাংস্কৃতিক সম্পাদিকা</h1>
                    </div>
                    @foreach($culturalLead as $leader)
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
                        <h1 class="headline text-center">সাধারণ সম্পাদিকা</h1>
                    </div>
                    @foreach($genaralSec as $leader)
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
                    <h1 class="headline text-center">কোষাধ্যক্ষ</h1>
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

                <div class="col-md-12">
                    <h1 class="headline text-center">আগ্রহী সদস্যা </h1>
                </div>
                @foreach($proactiveMember as $leader)
                    <div class="col-md-2">
                        <div class="leads">
                            <img src="{{asset('storage/leader/'.$leader->image)}}">
                            <h4>{{$leader->name_bn}}</h4>
                            <h1>{{$leader->appt_name}}, {{$leader->club_name}}, {{$leader->area_name}}</h1>
                            <p>{{$leader->appoint_in}} হতে অধ্যাবধি</p>
                        </div>
                    </div>
                @endforeach

                <div class="col-md-12">
                    <h1 class="headline text-center">সমন্বয়কারী অফিসার</h1>
                </div>
                @foreach($somonnoykariOfficer as $leader)
                    <div class="col-md-2">
                        <div class="leads">
                            <img src="{{asset('storage/leader/'.$leader->image)}}">
                            <h4>{{$leader->name_bn}}</h4>
                            <h1>{{$leader->appt_name}}, {{$leader->club_name}}, {{$leader->area_name}}</h1>
                            <p>{{$leader->appoint_in}} হতে অধ্যাবধি</p>
                        </div>
                    </div>
                @endforeach

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
                <div class="col-md-12 tab-parent nav nav-tabs ladies-tab">
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
                                     style="background-image: url('{{asset('storage/training/'.$training->image)}}');">
                              <span class="date lbgcolor">
                                {{$training->training_date}}
                              </span>
                                </div>
                                <div class="bottom">
                                    <h1>{{$training->title_bn}}</h1>
{{--                                    <p class="lcolor">সময়ঃ {{$training->start_time}} - {{$training->end_time}}</p>--}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="retab owl-carousel three-slider tab-pane fade" id="ar2" role="tabpanel"
                     aria-labelledby="ar2-tab">
                    @foreach($visits as $visit)
                        <div class="col-md-12">
                            <a href="" class="event-card">
                                <div class="img"
                                     data-fancybox="gallery" data-caption="{{$visit->title_bn}}"
                                     href="{{asset('storage/training/'.$visit->image)}}"
                                     style="background-image: url('{{asset('storage/training/'.$visit->image)}}');">
                              <span class="date lbgcolor">
                                {{$visit->training_date}}
                              </span>
                                </div>
                                <div class="bottom">
                                    <h1>{{$visit->title_bn}} </h1>
{{--                                    <p class="lcolor">সময়ঃ {{$visit->start_time}} - {{$visit->end_time}}</p>--}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>


                <div class="retab owl-carousel three-slider tab-pane fade" id="ar3" role="tabpanel"
                     aria-labelledby="ar3-tab">
                    @foreach($upcommingEvents as $upevent)
                        <div class="col-md-12">
                            <a href="" class="event-card">
                                <div class="img"
                                     data-fancybox="gallery" data-caption="{{$upevent->title_bn}}"
                                     href="{{asset('storage/training/'.$upevent->image)}}"
                                     style="background-image: url('{{asset('storage/training/'.$upevent->image)}}');">
                              <span class="date lbgcolor">
                                {{$upevent->training_date}}
                              </span>
                                </div>
                                <div class="bottom">
                                    <h1>{{$upevent->title_bn}} </h1>
{{--                                    <p class="lcolor">সময়ঃ {{$upevent->start_time}} - {{$upevent->end_time}}</p>--}}
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>
    </section>


    {{-- <section style="margin-top: 80px;">
        <div class="container">
            <div class="row">

                <div class="col-md-6">
                    <div class="ab-left">
                        <img src="{{asset('storage/content/banners/'.$ldetails->banner)}}" style="height: 304px; width: 368px;">
                        <div>
                            <h1>প্রতিভা স্কুল</h1>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="ab-right">
                        <h1>" {{$ldetails->slogan_bn}} ''</h1>
                        <div class="c-text">
                            {!! $ldetails->description_bn !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section style=" background-color: #fdfbfb; padding: 40px 0;
">
        <div class="container warea">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="headline">কল্যাণমূলক কার্যক্রম(লেডিস ক্লাব - {{$area->name_bn}})</h1>
                </div>

                <div class="col-md-12 owl-carousel three-slider">
                    @foreach($welfares as $welfare)
                        <div class="col-md-12">
                            <a class="area-work"
                               data-fancybox="gallery" data-caption="{{$welfare->title_bn}}"
                               href="{{asset('storage/welfare/'.$welfare->image)}}"
                               style="background-image: url({{asset('storage/welfare/'.$welfare->image)}});">
                                <p class="lccolor">এলাকাঃ {{$welfare->area_name}}</p>
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
