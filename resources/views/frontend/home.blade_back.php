@extends('layouts.frontend.app')
@push('css')
@endpush
@section('title') হোম @endsection
@section('content')

<style>
    .scontent h1 p span {
    font-size: 56px !important;
    line-height: 82px !important;
    color: #fff !important
}
    .scontent h1 p {
    font-size: 56px !important;
    line-height: 82px !important;
    color: #fff !important
}

</style>
    <div class="full-container">
        <div class="landing-banner">
            <div class="owl-carousel activities-slider">
                @if(count($sliders)> 0)
                @foreach($sliders as $slider)
                <div class="landind-slider-item zoom" style="background-image: url('{{asset('storage/slider/'.$slider->slide)}}');">
                    <div class="container">
                        <div class="scontent">
                            <h2>{{$slider->title_bn}}</h2>
                            <h1>{!! str_limit($slider->description, 200) !!} </h1>
                            @if($slider->club_id == 1)
                            <a href="{{url('about-sapox')}}"> আরো পড়ুন <i class="fa fa-long-arrow-right"></i></a>
                            @elseif($slider->club_id == 2)
                                <a href="{{url('about-ladisclub')}}"> আরো পড়ুন <i class="fa fa-long-arrow-right"></i></a>
                                @elseif($slider->club_id == 3)
                                <a href="{{url('about-childrenclub')}}"> আরো পড়ুন <i class="fa fa-long-arrow-right"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
                @else
                <div class="landind-slider-item zoom" style="background-image: url('{{ asset('/frontend/assets/images/header_img.png') }}');">
                    <div class="container">
                        <div class="scontent">
                            <h2>সেনা পরিবার কল্যাণ সমিতি</h2>
                            <h1>সুস্থ সুন্দর এবং স্বনির্ভর জীবনের লক্ষে </h1>
                            <a href="#"> আরো পড়ুন <i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                @endif
            </div>


    </div>

    <section style="margin-top: 120px;">
        <div class="container owl-carousel chief-slider">
            @foreach($messages as $message)
            <div class="row chief-item">
                <div class="col-md-2"></div>
                <div class="col-md-10">
                    <img class="chief-img" src="{{asset('storage/messages/'.$message->image) }}">
                    <div class="chief-words">
                        <h1>" {{ $message->title_bn }} "</h1>
                        <p>{!! str_limit($message->description_bn, 500) !!} <a class="arop" href="{{url('bani')}}"> আরো পড়ুন </a></p>

                        <div class="sign">
                            <h1>{{ $message->message_from }}</h1>
                            <h3>{{ $message->appointment }}</h3>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </section>

    <section style="margin-top: 64px; background-color: #EFEFEF; padding: 40px 0;">
        <div class="container warea">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="headline">গুরুত্বপূর্ণ কর্মসূচী</h1>
                </div>
                @foreach($programs as $program)
                <div class="col-md-4">
                    <a class="area-work" style="background-image: url('{{asset('storage/programs/'.$program->image)}}');">
                        <p class="sbgcolor">
                            {{$program->area->name_bn}} অঞ্চল
                        </p>
                    </a>
                    <h1 class="areahead">{{$program->title_bn}} </h1>
                </div>
                @endforeach

                <div class="col-md-4 abp">
                    @if(!empty($programText->description_bn))
                    <div class="areabl">
                        {{ str_limit($programText->slogan_bn, 90)}}
                    </div>
                    @else
                    <div class="areabl">
                        সেনা পরিবার কল্যান সমিতি (সেপকস) তাদের কর্মযজ্ঞ কয়েকটি <span> অঞ্চলে ভাগ </span> করে সম্পাদন করে থাকে।
                    </div>
                    @endif
                </div>
                <div class="col-md-8 abp">
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

                <div class="col-md-12 text-center">
                    <a href="{{url('sapox')}}" class="aro">আরো দেখুন <i class="fa fa-long-arrow-right"></i></a>
                </div>

            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="headline">আসন্ন কর্মসূচী</h1>
                </div>
                @foreach($events as $event)

                <div class="col-md-4">
                        <a href="" class="text-card">
                        <span class="date">
                        {{ $event->training_date }}
                            {{-- {{date('d', strtotime($event->training_date))}}<br>{{date('Y', strtotime($event->training_date))}} --}}
                        </span>
                            <div class="bottom">
                                <h1>{{ $event->title_bn }} </h1>
                                <p>সময়ঃ {{ $event->start_time }} - {{ $event->end_time }}</p>
                            </div>
                        </a>
                </div>
                @endforeach

                <div class="col-md-12 text-center">
                    <a href="{{url('sapox')}}" class="aro">আরো দেখুন <i class="fa fa-long-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section style="margin-bottom: 200px;">
        <div class="container club-block">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="headline" style="margin-bottom: 94px; margin-top: 76px;">ক্লাবস</h1>
                </div>

                <div class="col-md-6">
                    <div class="clubs lady">
                        <h1>লেডিস ক্লাব</h1>
                        <a href="{{url('ladies-club')}}" class="aro">আরো দেখুন <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="clubs child">
                        <h1>চিলড্রেন ক্লাব</h1>
                        <a href="{{url('home-childrenclub')}}" class="aro">আরো দেখুন <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="award-sec" style="background-image: url('@if(!empty($award->image)) {{ asset('storage/award/'.$award->image)}} @else {{asset('/frontend/assets/images/rewards.png')}} @endif ');">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="aw-left">
                        <h1 class="headline">পুরষ্কার এবং স্বীকৃতি</h1>
                        <div class="women-award">
                        <h2>@if(!empty($award->title_bn)){{ $award->title_bn }} @else Unstoppable Women Award - 2020 @endif</h2>
                            <div class="c-text">
                                @if(!empty($award->description_bn)) {!! $award->description_bn !!} @else দ্যা বিজনেস স্ট্যান্ডার্ড কতৃক আয়োজিত “Unstoppable Women Award-2020” অনুষ্ঠানে প্রধান ও বিশেষ অতিথির সাথে সম্মাননা প্রাপ্ত নারী উদ্যোক্তাগণ । @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
