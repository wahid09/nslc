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
        .c-text, .c-text p {
            font-family: sr;
            line-height: 15px;
            font-weight: 400;
            color: #4c4c4c;
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
@section('title') নোটিশ/পত্র - বিস্তারিত @endsection
@section('content')
<section class="bannerhead">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center banner">
        <h1>নোটিশ/পত্র - বিস্তারিত</h1>
      </div>
    </div>
  </div>
  <div class="breadcumb">
    <p>হোম / বাণী ও নোটিশ / নোটিশ/পত্র</p>
  </div>
</section>
<section>
  <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="notice-layer">
            <h3><img src="{{asset('frontend/assets/images/bullet.png')}}"> {{$notice->title_bn}}</h1>
{{--            <p>{{ $notice->notice_date  }}</p>--}}
            <div class="c-text">
                {!! $notice->description_bn !!}
                @if(!empty($notice->attachment))
                {{-- <iframe src ="{{ asset('storage/notices/'.$notice->attachment) }}" width="1000px" height="600px"></iframe> --}}
                @endif
            </div>
            @if(!empty($notice->attachment))
{{--            <a href="{{url('files/'.$notice->attachment)}}"><i class="fa fa-download"></i></a>--}}
                <iframe src="{{ asset('storage/notices/'.$notice->attachment) }}"
                                                width="1000px" height="600px" id="iview-{{$notice->id}}"></iframe>
            @endif
            </div>
        </div>
    </div>
  </div>
</section>

@endsection
