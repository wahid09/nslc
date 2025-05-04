@extends('layouts.backend.app')
@push('css')
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ladiesclub/backend/css/select2.css') }}">--}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/ladiesclub/backend/css/datatables.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.2.2/css/buttons.bootstrap4.css"> --}}
{{--    <style>--}}
{{--        table,--}}
{{--        th,--}}
{{--        td {--}}
{{--            border: 1px solid black;--}}
{{--            border-collapse: collapse;--}}
{{--        }--}}
{{--    </style>--}}
<style>
    /* .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
        color: #333;
        display: contents;
    }
    div.dataTables_wrapper div.dataTables_filter input {
        margin-left: 0.5em;
        display: inline-block;
        width: auto;
        margin-bottom: 10px;
    } */
    .flex-wrap {
    flex-wrap: wrap !important;
    float: left;
}
</style>
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-file icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Member assign device</div>
            </div>
            <div class="page-title-actions">
                @permission('club-create')
{{--                <a href="{{ route('app.member-registration.create') }}" class="btn-shadow mr-3 btn btn-primary"--}}
{{--                   name="button">--}}
{{--                    <i class="fas fa-plus-circle"></i>&nbsp;Create Member--}}
{{--                </a>--}}
                @endpermission
            </div>
        </div>
    </div>
    {{--    @include('ladiesClub.report.userAssignDevice.searchPanel')--}}
    @include('ladiesClub.report.userAssignDevice.searchPanel')
{{--    <h6 class="card-title">Total: <span class="badge badge-secondary" id="total_data"></span></h6>--}}
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Total: <span class="badge badge-secondary" id="total_data"></span></h6>
                </div>
                <div class="card-body">
                    <table class="table table-bordered yajra-datatable">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Membership No.</th>
                            <th>Member Name</th>
                            <th>Member Spouse Name</th>
                            <th>Member Spouse Rank</th>
                            <th>Member Contact Number</th>
                            <th>RF ID Card No.</th>
{{--                            <th>Status</th>--}}
                            <th>Auth Date</th>
                            <th>Auth Time</th>
                            <th>Device</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
{{--    <script src="{{ asset('assets/ladiesclub/backend/js/select2/select2.full.min.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/ladiesclub/backend/js/datatable/datatables/plugin/datatables.min.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/ladiesclub/backend/js/sweetalert2.all.js') }}"></script>--}}
{{--    <script src="{{ asset('assets/ladiesclub/backend/js/datatable_sum.js') }}"></script>--}}

    {{-- <script src="{{ asset('assets/ladiesclub/backend/js/datatable/datatables/datatables.buttons.min.js') }}"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/3.2.2/js/dataTables.buttons.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.bootstrap4.js"></script> --}}
    {{-- <script src="{{ asset('assets/ladiesclub/backend/js/datatable/datatables/buttons.html5.min.js') }}"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.html5.min.js"></script> --}}
    {{-- <script src="{{ asset('assets/ladiesclub/backend/js/datatable/datatables/buttons.print.min.js') }}"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/3.2.2/js/buttons.print.min.js"></script> --}}
    {{-- <script src="{{ asset('assets/ladiesclub/backend/js/datatable/datatables/jszip.min.js') }}"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script> --}}
    @include('ladiesClub.report.userAssignDevice.assignDeviceJS')
@endpush
