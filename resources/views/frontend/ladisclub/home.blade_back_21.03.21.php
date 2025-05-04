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
        .spc1 {
            margin-top: 80px;
            line-height: 41px !important;
            text-align: justify;
        }

        .sp img {
            margin-top: 180px;
        }

    </style>
@endpush
@section('title') লেডিস ক্লাব @endsection
@section('content')
    <section class="bannerhead" style="margin-bottom: 0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1>লেডিস ক্লাব</h1>
                </div>
            </div>
        </div>
        <div class="breadcumb lbgcolor">
            <p>হোম / লেডিস ক্লাব</p>
        </div>
    </section>
    <section style=" background-color: #EFEFEF; padding: 40px 0;
">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">কেন্দ্রীয় কার্যালয়ের কাঠামো(লেডিস ক্লাব)</h3>

                    <section style="margin-top: 40px;">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-6">
                                    <div class="jl-block">
                                        @if(!empty($prodanpris->image))
                                            <img src="{{asset('storage/leader/'.$prodanpris->image)}}">
                                        @else
                                            <img src="{{asset('frontend/assets/images/chief-img.png')}}">
                                        @endif
                                        <div>
                                            {{-- <h1>{{$prodanpris->name_bn}}</h1> --}}
                                            <p>
@if(!empty($prodanpris->description_bn))
                                                {!! $prodanpris->description_bn !!}
@endif</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                </div>

                            </div>
                    </section>
                    <!---->
                </div>

                <div class="col-md-12" style=" background-color: #EFEFEF; padding-top: 40px;
