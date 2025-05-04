@extends('layouts.frontend.app')
@push('css')
    <style>
        /*.bani {*/
        /*    background: #EBE4D8 0% 0% no-repeat padding-box;*/
        /*    border-radius: 10px;*/
        /*    margin-top: 285px;*/
        /*    padding: 10px 42px;*/
        /*}*/
        .bani h1 {
    color: #B81D1D;
    font-size: 25px;
    margin-bottom: 18px;
}
    </style>
@endpush
@section('title') বানী @endsection
@section('content')
    <section class="bannerhead">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center banner">
                    <h1>বানী</h1>
                </div>
            </div>
        </div>
        <div class="breadcumb">
            <p>হোম / বাণী ও নোটিশ / বাণী</p>
        </div>
    </section>


    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    @foreach($messages as $item)
                        <div class="bani">
                            <img src="{{asset('storage/messages/'.$item->image)}}">
                            <h1>প্রধান পৃষ্ঠপোষকের বানী</h1>
                            <div class="c-text">
                                {!! $item->description_bn !!}
                            </div>
{{--                            <h2>{{$item->message_from}}</h2>--}}
{{--                            <h3>জেনারেল, সেনাবাহিনী প্রধান <br> ও <br> {{$item->appointment}}, সেনা পরিবার কল্যাণ সমিতি</h3>--}}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection
