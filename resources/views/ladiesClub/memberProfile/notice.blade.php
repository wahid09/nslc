@extends('ladiesClub.layout.app')

@section('title', 'Notices')

@push('css')
@endpush

@section('main_menu', 'Notices')

@section('active_menu', 'Notices')

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
                    <h3>Notice List</h3>
                </div>
                <div class="card-body">
                    <table class="table table-responsive">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Attachment</th>
                            <th>Event Date</th>
                            <th>Status</th>
{{--                            <th>Select (Yes/No) to attend event</th>--}}
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($notices as $notice)
                            <tr>
                                <td>{{ $notice->title_bn }}</td>
                                <td>{!! $notice->description_bn !!}</td>
                                <td>
                                    @if(!empty($notice->attachment))
                                        <a data-fancybox='' href="{{asset('storage/notices/'.$notice->attachment)}}"><i
                                                class="fa fa-eye"></i></a>
                                        <a href="{{url('notice-download/'.$notice->attachment)}}"><i
                                                class="fa fa-download"></i></a>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($notice->notice_date))
                                        {{ $notice->notice_date }}
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
{{--                                <td>--}}
{{--                                    <select class="form-select selectOption" aria-label="Default select example"--}}
{{--                                            data-id="{{ $notice->id }}">--}}
{{--                                        <option selected>Select Option</option>--}}
{{--                                        <option value="1">Yes</option>--}}
{{--                                        <option value="0">No</option>--}}
{{--                                    </select>--}}
{{--                                </td>--}}
                                <td>
                                    <a href="{{ route('app.member.notice.view', $notice->id)}}" class="btn btn-primary"><i
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
@endpush
