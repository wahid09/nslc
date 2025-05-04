@extends('layouts.frontend.app')
@push('css')
    <style>
        .notice-layer-upper-box{
            text-align: left;
            display: inline-block;
            padding: 5px;
            background-color: #B81D1D;
            color: #ffffff;
        }
        .notice-layer-upper-box-2{
            text-align: right;
            display: inline-block;
            padding: 5px;
            background-color: #B81D1D;
            color: #ffffff;
            float: right;
        }
        .c-text, .c-text p{
            font-family: sr;
            line-height: 25px;
            font-weight: 400;
            color: #4c4c4c;
        }

        .r-btn{
            border-radius: 30rem;
        }
        .notice-layer h3 {
            font-size: revert;
            letter-spacing: 0px;
            color: #292929;
            display: block;
            border-bottom: 1px solid #B81D1D;
            padding-bottom: 14px;
            margin-bottom: 16px;
        }
        </style>
@endpush
@section('title') নোটিশ/পত্র @endsection
@section('content')
<section class="bannerhead">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center banner">
        <h1>নোটিশ/পত্র</h1>
      </div>
    </div>
  </div>
  <div class="breadcumb">
    <p>হোম / বাণী ও নোটিশ / নোটিশ/পত্র</p>
  </div>
</section>
<section>
  <div class="container">
{{--      <div class="row">--}}
{{--          <div class="col-md-6">--}}
{{--              <h5 class="notice-layer-upper-box">নোটিশ/পত্র - সকলের জন্য</h5>--}}
{{--          </div>--}}
{{--          <div class="col-md-6">--}}
{{--              <a href="{{url('login')}}"><h5 class="notice-layer-upper-box-2">অন্যান্য নোটিশ/পত্র দেখতে লগইন করুন</h5></a>--}}
{{--          </div>--}}
{{--      </div>--}}
    <div class="row">
        @if(count($notices)>0)
        @foreach($notices as $notice)
        <div class="col-md-12">
            <div class="notice-layer">
            <h3><img src="{{asset('frontend/assets/images/bullet.png')}}">&nbsp;{{ $notice->title_bn  }} </h3>
            <p>{{ $notice->notice_date  }}</p>
            <div class="c-text">
                {!! $notice->description_bn !!}
                @if(!empty($notice->attachment))
                {{-- <iframe src ="{{ asset('storage/notices/'.$notice->attachment) }}" width="1000px" height="600px"></iframe> --}}
                @endif
            </div>

            @if(!empty($notice->attachment))
                <button class="btn btn-success r-btn" data-fancybox='' href="{{asset('storage/notices/'.$notice->attachment)}}"><i class="fa fa-eye"></i></button>
            <a href="{{url('notice-download/'.$notice->attachment)}}"><i class="fa fa-download"></i></a>
            @endif
            </div>
        </div>
        @endforeach
      @else
        <div class="col-md-12">
            <div class="notice-layer">
            <h1><img src="{{asset('frontend/assets/images/bullet.png')}}"> বার্ষিক সাধারন সভা ২০২০</h1>
            <p>29 সেপ্টেম্বর, ২০২০</p>
            <div class="c-text">
                অর্থহীন লেখা যার মাঝে আছে অনেক কিছু। হ্যাঁ, এই লেখার মাঝেই আছে অনেক কিছু। যদি তুমি মনে করো, এটা তোমার কাজে লাগবে, তাহলে তা লাগবে কাজে। নিজের ভাষায় লেখা দেখতে অভ্যস্ত হও। মনে রাখবে লেখা অর্থহীন হয়, যখন তুমি তাকে অর্থহীন মনে করো; আর লেখা অর্থবোধকতা তৈরি করে
            </div>
            <a href="#"><i class="fa fa-download"></i></a>
            </div>
        </div>
      @endif
    </div>
  </div>
</section>

@endsection
