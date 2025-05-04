@extends('layouts.frontend.app')
@push('css')
    <style nonce="abc123">
        .headline {
            font-size: 25px;
            font-weight: 400;
            margin: 20px 0px;
        }

        .breadcumb p {
            margin-bottom: 0;
            padding: 4px 0;
            color: #0a0a0a;
        }

        .area-work p {
            color: #080808;
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
    </style>
@endpush
@section('title') আমাদের পণ্য @endsection
@section('content')

    <section class="bannerhead" style="margin-bottom:0px;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1>আমাদের পণ্য </h1>
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
                    <a href="{{url('calender-sapox/'.$area->id)}}" class="tab-btn">কর্মসূচী ক্যালেন্ডার</a>
                    <a href="{{url('others/'.$area->id)}}" class="tab-btn">নোটিশ/বিজ্ঞপ্তি</a>
                    <a href="{{url('gallery-sapox/'.$area->id)}}"
                       class="tab-btn {{ Request::is('gallery-sapox*') ? 'active' : ''}}">গ্যালারী</a>
                    {{--                    <a href="{{url('showroome-sapox/'.$area->id)}}"--}}
                    {{--                       class="tab-btn {{ Request::is('showroome-sapox*') ? 'active' : ''}}">সেনাসম্ভার/সেনামালঞ্চ</a>--}}
                    <a href="{{url('showroome-sapox/'.$area->id)}}"
                       class="tab-btn {{ Request::is('showroome-sapox*') ? 'active' : ''}}">শো-রুম সমূহ </a>
                    <a href="{{url('product-sapox/'.$area->id)}}"
                       class="tab-btn {{ Request::is('product-sapox*') ? 'active' : ''}}">পন্য</a>
                    <a href="{{url('kolkontho-club/'.$area->id)}}" class="tab-btn">কলকণ্ঠ ক্লাব</a>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container sbgcolor offer">
            <div class="row">
                <div class="col-md-8 owl-carousel activities-slider productslider">
                    <div class="offer-left text-center">
                        <h3>৩০% পর্যন্ত মূল্যছাড়</h3>
                        <p>শুধুমাত্র নকশীকাঁথার জন্য প্রযোজ্য </p>
                    </div>
                    <div class="offer-left text-center">
                        <h3>4০% পর্যন্ত মূল্যছাড়</h3>
                        <p>শুধুমাত্র নকশীকাঁথার জন্য প্রযোজ্য </p>
                    </div>
                    <div class="offer-left text-center">
                        <h3>5০% পর্যন্ত মূল্যছাড়</h3>
                        <p>শুধুমাত্র নকশীকাঁথার জন্য প্রযোজ্য </p>
                    </div>
                </div>
                <div class="col-md-4 offer-right">
                    <img src="{{asset('frontend/assets/images/offer_bow.png')}}">
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <select id="selectCat">
                        <option value="0">ক্যাটাগরি বাছাই</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name_bn  }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <select id="discount">
                        <option value="0">সিলেক্ট করুন</option>
                        <option value="2">নতুন পণ্য</option>
                        <option value="1">মূল্য ছাড়</option>
                    </select>
                </div>

            </div>
        </div>
    </section>



    <div class="container getproduct">

    </div>
    <div class="container allProduct">
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4">
                    <div class="product">
                        <div class="img"
                             data-fancybox="" data-caption="{{ $product->title_bn }}"
                             href="{{asset('storage/products/'.$product->image)}}"
                             style="background-image: url('{{asset('storage/products/'.$product->image)}}');"></div>
                        <div class="content">
                            <h5>{{ $product->title_bn }}</h5>
                            <h6>মূল্য: {{ $product->price }}</h6>
                        </div>
                    </div>
                </div>
            @endforeach
            {{--            <div class="col-md-12 text-center">--}}
            {{--                <a href="#" class="aro">{{ $products->links() }}<i class="fa fa-long-arrow-right"></i></a>--}}
            {{--            </div>--}}
{{--            <div class="col-md-12 text-center">--}}
{{--                <a href="#">{{ $products->links() }}</a>--}}
{{--            </div>--}}
            <br><br><br><br><br><br>


        </div>
        <input type="hidden" value="{{ $area->id }}" id="area_id" name="area_id">
    </div>
@endsection
@push('js')
    <script nonce="abc123">
        $(document).on("change", "#selectCat", function (e) {
            let area_id = $('#area_id').val();
            let id = $(this).val();
            let url = "{{url('/our-products')}}" + "/" + id + "/" + area_id
            $.ajax({
                type: "GET",
                url: url,
                success: function (data) {
                    $("div.getproduct").html(data);
                    $("div.allProduct").hide();
                }
            });
        });

        $(document).on("change", "#discount", function (e) {
            let area_id = $('#area_id').val();
            let id = $(this).val();
            let url = "{{url('/discount-products')}}" + "/" + id + "/" + area_id
            $.ajax({
                type: "GET",
                url: url,
                success: function (data) {
                    $("div.getproduct").html(data);
                    $("div.allProduct").hide();
                }
            });
        });
    </script>
@endpush
