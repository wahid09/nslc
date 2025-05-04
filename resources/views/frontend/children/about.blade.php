@extends('layouts.frontend.app')
@push('css')
<style>
    .ab-right h2 {
    color: #B81D1D;
    font-size: 30px;
    font-weight: 400;
    margin-bottom: 20px;
    line-height: 56px;
    margin-top: 8px;
}
</style>
@endpush
@section('title') চিলড্রেন ক্লাব @endsection
@section('content')
    <section class="bannerhead">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1>চিলড্রেন ক্লাব </h1>
                </div>
            </div>
        </div>
        <div class="breadcumb">
            <p>হোম / আমাদের সম্পর্কে / চিলড্রেন ক্লাব</p>
        </div>
    </section>

    <section style="margin-top: 40px;">
        <div class="container">
            <div class="row">
{{--                <div class="col-md-6">--}}
{{--                    <div class="jl-block">--}}
{{--                        @if(!empty($upoprodanpris->image))--}}
{{--                        <img src="{{asset('storage/leader/'.$prodanpris->image)}}">--}}
{{--                        @else--}}
{{--                        <img src="{{asset('frontend/assets/images/chief-img.png')}}">--}}
{{--                        @endif--}}
{{--                        --}}{{-- <div>--}}
{{--                            <h1>েনারেল আজিজ আহমেদ</h1>--}}
{{--                            <p>--}}
{{--                                এসবিপি, বিএস্পি, বিজিএম, পিবিজিএম, বিজিবিএম, পিএসসি, জি  <br>--}}
{{--                                সেনাবাহিনী প্রধান  <br>--}}
{{--                                ও <br>--}}
{{--                                প্রধান পৃষ্ঠপোষক, সেনা পরিবার কল্যাণ</p>--}}
{{--                        </div> --}}
{{--                        <div>--}}
{{--                            {!! $prodanpris->description_bn !!}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
                <div class="col-md-3">
                </div>
                <div class="col-md-6">
                    <div class="jl-block">
                        @if(!empty($upoprodanpris->image))
                        <img src="{{asset('storage/leader/'.$upoprodanpris->image)}}">
                        @else
                        <img src="{{asset('frontend/assets/images/chief-mam.png')}}">
                        @endif
                        <div>
                            {{-- <h1>দিলশাদ নাহার আজিজ</h1>
                            <p>
                                পৃষ্ঠপোষক, সেনা পরিবার কল্যাণ সমিতি<br>
                                প্রধান পৃষ্ঠপোষক, সেনা পরিবার কল্যাণ</p> --}}
                                {!! $upoprodanpris->description_bn !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                </div>

            </div>
    </section>

    <section style="margin-top: 80px;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h3 class="text-center">সভানেত্রীগন</h3>
                </div>

                @foreach($leaders as $leader)
                <div class="col-md-2">
                    <div class="leads">
                        <img src="{{asset('storage/leader/'.$leader->image)}}">
                        <h1>{{$leader->name_bn}}</h1>
{{--                        <h1>{{$leader->appt_name}},{{$leader->club_name}}, {{$leader->area_name}}</h1>--}}
                        <h1>{{$leader->appt_name}}, {{$leader->area_name}} অঞ্চল</h1>
                        <p>{{$leader->appoint_in}} @if(empty($leader->appoint_out))হতে অধ্যাবধি @else হতে {{$leader->appoint_out}} @endif</p>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>

    <section style="margin-top: 70px; background: linear-gradient(90deg, #EBE4D8 70%, transparent 50%);">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="ab-right c-text">
                        <br><br>
                        <h2>এক নজরে চিলড্রেন ক্লাব</h2>
                        @if($about->short_description_bn)
                        <p>{!! $about->short_description_bn !!}</p>
                        @else
                        <p>বাংলাদেশ সেনাবাহিনীতে কর্মরত জুনিয়র কমিশন্ড অফিসার , নন-কমিশন্ড অফিসার , অন্যান্য পদবির সৈনিক , এমওডিসি , বেসামরিক কর্মচারীদের পরিবারবর্গের , সামাজিক, সাংস্কৃীতিক , শিক্ষা, অর্থনৈতিক ও অন্যান্য কল্যাণমূলক কার্যাবলী উন্নয়নের লক্ষ্যে ১৯৭৫ সালে “সেনা পরিবার কল্যাণ সমিতি “ সংক্ষেপে “ সেপকস” গঠিত হয়েছে । প্রতিষ্ঠানতি ২০০১ সালে সমাজকল্যাণ মন্ত্রণালয় , সমাজসেবা অধিদপ্তর , জেলা সমাজসেবা কার্যালয় , ঢাকা এর নিবন্ধন লাভ করে ।
                            <br><br>
                            সৈনিক জীবনে শত ব্যস্ততার মাঝে একটি শিক্ষিত, সুস্থ, স্বনির্ভর, স্বাবলম্বী এবং সুন্দর পরিবার আমাদের একান্ত কাম্য । আর এই স্বপ্নকে বাস্তবায়নের উদ্দ্যেশে সেপকস বিভিন্ন কারিগরি প্রশিক্ষন , প্রেরণামূলক ক্লাস এবং কল্যাণমূলক কার্যক্রম পরিচালনা করছে । ৪৫ বছরের এই সংগঠনটি বর্তমানে সমগ্র বাংলাদেশে ১৪টি অঞ্চল এবং ১১টি শাখা সেপকসের মাধ্যমে নারী সদস্যদের কল্যানে নিরলসভাবে কাজ করে যাচ্ছে ।
                            <br><br>
                            পৃষ্ঠপোষক দিলশাদ নাহার আজিজ এর সুদূর প্রসারী দিক নির্দেশনায় যুগের সাথে তাল মিলিয়ে সেপকস এর প্রশিক্ষন কার্যক্রম সহ বিভিন্ন উন্নয়ন অব্যাহত রয়েছে । সেপকস বিভিন্ন প্রশিক্ষন যেমনঃ কম্পিউটার , দর্জি , এমব্রয়ডারি , ব্লক-বাটিক ও হ্যান্ড পেইন্ট , বিশেষ রান্না ও প্রাথমিক চিকিৎসা , ক্ষুদ্র ঋণ প্রকল্প , রূপচর্চা ইত্যাদির মাধ্যমে নারীদের হাতকে বলিষ্ঠ কর্মজীবী হাতে রুপান্তর করেছে । প্রতিবছর প্রায় ২হাজার নারী সদস্য সেপকস হতে বিভিন্ন কারিগরি ও আত্মকর্মসংস্থান মুলক প্রশিক্ষণ গ্রহন করেছে । এছাড়াও সেপকস এর অঙ্গসংগঠন “কলকন্ঠ” ক্লাব এর মাধ্যমে বিভিন্ন প্রশিক্ষন যেমনঃ নাচ, গান , অংকন ইত্যাদি এবং আচার অনুষ্ঠানের দ্বারা সেনাসদস্যদের সন্তানদের মাঝে ,একতার বন্ধন , সাংস্কৃীতি চর্চা , শ্রদ্ধাবোধ বৃদ্ধি , আত্মবিশ্বাসী ও মনোবল বৃদ্ধির প্রচেষ্টা অব্যাহত আছে । প্রশিক্ষন প্রদানের পাশাপাশি সেনা পরিবার কল্যাণ সমিতি বিভিন্ন কল্যাণ মূলক কার্যক্রমে অংশগ্রহন করে থাকে । সেনাবাহিনীতে কর্মরত অবস্থায় মৃত্যুবরণকারী সেনাসদস্যদের সেপকসের পক্ষ থেকে তার উত্তরাধিকারিদেরকে এককালীন ২৫ হাজার টাকা অনুদান প্রদান করা হয় । সেপকস হতে প্রশিক্ষিত সেনাবাহিনীর জেসিও ও ওআর দের সহধর্মিণী ও অবিবাহিত কন্যা সন্তানদের জন্য রয়েছে ট্রাস্ট ব্যাংক হতে সহজ শর্তে ২৫হাজার থেকে ১লাখ টাকা পর্যন্ত ঋণ গ্রহনের সুবিধা । শীতার্ত দের মাঝে শীত বসত্র বিতরণ সহ জাতীয় বিভিন্ন দুর্যোগে অসহায় এবং দুঃস্থ মানুষের পাশে থেকে সেপকস বিভিন্ন রকম ত্রান বিতরন কার্যক্রম পরিচালনা করে থাকে । দেশে আর্থসামাজিক উন্নয়নে নারীর ভূমিকা অনস্বীকার্য । মেধা, প্রজ্ঞা এবং শ্রম এই তিনের সমন্বয়ে দেশকে এগিয়ে নিতে সেনা পরিবারের নারী সদস্যদের উপযুক্ত করে গরে তুলতে সেপকস আন্তরিক প্রচেষ্টা চালিয়ে যাচ্ছে ।</p>
                            @endif
                        <br>
                    </div>
                </div>
                @php
                $images = json_decode($about->image);
                // echo $images[0]->image;
                //print_r($images);
                @endphp
                <div class="col-md-4">
                    <div class="aim-purpose-right">
                        @foreach($images as $image)
                        <div class="img" style="background-image: url({{asset('storage/content/images/'.$image)}});"></div>
                        @endforeach
                        {{-- <div class="img" style="background-image: url('assets/images/img_1.png');"></div>
                        <div class="img" style="background-image: url('assets/images/img_2.png');"></div>
                        <div class="img" style="background-image: url('assets/images/img_3.png');"></div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="margin-top: 80px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="text-center">সাংগঠনিক কাঠামো</h3>
                    <img class="img-responsive" src="{{asset('frontend/assets/images/chart.png')}}">
                </div>
            </div>
        </div>
    </section>


    <section style="margin-top: 100px;">
        <div class="container">
            <div class="row">

                <div class="col-md-10">
                    <div class="ab-left csr-left">
                        {{-- <img src="/frontend/assets/images/csr/khomotayon.png"> --}}
                        @if(!empty($purpose->banner))
                        <img src="{{asset('storage/content/banners/'.$about->banner) }}" style="width: 759px; height:492px;">
                        @else
                        <img src="/frontend/assets/images/csr/khomotayon.png">
                        @endif
                        <div>
                            <h1>আমাদের উদ্দেশ্য</h1>
                        </div>
                    </div>
                </div>

                <div class="col-md2">
                    <div class="ab-right">
                        <div class="numarea">
                            <p></p>
                        </div>
                        <div class="numarea" style="background-color: #7111AA">
                            <p></p>
                        </div>
                        <div class="numarea" style="background-color: #4D9F73">
                            <p></p>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="ab-right c-text">
                        <br><br>
                        @if(!empty($about->description_bn))
                        <p>{!!$about->description_bn !!}</p>
                        @else
                        <p>বাংলাদেশ সেনাবাহিনীতে কর্মরত জুনিয়র কমিশন্ড অফিসার , নন-কমিশন্ড অফিসার , অন্যান্য পদবির সৈনিক , এমওডিসি , বেসামরিক কর্মচারীদের পরিবারবর্গের , সামাজিক, সাংস্কৃীতিক , শিক্ষা, অর্থনৈতিক ও অন্যান্য কল্যাণমূলক কার্যাবলী</p>
                        @endif
                        {{-- <p>বাংলাদেশ সেনাবাহিনীতে কর্মরত জুনিয়র কমিশন্ড অফিসার , নন-কমিশন্ড অফিসার , অন্যান্য পদবির সৈনিক , এমওডিসি , বেসামরিক কর্মচারীদের পরিবারবর্গের , সামাজিক, সাংস্কৃীতিক , শিক্ষা, অর্থনৈতিক ও অন্যান্য কল্যাণমূলক কার্যাবলী</p> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="margin-top: 60px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h3 class="">বিভিন্ন অঞ্চল</h3>
                </div>
                <div class="col-md-2">
                    <a href="{{url('home-childrenclub')}}">
                        <div class="area">
                            <i class="fa fa-cube"></i>
                            <h1>{{$area->name_bn}}</h1>
                        </div>
                    </a>
                </div>
                @foreach($areas as $area)
                <div class="col-md-2">
                    <a href="{{url('details-childrenclub/'.$area->id)}}">
                        <div class="area">
                            <i class="fa fa-cube"></i>
                            <h1>{{$area->name_bn}} অঞ্চল</h1>
                        </div>
                    </a>
                </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
@push('js')

@endpush
