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
        .headline {
    font-size: 25px;
    font-weight: 400;
    margin: 20px 0px;
}

    </style>
@endpush
@section('title') কর্মসূচি ক্যালেন্ডার @endsection
@section('content')
    <section class="bannerhead" style="margin-bottom:0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1>লেডিস ক্লাব কর্মসূচি ক্যালেন্ডার </h1>
                </div>
            </div>
        </div>
        <div class="breadcumb lbgcolor">
            <p>হোম / সেপকস ({{$area->name_bn}})</p>
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

    <div class="container" style="margin-top: 30px;">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
    </div>
    <section>
        <div class="container lcalendar">
            <div class="row">
                <div class="col-md-12 text-center scalendar">
                    <h6 class="headline">কর্মসূচি ক্যালেন্ডার(লেডিস ক্লাব - {{$area->name_bn}})</h6>
                    <div id='calendar'></div>
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
                ?>
            });

            calendar.render();
        });

    </script>
@endpush