">
                    <div class="row justify-content-center">
                        <div class="col-md-3">
                            <div class="leads">
                                @if(!empty($prodansomonnoykari->image))
                                    <img src="{{asset('storage/leader/'.$prodansomonnoykari->image)}}">
                                    <h4>{{$prodansomonnoykari->name_bn}}</h4>
                                    <h1>{{$prodansomonnoykari->appt_name}},{{$prodansomonnoykari->club_name}}
                                        , {{$prodansomonnoykari->area_name}}</h1>
                                    <p>{{$prodansomonnoykari->appoint_in}} হতে অধ্যাবধি</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="leads">
                                @if(!empty($upoprodansomonnoykari->image))
                                    <img src="{{asset('storage/leader/'.$upoprodansomonnoykari->image)}}">
                                    <h4>{{$upoprodansomonnoykari->name_bn}}</h4>
                                    <h1>{{$upoprodansomonnoykari->appt_name}},{{$upoprodansomonnoykari->club_name}}
                                        , {{$upoprodansomonnoykari->area_name}}</h1>
                                    <p>{{$upoprodansomonnoykari->appoint_in}} হতে অধ্যাবধি</p>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="leads">
                                @if(!empty($socib->image))
                                    <img src="{{asset('storage/leader/'.$socib->image)}}">
                                    <h4>{{$socib->name_bn}}</h4>
                                    <h1>{{$socib->appt_name}},{{$socib->club_name}}, {{$socib->area_name}}</h1>
                                    <p>{{$socib->appoint_in}} হতে অধ্যাবধি</p>
                                @endif
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    {{--    <section style=" background-color: #EFEFEF; padding: 40px 0;--}}
    {{--">--}}
    {{--        <div class="container warea">--}}
    {{--            <div class="row">--}}
    {{--                <div class="col-md-12 text-center">--}}
    {{--                    <h1 class="headline">প্রশিক্ষণ কর্মসূচী</h1>--}}
    {{--                </div>--}}

    {{--                <div class="col-md-12 owl-carousel three-slider">--}}
    {{--                    @foreach($programs as $program)--}}
    {{--                        <div class="col-md-12">--}}
    {{--                            <a class="area-work"--}}
    {{--                               data-fancybox="" data-caption="{{$program->title_bn}}" href="{{asset('storage/programs/'.$program->image)}}" style="background-image: url({{asset('storage/programs/'.$program->image)}}); width: 344px; height: 248px;">--}}
    {{--                                <p>এলাকাঃ {{$program->area_name}}</p>--}}
    {{--                            </a>--}}
    {{--                        </div>--}}
    {{--                    @endforeach--}}
    {{--                </div>--}}

    {{--                <div class="col-md-4 abp">--}}
    {{--                    --}}{{-- <div class="areabl">--}}
    {{--                      "অর্থহীন লেখা যার আছে অনেক কিছু। হ্যাঁ, এই লেখার মাঝেই আছে  <span> অনেক কিছু </span> । যদি তুমি মনে করো, এটা তোমার--}}
    {{--                    </div> --}}
    {{--                    @if(!empty($programText->description_bn))--}}
    {{--                        <div class="areabl">--}}
    {{--                            {{ str_limit($programText->slogan_bn, 120)}}--}}
    {{--                        </div>--}}
    {{--                    @else--}}
    {{--                        <div class="areabl">--}}
    {{--                            update সেনা পরিবার কল্যান সমিতি (সেপকস) তাদের কর্মযজ্ঞ কয়েকটি <span> অঞ্চলে ভাগ </span> করে--}}
    {{--                            সম্পাদন করে থাকে।--}}
    {{--                        </div>--}}
    {{--                    @endif--}}
    {{--                </div>--}}
    {{--                <div class="col-md-8 abp">--}}
    {{--                    --}}{{-- <div class="areabr">--}}
    {{--                      অর্থহীন লেখা যার মাঝে আছে অনেক কিছু। হ্যাঁ, এই লেখার মাঝেই আছে অনেক কিছু। যদি তুমি মনে করো, এটা তোমার কাজে লাগবে, তাহলে তা লাগবে কাজে। নিজের ভাষায় লেখা দেখতে অভ্যস্ত হও। মনে রাখবে লেখা অর্থহীন হয়, যখন তুমি তাকে অর্থহীন মনে করো; আর লেখা অর্থবোধকতা তৈরি করে, যখন তুমি তাতে অর্থ ঢালো। যেকোনো লেখাই তোমার কাছে অর্থবোধকতা তৈরি করতে পারে--}}
    {{--                    </div> --}}
    {{--                    @if(!empty($programText->description_bn))--}}
    {{--                        <div class="areabr">--}}
    {{--                            {!! str_limit($programText->description_bn, 386) !!}--}}
    {{--                        </div>--}}
    {{--                    @else--}}
    {{--                        <div class="areabr">--}}
    {{--                            আর এদের কো-অর্ডিনেশনের জন্য কেন্দ্রীয় কার্যালয় রয়েছে ঢাকাতে। এলাকাভিত্তিক অঞ্চলের মাধ্যমে--}}
    {{--                            সেনা পরিবার কল্যান সমিতি (সেপকস) তাদের বিভিন্ন কর্মসূচি বাস্তবায়ন করে থাকে যেমন সেপকস মেলা,--}}
    {{--                            বৈশাখী মেলা, বাৎসরিক বনভোজন, শিক্ষা সফর, বিভিন্ন প্রশিক্ষন যেমনঃ কম্পিউটার , দর্জি ,--}}
    {{--                            এমব্রয়ডারি , ব্লক-বাটিক ও হ্যান্ড পেইন্ট , বিশেষ রান্না ও প্রাথমিক চিকিৎসা , ক্ষুদ্র ঋণ--}}
    {{--                            প্রকল্প , রূপচর্চা ইত্যাদি--}}
    {{--                        </div>--}}
    {{--                    @endif--}}
    {{--                </div>--}}


    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
{{--    <section style="margin-top: 30px;">--}}
{{--        <div class="container lcalendar">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-12 text-center">--}}
{{--                    <h3>কেন্দ্রীয় প্রশিক্ষণ কর্মসূচি ক্যালেন্ডার(লেডিস ক্লাব)</h3>--}}
{{--                    <div id='calendar'></div>--}}
{{--                </div>--}}

{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <section style="margin-top: 30px;">
        <div class="container lcalendar">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3>সম্মানীত প্রধান পৃষ্টপোষকের কর্মসূচি ক্যালেন্ডার(লেডিস ক্লাব)</h3>
                    <div id='calendar1'></div>
                </div>

            </div>
        </div>
    </section>
{{--    <section class="sp" style="margin-top: 100px;">--}}
{{--        <div class="container">--}}
{{--            <div class="row">--}}
{{--                <div class="col-md-6 half-cover"--}}
{{--                     data-fancybox="" data-caption="" href="{{asset('storage/content/banners/'.$membership->banner) }}"--}}
{{--                     style="background-image: url(@if(!empty($membership->banner)) {{asset('storage/content/banners/'.$membership->banner) }} @else /frontend/assets/images/csr/khomotayon.png @endif);">--}}
{{--                </div>--}}
{{--                <div class="col-md-6">--}}
{{--                    <div class="spc c-text">--}}
{{--                        <h3>সদস্যপদ</h3>--}}
{{--                        @if(!empty($membership->description_bn))--}}
{{--                            <p>{!!$membership->description_bn !!}</p>--}}
{{--                        @else--}}
{{--                            <p>--}}
{{--                                অর্থহীন লেখা যার মাঝে আছে অনেক কিছু। হ্যাঁ, এই লেখার মাঝেই আছে অনেক কিছু। যদি তুমি মনে--}}
{{--                                করো, এটা তোমার কাজে লাগবে, তাহলে তা লাগবে কাজে। নিজের ভাষায় লেখা দেখতে অভ্যস্ত হও। মনে--}}
{{--                                রাখবে লেখা অর্থহীন হয়--}}
{{--                            </p>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
    <section class="sp" style="margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    {{--                    <a data-fancybox="" data-caption="" href="{{asset('storage/content/banners/'.$membership->banner)}}></a>--}}
                    <img data-fancybox="" data-caption=""
                     href="{{asset('storage/content/banners/'.$membership->banner) }}" class="img-responsive"
                         src="@if(!empty($membership->banner)) {{asset('storage/content/banners/'.$membership->banner) }} @else /frontend/assets/images/csr/khomotayon.png @endif"
                         style="width: 548px; height: 355px;">
                </div>
                <div class="col-md-6">
                    <div class="spc1 c-text">
                        <h3>সদস্যপদ</h3>
                        @if(!empty($membership->description_bn))
                            <p>{!!$membership->description_bn !!}</p>
                        @else
                            <p>
                                অর্থহীন লেখা যার মাঝে আছে অনেক কিছু। হ্যাঁ, এই লেখার মাঝেই আছে অনেক কিছু। যদি তুমি মনে
                                করো,
                                এটা তোমার কাজে লাগবে, তাহলে তা লাগবে কাজে। নিজের ভাষায় লেখা দেখতে অভ্যস্ত হও। মনে রাখবে
                                লেখা
                                অর্থহীন হয়
                                অর্থহীন লেখা যার মাঝে আছে অনেক কিছু। হ্যাঁ, এই লেখার মাঝেই আছে অনেক কিছু। যদি তুমি মনে
                                করো,
                                এটা তোমার কাজে লাগবে, তাহলে তা লাগবে কাজে। নিজের ভাষায় লেখা দেখতে অভ্যস্ত হও। মনে রাখবে
                                লেখা
                                অর্থহীন হয়
                                অর্থহীন লেখা যার মাঝে আছে অনেক কিছু। হ্যাঁ, এই লেখার মাঝেই আছে অনেক কিছু। যদি তুমি মনে
                                করো,
                                এটা তোমার কাজে লাগবে, তাহলে তা লাগবে কাজে। নিজের ভাষায় লেখা দেখতে অভ্যস্ত হও। মনে রাখবে
                                লেখা
                                অর্থহীন হয়
                                অর্থহীন লেখা যার মাঝে আছে অনেক কিছু। হ্যাঁ, এই লেখার মাঝেই আছে অনেক কিছু। যদি তুমি মনে
                                করো,
                                এটা তোমার কাজে লাগবে, তাহলে তা লাগবে কাজে। নিজের ভাষায় লেখা দেখতে অভ্যস্ত হও। মনে রাখবে
                                লেখা
                                অর্থহীন হয়
                            </p>
                            @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style=" background-color: #fdfbfb; padding: 40px 0;">
        <div class="container warea">
            <div class="row  justify-content-center">
                <div class="col-md-12 text-center">
                    <h3 class="">কল্যাণমূলক কার্যক্রম(লেডিস ক্লাব)</h3>
                </div>

                <div class="col-md-12 owl-carousel three-slider">
                    @foreach($welfares as $welfare)
                        <div class="col-md-12">
                            <a class="area-work"
                               data-fancybox="gallery" data-caption="{{$welfare->title_bn}}"
                               href="{{asset('storage/welfare/'.$welfare->image)}}"
                               style="background-image: url({{asset('storage/welfare/'.$welfare->image)}}); width: 344px; height: 248px;">
                                <p class="lccolor">এলাকাঃ {{$welfare->area_name}}</p>
                            </a>
                            <h5>{{ $welfare->title_bn }}</h5>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    <section style="margin-top: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">গ্যালারী</h3>
                    <div class="gal">
                        @foreach($galleries as $item)
                            <li data-fancybox='gallery' href="{{asset('storage/gallery/'.$item->image)}}">
                                <figure>
                                    <img title="" alt="" src="{{asset('storage/gallery/'.$item->image)}}">
                                </figure>
                                <div>
{{--                                    <h1>{{ $item->title_bn }}</h1>--}}
                                </div>
                            </li>

                        @endforeach
                    </div>
                    {{--                    <br>--}}
                    {{--                    <div class="col-md-12 text-center">--}}
                    {{--                        <a href="#" class="aro">আরো দেখুন <i class="fa fa-long-arrow-right"></i></a>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </section>
    <section style="margin-top: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3 class="">অঞ্চলসমূহ</h3>
                </div>
                <div class="col-md-12 tab-parent ladies-tab">
                    @foreach($areas as $area)
                        <a href="{{url('details-ladiesclub/'.$area->id)}}"
                           class="tab-btn @if ($loop->first) active @endif"> {{ $area->name_bn }}</a>
                    @endforeach
                </div>


            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src='{{asset('assets/lib/main.js')}}'></script>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialDate: '<?php echo $date = date('Y-m-d'); ?>',
                editable: true,
                selectable: true,
                businessHours: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events: <?php
                echo json_encode($events);
                ?>
            });

            calendar.render();
        });

    </script>
    <script>

        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar1');

            var calendar1 = new FullCalendar.Calendar(calendarEl, {
                initialDate: '<?php echo $date = date('Y-m-d'); ?>',
                editable: true,
                selectable: true,
                businessHours: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events: <?php
                echo json_encode($chif_event);
                ?>
            });

            calendar1.render();
        });

    </script>
@endpush

