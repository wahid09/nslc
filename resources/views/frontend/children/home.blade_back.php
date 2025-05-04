@extends('layouts.frontend.app')
@push('css')
    <link href='{{asset('assets/lib/main.css')}}' rel='stylesheet' />
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

    </style>
@endpush
@section('title') হোম @endsection
@section('content')
<section  class="bannerhead" style="margin-bottom: 0px;">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center banner">
          <h1>চিলড্রেন ক্লাব</h1>
        </div>
      </div>
    </div>
    <div class="breadcumb cbgcolor">
      <p>হোম / চিলড্রেন ক্লাব</p>
    </div>
  </section>


    <section style=" background-color: #EFEFEF; padding: 40px 0;
">
        <div class="container warea">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="headline">প্রশিক্ষণ কর্মসূচী</h1>
                </div>

                <div class="col-md-12 owl-carousel three-slider">
                    @foreach($programs as $program)
                        <div class="col-md-12">
                            <a class="area-work" style="background-image: url({{asset('storage/programs/'.$program->image)}});">
                                <p class="cbgcolor">এলাকাঃ {{$program->area_name}}</p>
                            </a>
                        </div>
                    @endforeach
                </div>

                <div class="col-md-4 abp">
                    {{-- <div class="areabl">
                      "অর্থহীন লেখা যার আছে অনেক কিছু। হ্যাঁ, এই লেখার মাঝেই আছে  <span> অনেক কিছু </span> । যদি তুমি মনে করো, এটা তোমার
                    </div> --}}
                    @if(!empty($programText->description_bn))
                        <div class="areabl">
                            {{ str_limit($programText->slogan_bn, 120)}}
                        </div>
                    @else
                        <div class="areabl">
                            update সেনা পরিবার কল্যান সমিতি (সেপকস) তাদের কর্মযজ্ঞ কয়েকটি <span> অঞ্চলে ভাগ </span> করে সম্পাদন করে থাকে।
                        </div>
                    @endif
                </div>
                <div class="col-md-8 abp">
                    {{-- <div class="areabr">
                      অর্থহীন লেখা যার মাঝে আছে অনেক কিছু। হ্যাঁ, এই লেখার মাঝেই আছে অনেক কিছু। যদি তুমি মনে করো, এটা তোমার কাজে লাগবে, তাহলে তা লাগবে কাজে। নিজের ভাষায় লেখা দেখতে অভ্যস্ত হও। মনে রাখবে লেখা অর্থহীন হয়, যখন তুমি তাকে অর্থহীন মনে করো; আর লেখা অর্থবোধকতা তৈরি করে, যখন তুমি তাতে অর্থ ঢালো। যেকোনো লেখাই তোমার কাছে অর্থবোধকতা তৈরি করতে পারে
                    </div> --}}
                    @if(!empty($programText->description_bn))
                        <div class="areabr">
                            {!! str_limit($programText->description_bn, 386) !!}
                        </div>
                    @else
                        <div class="areabr">
                            আর এদের কো-অর্ডিনেশনের জন্য কেন্দ্রীয় কার্যালয় রয়েছে ঢাকাতে। এলাকাভিত্তিক অঞ্চলের মাধ্যমে সেনা পরিবার কল্যান সমিতি (সেপকস) তাদের বিভিন্ন কর্মসূচি বাস্তবায়ন করে থাকে যেমন সেপকস মেলা, বৈশাখী মেলা, বাৎসরিক বনভোজন, শিক্ষা সফর, বিভিন্ন প্রশিক্ষন যেমনঃ কম্পিউটার , দর্জি , এমব্রয়ডারি , ব্লক-বাটিক ও হ্যান্ড পেইন্ট , বিশেষ রান্না ও প্রাথমিক চিকিৎসা , ক্ষুদ্র ঋণ প্রকল্প , রূপচর্চা ইত্যাদি
                        </div>
                    @endif
                </div>


            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="headline">কেন্দ্রিয় কর্মসূচি ক্যালেন্ডার</h1>
                    <div id='calendar'></div>
                </div>

            </div>
        </div>
    </section>


    <section class="sp" style="margin-top: 100px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    {{-- <img class="img-responsive" src="/frontend/assets/images/csr/khomotayon.png"> --}}
                    @if(!empty($membership->banner))
                        <img src="{{asset('storage/content/banners/'.$membership->banner) }}" style="width: 650px; height:492px;">
                    @else
                        <img src="/frontend/assets/images/csr/khomotayon.png">
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="spc c-text">
                        <h1>সদস্যপদ</h1>
                        @if(!empty($membership->description_bn))
                            <p>{!!$membership->description_bn !!}</p>
                        @else
                            <p>
                                অর্থহীন লেখা যার মাঝে আছে অনেক কিছু। হ্যাঁ, এই লেখার মাঝেই আছে অনেক কিছু। যদি তুমি মনে করো, এটা তোমার কাজে লাগবে, তাহলে তা লাগবে কাজে। নিজের ভাষায় লেখা দেখতে অভ্যস্ত হও। মনে রাখবে লেখা অর্থহীন হয়
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section style="margin-top: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="headline">অঞ্চলসমূহ</h1>
                </div>
                <div class="col-md-12 tab-parent children-tab">
                    @foreach($areas as $area)
                        <a href="{{url('details-childrenclub/'.$area->id)}}" class="tab-btn @if ($loop->first) active cbgcolor @endif"> {{ $area->name_bn }}</a>
                    @endforeach
                </div>


            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src='{{asset('assets/lib/main.js')}}'></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialDate: '<?php echo $date = date('Y-m-d'); ?>',
                editable: true,
                selectable: true,
                businessHours: true,
                dayMaxEvents: true, // allow "more" link when too many events
                events: <?php
                echo json_encode($events);
                ?>//[
                // {
                //     title: 'All Day Event',
                //     start: '2020-09-01'
                // },
                // {
                //     title: 'Long Event',
                //     start: '2020-09-07',
                //     end: '2020-09-10'
                // },
                // {
                //     groupId: 999,
                //     title: 'Repeating Event',
                //     start: '2020-09-09T16:00:00'
                // },
                // {
                //     groupId: 999,
                //     title: 'Repeating Event',
                //     start: '2020-09-16T16:00:00'
                // },
                // {
                //     title: 'Conference',
                //     start: '2020-09-11',
                //     end: '2020-09-13'
                // },
                // {
                //     title: 'Meeting',
                //     start: '2020-09-12T10:30:00',
                //     end: '2020-09-12T12:30:00'
                // },
                // {
                //     title: 'Lunch',
                //     start: '2020-09-12T12:00:00'
                // },
                // {
                //     title: 'Meeting',
                //     start: '2020-09-12T14:30:00'
                // },
                // {
                //     title: 'Happy Hour',
                //     start: '2020-09-12T17:30:00'
                // },
                // {
                //     title: 'Dinner',
                //     start: '2020-09-12T20:00:00'
                // },
                // {
                //     title: 'Birthday Party',
                //     start: '2020-09-13T07:00:00'
                // },
                // {
                //     title: 'Click for Google',
                //     url: 'http://google.com/',
                //     start: '2020-09-28'
                // }

                //]
            });

            calendar.render();
        });

    </script>
@endpush

