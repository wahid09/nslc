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
<section class="bannerhead">
  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center banner">
        <h1> লেডিস ক্লাব</h1>
      </div>
    </div>
  </div>
  <div class="breadcumb lbgcolor">
    <p>হোম / লেডিস ক্লাব ({{$area->name_bn}}) </p>
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
        <div class="row justify-content">
            <div class="col-md-12 tab-parent nav nav-tabs ladies-tab">
                <a class="tab-btn active show" id="ar1-tab" data-toggle="tab" href="#ar1" role="tab"
                   aria-controls="ar1" aria-selected="true">ফটো গ্যালারি</a>
                <a class="tab-btn" id="ar2-tab" data-toggle="tab" href="#ar2" role="tab" aria-controls="ar2"
                   aria-selected="false">ভিডিও গ্যালারি</a>
            </div>

            <div class="retab tab-pane fade  active show" id="ar1" role="tabpanel" aria-labelledby="ar1-tab">
                <div class="col-md-12">
                    <div class="gal">
                        @foreach($galleries as $item)
                            <li data-fancybox='gallery' href="{{asset('storage/gallery/'.$item->image)}}">
                                <figure>
                                    <img title="" alt="" src="{{asset('storage/gallery/'.$item->image)}}">
                                </figure>
                                <div>
    {{--                                <h1>{{ $item->title_bn }}</h1>--}}
                                </div>
                            </li>

                        @endforeach
                    </div>
                    <br>
    {{--                <div class="col-md-12 text-center">--}}
    {{--                    <a href="#" class="aro">আরো দেখুন <i class="fa fa-long-arrow-right"></i></a>--}}
    {{--                </div>--}}
                </div>
            </div>


            <div class="retab tab-pane fade" id="ar2" role="tabpanel" aria-labelledby="ar2-tab" style="margin: auto;">
                <div class="col-md-12">
                        <h2 class="text-center">Coming soon</h2>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush
