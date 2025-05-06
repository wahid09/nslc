@extends('layouts.backend.app')
@push('css')
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
    @include('ladiesClub.report.userAssignDevice.assignDeviceJS')
@endpush
