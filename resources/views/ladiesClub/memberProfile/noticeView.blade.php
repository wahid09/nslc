@extends('ladiesClub.layout.app')
@section('title', 'Notice Details View')
@section('main_menu', 'Notices')
@section('active_menu', 'Notices')
@section('link', '')
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div id="responseMessage" class="alert alert-success" style="display: none;"></div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <tr>
                            <th>Event Title:</th>
                            <td>{{$notice->title_bn}}</td>
                        </tr>
                        <tr>
                            <th>Event Details:</th>
                            <td>{!! $notice->description_bn !!}</td>
                        </tr>
                        <tr>
                            <th>Event Date:</th>
                            <td>{{$notice->notice_date}}</td>
                        </tr>
                        <tr>
                            <th>Event Attachment:</th>
                            <td>
                                @if(!empty($notice->attachment))
                                    <a data-fancybox='' href="{{asset('storage/notices/'.$notice->attachment)}}"><i
                                            class="fa fa-eye"></i></a>
                                    <a href="{{url('notice-download/'.$notice->attachment)}}"><i
                                            class="fa fa-download"></i></a>
                                @endif
                            </td>
                        </tr>
                    </table>
{{--                    <div class="card-footer">--}}
{{--                        <p class="text-double">আপনি যদি ইভেন্টে অংশগ্রহণ করতে চান তাহলে Yes অথবা No সিলেক্ট করুন।</p>--}}
{{--                        <select class="form-select selectOption" aria-label="Default select example"--}}
{{--                                data-id="{{ $notice->id }}">--}}
{{--                            <option selected>Select Option</option>--}}
{{--                            <option value="1">Yes</option>--}}
{{--                            <option value="0">No</option>--}}
{{--                        </select>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')

@endpush

