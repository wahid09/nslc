@extends('layouts.frontend.app')
@push('css')
    <style>
        .notice-layer-upper-box {
            text-align: left;
            display: inline-block;
            padding: 5px;
            background-color: #B81D1D;
            color: #ffffff;
        }

        .notice-layer-upper-box-2 {
            text-align: right;
            display: inline-block;
            padding: 5px;
            background-color: #B81D1D;
            color: #ffffff;
            float: right;
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

        .c-text, .c-text p {
            font-family: sr;
            line-height: 15px;
            font-weight: 400;
            color: #4c4c4c;
        }

        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
            border-radius: 30rem;
        }
        .r-btn{
            border-radius: 30rem;
        }
    </style>
@endpush
@section('title') প্রকাশনী @endsection
@section('content')
    <section class="bannerhead">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1>প্রকাশনী</h1>
                </div>
            </div>
        </div>
        <div class="breadcumb">
            <p>হোম / প্রকাশনী</p>
        </div>
    </section>
    <section>
        <div class="container">

            <div class="row">
                @if(count($publications)>0)
                    @foreach($publications as $publication)
                        <div class="col-md-12">
                            <div class="notice-layer">
                                <h3><img
                                        src="{{asset('frontend/assets/images/bullet.png')}}">&nbsp;{{ $publication->title_bn  }}
                                </h3>

                                <div class="c-text">
                                    {!! $publication->description_bn !!}
                                    @if(!empty($publication->attachment))
                                        {{--                                        <iframe src="{{ asset('storage/publication/'.$publication->attachment) }}"--}}
                                        {{--                                                width="1000px" height="600px" id="iview-{{$publication->id}}"--}}
                                        {{--                                                style="display: none;"></iframe>--}}
                                        <button class="btn btn-success r-btn" data-fancybox='' href="{{asset('storage/publication/'.$publication->attachment)}}"><i class="fa fa-eye"></i>
                                        </button>
                                        <a href="{{url('files/'.$publication->attachment)}}"><i class="fa fa-download"></i></a>
                                    @endif
                                </div>
{{--                                @if(!empty($publication->attachment))--}}

{{--                                @endif--}}
{{--                                <button type="button" class="btn btn-success"--}}
{{--                                        onclick="showIfream({{$publication->id}})"><i class="fa fa-eye"></i></a>--}}
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-md-12">
                        <div class="notice-layer">
                            <h1><img src="{{asset('frontend/assets/images/bullet.png')}}"> বার্ষিক সাধারন সভা ২০২০</h1>
                            <p> 29 সেপ্টেম্বর, ২০২০</p>
                            <div class="c-text">
                                অর্থহীন লেখা যার মাঝে আছে অনেক কিছু। হ্যাঁ, এই লেখার মাঝেই আছে অনেক কিছু। যদি তুমি মনে
                                করো, এটা তোমার কাজে লাগবে, তাহলে তা লাগবে কাজে। নিজের ভাষায় লেখা দেখতে অভ্যস্ত হও। মনে
                                রাখবে লেখা অর্থহীন হয়, যখন তুমি তাকে অর্থহীন মনে করো; আর লেখা অর্থবোধকতা তৈরি করে
                            </div>
                            <a href="#"><i class="fa fa-download"></i></a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

@endsection
@push('js')
    <script>
        // $(document).ready(function(){
        //    $('#iview').hide();
        //    $('#clickView').click(function (e) {
        //        e.preventDefault();
        //        $('#iview').slideToggle("slow");
        //    })
        // });
        $('#iview-' + id).hide();

        function showIfream(id) {
            $('#iview-' + id).slideToggle("slow");
        }
    </script>
@endpush
