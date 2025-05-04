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
                <div>Member Assign Device</div>
            </div>
            <div class="page-title-actions">
                @permission('club-create')
                <a href="{{ route('app.member-registration.index') }}" class="btn-shadow mr-3 btn btn-warning"
                   name="button">
                    <i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Back to List
                </a>
                @endpermission
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <form action="{{route('app.user.assignDeviceSave')}}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">Member Information</div>
                                    <div class="card-body">
                                        <input name="user_id" type="hidden" value="{{$memberInfo->id}}">
                                        <input name="rfid" type="hidden" value="{{$memberInfo->id_card_number}}">
                                        <input name="club_id" type="hidden" value="{{$memberInfo->club_id}}">
                                        <input name="area_id" type="hidden" value="{{$memberInfo->area_id}}">
                                        <table class="table table-condensed border">
                                            <tbody>
                                            <tr>
                                                <td>#</td>
                                                <td>Membership No.</td>
                                                <td>{{$memberInfo->membership_no}}</td>
                                            </tr>
                                            <tr>
                                                <td>#</td>
                                                <td>BA-No.</td>
                                                <td><b>{{$memberInfo->ba_no}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>#</td>
                                                <td>Member's Name:</td>
                                                <td><b>{{$memberInfo->name}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>#</td>
                                                <td>RFID Card No.</td>
                                                <td><b>{{$memberInfo->id_card_number}}</b></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="main-card mb-3 card">
                                    <div class="card-header">Device List</div>
                                    <div class="card-body">
                                        <fieldset class="position-relative form-group">
                                            @foreach($devices as $item)
                                                <div class="position-relative form-check">
                                                    <label class="form-check-label">
                                                        <input name="device[]" type="checkbox" class="form-check-input" value="{{$item->id}}" @if (collect($assignDevices)->contains('device_id', $item->id)) checked @endif>
                                                        {{$item->device_name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-success text-center">Update and Continue</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')

@endpush
