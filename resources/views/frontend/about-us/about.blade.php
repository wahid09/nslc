@extends('layouts.frontend.app')
@push('css')
@endpush
@section('title') আমাদের সম্পর্কে @endsection
@section('content')
    <section class="bannerhead">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1>আমাদের সম্পর্কে </h1>
                </div>
            </div>
        </div>
        <div class="breadcumb">
            <p>হোম / আমাদের সম্পর্কে </p>
        </div>
    </section>


    <section style="margin-bottom: 120px;">
        <div class="container club-block">
            <div class="row">
                <div class="col-md-12 text-center" style="margin-bottom: 120px;">
                    <img class="img-responsive" data-fancybox="" data-caption="" href="{{asset('storage/content/banners/'.$pageContents->banner)}}" src="@if(!empty($pageContents->banner)){{asset('storage/content/banners/'.$pageContents->banner)}} @else {{asset('frontend/assets/images/cover_img.png')}} @endif">
                </div>

                <div class="col-md-4">
                    <div class="clubs c3 sapox">
                        <h1>সেপকস </h1>
                    <a href="{{url('about-sapox')}}" class="aro">আরো দেখুন <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="clubs c3 lady">
                        <h1>লেডিস ক্লাব</h1>
                        <a href="{{url('about-ladisclub')}}" class="aro">আরো দেখুন <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="clubs c3 child">
                        <h1>চিলড্রেন ক্লাব</h1>
                        <a href="{{url('about-childrenclub')}}" class="aro">আরো দেখুন <i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
