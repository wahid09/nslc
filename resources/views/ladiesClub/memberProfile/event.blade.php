@extends('ladiesClub.layout.app')

@section('title', 'Events')

@push('css')
@endpush

@section('main_menu', 'Events')

@section('active_menu', 'Events')

@section('link', '')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12 mx-auto text-center">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>Event List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>Event Title</th>
                            <th>Event Description</th>
                            <th>Event Date</th>
                            <th>Status</th>
                            <th>Select (Yes/No) to attend event</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($events as $notice)
                            <tr>
                                <td>{{ $notice->title_bn }}</td>
                                <td>{!! $notice->description_bn !!}</td>
                                {{--                                <td>--}}
                                {{--                                    @if(!empty($notice->attachment))--}}
                                {{--                                        <a data-fancybox='' href="{{asset('storage/notices/'.$notice->attachment)}}"><i--}}
                                {{--                                                class="fa fa-eye"></i></a>--}}
                                {{--                                        <a href="{{url('notice-download/'.$notice->attachment)}}"><i--}}
                                {{--                                                class="fa fa-download"></i></a>--}}
                                {{--                                    @endif--}}
                                {{--                                </td>--}}
                                <td>
                                    @if(!empty($notice->event_date))
                                        {{ $notice->event_date }}
                                    @else
                                    @endif
                                </td>
                                <td>
                                    @if ($notice->status)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($notice->member_will_attend))
                                        @if($notice->member_will_attend == 1)
                                            <span class="badge badge-success">Attend</span>
                                        @else($notice->member_will_attend == 0)
                                            <span class="badge badge-warning">Not Attend</span>
                                        @endif
                                    @else
                                        <select class="form-select selectOption" aria-label="Default select example"
                                                data-id="{{ $notice->id }}">
                                            <option selected>Select Option</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('app.member.event.view', $notice->id)}}"
                                       class="btn btn-primary"><i
                                            class="fa fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
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
