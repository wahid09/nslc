@extends('ladiesClub.layout.app')
@section('title', 'Event Details View')
@section('main_menu', 'Event')
@section('active_menu', 'Event')
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
                            <td>{{$event->title_bn}}</td>
                        </tr>
                        <tr>
                            <th>Event Details:</th>
                            <td>{!! $event->description_bn !!}</td>
                        </tr>
                        <tr>
                            <th>Event Date:</th>
                            <td>{{$event->event_date}}</td>
                        </tr>
{{--                        <tr>--}}
{{--                            <th>Event Attachment:</th>--}}
{{--                            <td>--}}
{{--                                @if(!empty($notice->attachment))--}}
{{--                                    <a data-fancybox='' href="{{asset('storage/notices/'.$notice->attachment)}}"><i--}}
{{--                                            class="fa fa-eye"></i></a>--}}
{{--                                    <a href="{{url('notice-download/'.$notice->attachment)}}"><i--}}
{{--                                            class="fa fa-download"></i></a>--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                        </tr>--}}
                    </table>
                    <div class="card-footer">
                        <p class="text-double">আপনি যদি ইভেন্টে অংশগ্রহণ করতে চান তাহলে Yes অথবা No সিলেক্ট করুন।</p>
                        <select class="form-select selectOption" aria-label="Default select example"
                                data-id="{{ $event->id }}">
                            <option selected>Select Option</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('.selectOption').on('change', function () {
                    const selectedValue = $(this).val();
                    const noticeId = $(this).data('id');
                    const confirmAction = confirm('Are you sure you want to submit this option?');
                    if (confirmAction) {
                        let route = '{{ route("app.member.attend.event", ":id") }}';
                        route = route.replace(':id', noticeId);
                        $.ajax({
                            url: route, // dynamic ID in URL
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                selectedOption: selectedValue
                            },
                            success: function (response) {
                                if (response.success) {
                                    $('#responseMessage').text(response.message).show();
                                }
                            },
                            error: function (xhr) {
                                //console.error('Error:', xhr.responseText);
                            }
                        });
                    } else {
                        // If user clicks Cancel, do nothing
                        console.log('Action canceled');
                    }
                }
            );
        });

    </script>
@endpush

