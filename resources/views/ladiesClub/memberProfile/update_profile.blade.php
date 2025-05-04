@extends('ladiesClub.layout.app')

@section('title', 'Update Profile')

@push('css')
    <style>
        .form-control, .form-select{
            background-color: #fff;
            font-size: 14px;
            color: #717171;
            padding: 0.4em 0.3em;
        }
    </style>
@endpush

@section('main_menu', 'Notices')

@section('active_menu', 'Notices')

@section('link', '')

@section('content')
    {{--    <div class="app-page-title">--}}
    {{--        <div class="page-title-wrapper">--}}
    {{--            <div class="page-title-heading">--}}
    {{--                <div class="page-title-icon">--}}
    {{--                    <i class="fas fa-chart-area icon-gradient bg-mean-fruit"></i>--}}
    {{--                </div>--}}
    {{--                <div>{{ isset($member) ? 'Edit' : 'Create'}} Member</div>--}}
    {{--            </div>--}}
    {{--            <div class="page-title-actions">--}}
    {{--                <a href="" class="btn-shadow mr-3 btn btn-warning"--}}
    {{--                   name="button">--}}
    {{--                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list--}}
    {{--                </a>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}


    <div class="row">
        <div class="col-12">
            <form
                action="{{route('app.member.updateSave')}}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-header text-center">
                                <b style="font-size: large">Husband's Information</b>
                            </div>
                            <div class="card-body">
                                {{--                                <h5 class="card-title">Manage Module</h5>--}}

                                <div class="form-group">
                                    <label for="name">Husband's Name *</label>
                                    <input id="name" type="text"
                                           class="form-control @error('spouse_name_en') is-invalid @enderror"
                                           name="spouse_name_en"
                                           value="{{ $member->spouse_name_en ?? old('spouse_name_en') }}" required
                                           autocomplete="name"
                                           autofocus>

                                    @error('spouse_name_en')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="name_bn">Husband's Name (In Bangla)</label>
                                    <input id="name_bn" type="text"
                                           class="form-control @error('spouse_name_bn') is-invalid @enderror"
                                           name="spouse_name_bn"
                                           value="{{ $member->spouse_name_bn ?? old('spouse_name_bn') }}"
                                           autocomplete="spouse_name_bn" autofocus>

                                    @error('spouse_name_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name_bn">BA No.</label>
                                    <input id="name_bn" type="text"
                                           class="form-control @error('spouse_ba_no') is-invalid @enderror"
                                           name="spouse_ba_no"
                                           value="{{ $member->spouse_ba_no ?? old('spouse_ba_no') }}" required
                                           autocomplete="spouse_ba_no" autofocus>

                                    @error('spouse_ba_no')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name_bn">Rank</label>
                                    <select id="rank_id"
                                            class="form-control @error('rank_id') is-invalid @enderror rankSelect"
                                            name="rank_id" required autofocus>
                                        <option></option>
                                        @foreach ($ranks as $item)
                                            <option value="{{ $item->id}}" @isset($member)
                                                {{($member->rank_id == $item->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $item->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('rank_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name_bn">Working Unit</label>
                                    <select id="unit_id"
                                            class="form-control @error('unit_id') is-invalid @enderror unitSelect"
                                            name="unit_id" required autofocus>
                                        <option></option>
                                        @foreach ($units as $item)
                                            <option value="{{ $item->id}}" @isset($member)
                                                {{($member->unit_id == $item->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $item->unit_name_en}}</option>
                                        @endforeach
                                    </select>
                                    @error('unit_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name_bn">Phone No.</label>
                                    <input id="spouse_phone_number" type="text"
                                           class="form-control @error('spouse_phone_number') is-invalid @enderror"
                                           name="spouse_phone_number"
                                           value="{{ $member->spouse_phone_number ?? old('spouse_phone_number') }}"
                                           required
                                           autocomplete="spouse_phone_number" autofocus>

                                    @error('spouse_phone_number')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{--                                <div class="form-group">--}}
                                {{--                                    --}}{{-- <label for="status">Status</label> --}}
                                {{--                                    <div class="custom-control custom-switch">--}}
                                {{--                                        <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" id="status" name="status" @isset($area) {{ $area->status==true ? 'checked' : ''}} @endisset>--}}
                                {{--                                        <label class="custom-control-label" for="status">Status</label>--}}
                                {{--                                    </div>--}}
                                {{--                                    @error('status')--}}
                                {{--                                    <span class="invalid-feedback" role="alert">--}}
                                {{--                                    <strong>{{ $message }}</strong>--}}
                                {{--                                    </span>--}}
                                {{--                                    @enderror--}}
                                {{--                                </div>--}}
                            </div>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-header text-center">
                                <b style="font-size: large">Member's Information</b>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Membership No *</label>
                                    <input id="membership_no" type="text"
                                           class="form-control @error('membership_no') is-invalid @enderror"
                                           name="membership_no"
                                           value="{{ $member->membership_no ?? old('membership_no') }}" required
                                           autocomplete="membership_no"
                                           autofocus>

                                    @error('membership_no')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Member Name *</label>
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ $member->user_name ?? old('name') }}" required autocomplete="name"
                                           autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Member Name (In Bangla) *</label>
                                    <input id="name_bn" type="text"
                                           class="form-control @error('name_bn') is-invalid @enderror" name="name_bn"
                                           value="{{ $member->user_name_bn ?? old('name_bn') }}" required
                                           autocomplete="name_bn"
                                           autofocus>

                                    @error('name_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Member Phone No. *</label>
                                    <input id="phone" type="text"
                                           class="form-control @error('phone') is-invalid @enderror" name="phone"
                                           value="{{ $member->member_phone ?? old('phone') }}" required
                                           autocomplete="phone"
                                           autofocus>

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Member Email *</label>
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror" name="email"
                                           value="{{ $member->email ?? old('email') }}" required autocomplete="email"
                                           autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{--                                <div class="form-group">--}}
                                {{--                                    <label for="name">Select Area for<strong>(Ladies Club)</strong> *</label>--}}
                                {{--                                    <select id="area_id"--}}
                                {{--                                            class="form-control @error('area_id') is-invalid @enderror areaSelect"--}}
                                {{--                                            name="area_id" required autofocus>--}}
                                {{--                                        <option></option>--}}
                                {{--                                        @foreach ($areas as $item)--}}
                                {{--                                            <option value="{{ $item->id}}" @isset($member)--}}
                                {{--                                                {{($member->area_id == $item->id) ? 'selected' : ''}}--}}
                                {{--                                                @endisset--}}
                                {{--                                            >{{ $item->name}}</option>--}}
                                {{--                                        @endforeach--}}
                                {{--                                    </select>--}}
                                {{--                                    @error('area_id')--}}
                                {{--                                    <span class="invalid-feedback" role="alert">--}}
                                {{--                                    <strong>{{ $message }}</strong>--}}
                                {{--                                    </span>--}}
                                {{--                                    @enderror--}}
                                {{--                                </div>--}}
                                <div class="form-group">
                                    <label for="appointment">Blood Group *</label>
                                    <select id="blood_group_id"
                                            class="form-control @error('blood_group_id') is-invalid @enderror roleSelect"
                                            name="blood_group_id" required autofocus>
                                        <option></option>
                                        @foreach ($bloodGroup as $item)
                                            <option value="{{ $item->id}}" @isset($member)
                                                {{($member->blood_group_id == $item->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $item->group_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('blood_group_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{--                                <div class="form-group">--}}
                                {{--                                    <label for="name">Expiry Date *</label>--}}
                                {{--                                    <input id="expiry_date" type="date"--}}
                                {{--                                           class="form-control @error('expiry_date') is-invalid @enderror"--}}
                                {{--                                           name="expiry_date"--}}
                                {{--                                           value="@if(isset($member)){{ \Carbon\Carbon::parse($member->expiry_date)->format('Y-m-d') ?? old('expiry_date') }}"--}}
                                {{--                                           @endif required--}}
                                {{--                                           autocomplete="expiry_date"--}}
                                {{--                                           autofocus>--}}

                                {{--                                    @error('expiry_date')--}}
                                {{--                                    <span class="invalid-feedback" role="alert">--}}
                                {{--                                    <strong>{{ $message }}</strong>--}}
                                {{--                                    </span>--}}
                                {{--                                    @enderror--}}
                                {{--                                </div>--}}
                                {{--                                <div class="form-group">--}}
                                {{--                                    --}}{{-- <label for="status">Status</label> --}}
                                {{--                                    <div class="custom-control custom-switch">--}}
                                {{--                                        <input type="checkbox"--}}
                                {{--                                               class="custom-control-input @error('status') is-invalid @enderror"--}}
                                {{--                                               id="status"--}}
                                {{--                                               name="status" @isset($member) {{ $member->user_status==true ? 'checked' : ''}} @endisset>--}}
                                {{--                                        <label class="custom-control-label" for="status">Status</label>--}}
                                {{--                                    </div>--}}
                                {{--                                    @error('status')--}}
                                {{--                                    <span class="invalid-feedback" role="alert">--}}
                                {{--                                    <strong>{{ $message }}</strong>--}}
                                {{--                                    </span>--}}
                                {{--                                    @enderror--}}
                                {{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer float-right">
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-arrow-circle-up"></i>&nbsp;Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
@endpush
