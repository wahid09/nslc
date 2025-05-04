@extends('layouts.backend.app')
@push('css')
    <link rel="stylesheet" href="{{asset('assets/datatable/css/dataTables.bootstrap4.min.css')}}">
@endpush

@section('content')
    <div class="card">
        <h5 class="card-header">Notice Details</h5>
        <div class="card-body">
            <h5 class="card-title">{{$notice->title_bn}}</h5>
            <p>{{$notice->notice_date}}</p>
            <p class="card-text">{!! $notice->description_bn !!}</p>
            @if($notice->attachment)
                <a href="{{url('files/'.$notice->attachment)}}" class="btn btn-primary"><i class="fa fa-download"></i>Download</a>
                @endif
        </div>
    </div>
@endsection
@push('js')



@endpush
