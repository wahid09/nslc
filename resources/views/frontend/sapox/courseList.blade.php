@extends('layouts.frontend.app')
@push('css')
    <link href='{{asset('assets/lib/main.css')}}' rel='stylesheet'/>
    <style nonce="abc123">


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

        .jl-block {
            background-color: #B81D1D;
            border-radius: 15px;
            padding: 49px 25px;
            padding-left: 0px;
            color: #fff;
            min-height: 330px;
        }

        .breadcumb p {
            margin-bottom: 0;
            padding: 4px 0;
            color: black;
        }

        .area-work p {
            color: #0e0e0e;
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

        .fc-daygrid-block-event .fc-event-time, .fc-daygrid-block-event .fc-event-title {
            padding: 1px;
            color: black;
        }

    </style>
@endpush
@section('title') সেপকস @endsection
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
            <p>কোর্স</p>
        </div>
    </section>
    {{--    <section style=" background-color: #EFEFEF; padding: 40px 0;--}}
    {{--">--}}
    {{--        <div class="row">--}}
    {{--            <div class="col-md-5">--}}
    {{--            </div>--}}
    {{--            <div class="col-md-6">--}}
    {{--                <a href="{{route('course.list')}}" class="tab-btn btn btn-outline-warning">Course</a>--}}
    {{--                <a href="" class="tab-btn btn btn-outline-light">Course Result</a>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </section>--}}
    <section style=" background-color: #EFEFEF; padding: 40px 0;
">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">কোর্স লিস্ট</h3>
                    <section style="margin-top: 40px;">
                        <div class="container">
                            <div class="row">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">কোর্সের নাম</th>
                                        <th scope="col">কোর্স শুরুর তারিখ</th>
                                        <th scope="col">কোর্স শেষের তারিখ</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($courses as $item)
                                        <tr>
                                            <th scope="row">{{ $loop->index+1 }}</th>
                                            <td>{{$item->course_name}}</td>
                                            <td>
                                                @if(!empty($item->start_date))
                                                    {{\Carbon\Carbon::parse($item->start_date)->format('d-M-Y')}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($item->end_time))
                                                    {{\Carbon\Carbon::parse($item->end_time)->format('d-M-Y')}}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('js')

@endpush
