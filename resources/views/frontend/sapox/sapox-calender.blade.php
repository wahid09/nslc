@extends('layouts.frontend.app')
@push('css')
    {{--    <link href='{{asset('assets/lib/main.css')}}' rel='stylesheet'/>--}}
    <link href="{{asset('frontend/calender/demo-to-codepen.css')}}" rel='stylesheet'/>
    <link href="{{asset('frontend/calender/main.min.css')}}" rel='stylesheet'/>
    <link href="{{asset('frontend/calender/daygrid_main.min.css')}}" rel='stylesheet'/>
    <script src="{{asset('frontend/calender/demo-to-codepen.js')}}"></script>
    <script src="{{asset('frontend/calender/fullcalender-main.min.js')}}"></script>
    <script src="{{asset('frontend/calender/main.min.js')}}"></script>
    <style nonce="abc123">
        .popper,
        .tooltip {
            position: absolute;
            z-index: 9999;
            background: #63C900;
            color: black;
            width: 150px;
            border-radius: 3px;
            box-shadow: 0 0 2px rgba(0, 0, 0, 0.5);
            padding: 10px;
        }

        .style5 .tooltip {
            background: #1E252B;
            color: #FFFFFF;
            max-width: 200px;
            width: auto;
            font-size: .8rem;
            padding: .5em 1em;
        }

        .popper .popper__arrow,
        .tooltip .tooltip-arrow {
            width: 0;
            height: 0;
            border-style: solid;
            position: absolute;
            margin: 5px;
        }

        .tooltip .tooltip-arrow,
        .popper .popper__arrow {
            border-color: #FFC107;
        }

        .style5 .tooltip .tooltip-arrow {
            border-color: #1E252B;
        }

        .popper[x-placement^="top"],
        .tooltip[x-placement^="top"] {
            margin-bottom: 5px;
        }

        .popper[x-placement^="top"] .popper__arrow,
        .tooltip[x-placement^="top"] .tooltip-arrow {
            border-width: 5px 5px 0 5px;
            border-left-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            bottom: -5px;
            left: calc(50% - 5px);
            margin-top: 0;
            margin-bottom: 0;
        }

        .popper[x-placement^="bottom"],
        .tooltip[x-placement^="bottom"] {
            margin-top: 5px;
        }

        .tooltip[x-placement^="bottom"] .tooltip-arrow,
        .popper[x-placement^="bottom"] .popper__arrow {
            border-width: 0 5px 5px 5px;
            border-left-color: transparent;
            border-right-color: transparent;
            border-top-color: transparent;
            top: -5px;
            left: calc(50% - 5px);
            margin-top: 0;
            margin-bottom: 0;
        }

        .tooltip[x-placement^="right"],
        .popper[x-placement^="right"] {
            margin-left: 5px;
        }

        .popper[x-placement^="right"] .popper__arrow,
        .tooltip[x-placement^="right"] .tooltip-arrow {
            border-width: 5px 5px 5px 0;
            border-left-color: transparent;
            border-top-color: transparent;
            border-bottom-color: transparent;
            left: -5px;
            top: calc(50% - 5px);
            margin-left: 0;
            margin-right: 0;
        }

        .popper[x-placement^="left"],
        .tooltip[x-placement^="left"] {
            margin-right: 5px;
        }

        .popper[x-placement^="left"] .popper__arrow,
        .tooltip[x-placement^="left"] .tooltip-arrow {
            border-width: 5px 0 5px 5px;
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            right: -5px;
            top: calc(50% - 5px);
            margin-left: 0;
            margin-right: 0;
        }

    </style>
@endpush
@section('title') কর্মসূচি ক্যালেন্ডার @endsection
@section('content')
    <section class="bannerhead" style="margin-bottom:0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1>সেপকস কর্মসূচি ক্যালেন্ডার </h1>
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

            </div>
        </div>
    </div>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center scalendar">
                    <h4>কর্মসূচি ক্যালেন্ডার(সেপকস-{{$area->name_bn}})</h4>
                    <div id='calendar'></div>
                </div>

            </div>
        </div>
    </section>
@endsection
@push('js')
    {{--    <script src='{{asset('assets/lib/main.js')}}'></script>--}}
    <script src="{{asset('frontend/calender/popper.min.js')}}"></script>
    <script src="{{asset('frontend/calender/toltip.js')}}"></script>
    <script nonce="abc123">

        {{--document.addEventListener('DOMContentLoaded', function () {--}}
        {{--    var calendarEl = document.getElementById('calendar');--}}

        {{--    var calendar = new FullCalendar.Calendar(calendarEl, {--}}
        {{--        initialDate: '<?php echo $date = date('Y-m-d'); ?>',--}}
        {{--        editable: true,--}}
        {{--        selectable: true,--}}
        {{--        businessHours: true,--}}
        {{--        dayMaxEvents: true, // allow "more" link when too many events--}}
        {{--        eventRender: function (info) {--}}
        {{--            var tooltip = new Tooltip(info.el, {--}}
        {{--                title: info.event.extendedProps.description,--}}
        {{--                placement: 'top',--}}
        {{--                trigger: 'hover',--}}
        {{--                container: 'body'--}}
        {{--            });--}}
        {{--        },--}}
        {{--        events: <?php--}}
        {{--        echo json_encode($events);--}}
        {{--        ?>--}}
        {{--    });--}}

        {{--    calendar.render();--}}
        {{--});--}}
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: ['dayGrid'],
                defaultView: 'dayGridMonth',
                defaultDate: '<?php echo $date = date('Y-m-d'); ?>',

                eventRender: function (info) {
                    var tooltip = new Tooltip(info.el, {
                        title: info.event.title,
                        //heading: info.event.extendedProps.title,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                },
                events: <?php
                echo json_encode($events);
                ?>
            });

            calendar.render();
        });

    </script>
@endpush
