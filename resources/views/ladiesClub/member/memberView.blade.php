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
                <div>Member Profile</div>
            </div>
            <div class="page-title-actions">
                {{--                @permission('club-create')--}}
                <a href="{{ route('app.member-registration.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-alt-circle-left"></i>&nbsp;Back to List
                </a>
                {{--                @endpermission--}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <ul class="body-tabs body-tabs-layout tabs-animated body-tabs-animated nav">
                        <li class="nav-item">
                            <a role="tab" class="nav-link active" id="tab-0" data-toggle="tab" href="#tab-content-0">
                                <span>Member Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a role="tab" class="nav-link" id="tab-1" data-toggle="tab" href="#tab-content-1">
                                <span>RF ID Card</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-2">
                                <span>Change Password</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-3">
                                <span>profile Picture Update</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a role="tab" class="nav-link" id="tab-2" data-toggle="tab" href="#tab-content-4">
                                <span>Update Signature</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card-shadow-primary card-border mb-3 card">
                                        <div class="dropdown-menu-header">
                                            <div class="dropdown-menu-header-inner bg-dark">
                                                <div class="menu-header-content">
                                                    <div class="avatar-icon-wrapper mb-3 avatar-icon-xl">
                                                        <div class="avatar-icon">
                                                            <img
                                                                src="{{ $member->member_image ? asset('storage/memberImage/' . $member->member_image) : asset('assets/ladiesclub/backend/images/default-image.png') }}"
                                                                alt="Avatar 5">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h5 class="menu-header-title">{{$member->member_name}}</h5>
                                                        <h6 class="menu-header-subtitle">Designation</h6>
                                                    </div>
                                                    {{--                                                    <div class="menu-header-btn-pane pt-1">--}}
                                                    {{--                                                        <button class="btn-icon btn btn-warning btn-sm">View--}}
                                                    {{--                                                            Complete Profile--}}
                                                    {{--                                                        </button>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            {{--                                            <h6 class="text-muted text-uppercase font-size-md opacity-5 font-weight-normal">--}}
                                            {{--                                                Top Authors</h6>--}}
                                            <ul class="rm-list-borders list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                {{--                                                                <img width="42" class="rounded-circle"--}}
                                                                {{--                                                                     src="assets/images/avatars/5.jpg" alt="">--}}
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-user">
                                                                    <path
                                                                        d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                    <circle cx="12" cy="7" r="4"></circle>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">
                                                                    {{--                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>--}}
                                                                    Member Name
                                                                </div>
                                                                <div class="widget-subheading">Web Developer</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-user">
                                                                    <path
                                                                        d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                    <circle cx="12" cy="7" r="4"></circle>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Membership No.</div>
                                                                <div
                                                                    class="widget-subheading">{{$member->membership_no}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0 pt-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-home">
                                                                    <path
                                                                        d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Club</div>
                                                                <div
                                                                    class="widget-subheading">{{$member->club_name}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-tag">
                                                                    <path
                                                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                                                    <line x1="7" y1="7" x2="7" y2="7"></line>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Rank / Designation</div>
                                                                <div class="widget-subheading">{{$member->rank_name}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-tag">
                                                                    <path
                                                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                                                    <line x1="7" y1="7" x2="7" y2="7"></line>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Blood Group</div>
                                                                <div class="widget-subheading">{{$member->group_name}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-phone">
                                                                    <path
                                                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Phone</div>
                                                                <div class="widget-subheading">{{$member->member_phone}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-map-pin">
                                                                    <path
                                                                        d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                                    <circle cx="12" cy="10" r="3"></circle>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Signature</div>
                                                                <div class="widget-subheading">
                                                                    <img
                                                                        src="{{ $member->member_signature ? asset('storage/memberSignature/' . $member->member_signature) : asset('assets/ladiesclub/backend/images/default-image.png') }}"/>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text-center d-block card-footer">
                                            <a href="{{route('app.card.front', $member->user_id)}}" class="btn btn-info">Print ID Card-Front</a>
                                            <a href="{{route('app.card.back', $member->user_id)}}" class="btn btn-info">Print ID Card-Back</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="tab-content" id="top-tabContent">
                                        <div class="tab-pane fade active show" id="timeline" role="tabpanel"
                                             aria-labelledby="timeline">
                                            <div class="card card-absolute">
                                                <div class="card-header bg-secondary">
                                                    <h5 class="text-white">Member Details</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="box">
                                                        <div class="box-body no-padding">
                                                            <table class="table table-condensed border">
                                                                <tbody>
                                                                <tr>
                                                                    <td>#</td>
                                                                    <td>Member's Name:</td>
                                                                    <td><b>{{$member->member_name}}</b></td>

                                                                    <td>#</td>
                                                                    <td>Husband's Name:</td>
                                                                    <td><b>{{$member->spouse_name_en}}</b></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>#</td>
                                                                    <td>Member's Name (In Bangla):</td>
                                                                    <td><b>{{$member->member_name_bn}}</b></td>

                                                                    <td>#</td>
                                                                    <td>Husband's Name (In Bangla):</td>
                                                                    <td><b>{{$member->spouse_name_bn}}</b></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>#</td>
                                                                    <td>Membership No:</td>
                                                                    <td><b>{{$member->membership_no}}</b></td>

                                                                    <td>#</td>
                                                                    <td>BA No:</td>
                                                                    <td><b>{{$member->spouse_ba_no}}</b></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>#</td>
                                                                    <td>Email:</td>
                                                                    <td><b>{{$member->member_email}}</b></td>

                                                                    <td>#</td>
                                                                    <td>Rank / Designation:</td>
                                                                    <td><b>{{$member->rank_name}}</b></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>#</td>
                                                                    <td>Phone:</td>
                                                                    <td><b>{{$member->member_phone}}</b></td>

                                                                    <td>#</td>
                                                                    <td>Working Unit:</td>
                                                                    <td><b>{{$member->unit_name_en}}</b></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>#</td>
                                                                    <td>RFID Card No:</td>
                                                                    <td><b>{{$member->id_card_number}}</b></td>

                                                                    <td>#</td>
                                                                    <td>Husband's Phone No:</td>
                                                                    <td><b>{{$member->spouse_phone_number}}</b></td>
                                                                </tr>

                                                                <tr>
                                                                    <td>#</td>
                                                                    <td>Status</td>
                                                                    <td>
                                                                        @if($member->status == true)
                                                                            <b
                                                                                class="right badge badge-success">Active</b>
                                                                        @else
                                                                            <b
                                                                                class="right badge badge-success">Inactive</b>
                                                                        @endif
                                                                    </td>

                                                                    {{--                                                                    <td></td>--}}
                                                                    {{--                                                                    <td></td>--}}
                                                                    {{--                                                                    <td></td>--}}
                                                                </tr>

                                                                <tr>
                                                                    <td class="bg-secondary">#</td>
                                                                    <td class="bg-secondary">Member Since:</td>
                                                                    <td class="bg-secondary">
                                                                        <b>{{ \Carbon\Carbon::parse($member->membership_date)->format('d-M-Y') }}</b>
                                                                    </td>

                                                                    <td class="bg-success">#</td>
                                                                    <td class="bg-success">Last Payment Date:</td>
                                                                    <td class="bg-success">
                                                                        @if(!empty($lastPayDate->pay_month))
                                                                            <b>{{ \Carbon\Carbon::parse($lastPayDate->pay_month)->format('d-M-Y') }}</b>
                                                                        @else
                                                                            <b>No Record Available</b>
                                                                        @endif
                                                                    </td>
                                                                </tr>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane tabs-animation fade" id="tab-content-1" role="tabpanel">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card-shadow-primary card-border mb-3 card">
                                        <div class="dropdown-menu-header">
                                            <div class="dropdown-menu-header-inner bg-dark">
                                                <div class="menu-header-content">
                                                    <div class="avatar-icon-wrapper mb-3 avatar-icon-xl">
                                                        <div class="avatar-icon">
                                                            <img
                                                                src="{{ $member->member_image ? asset('storage/memberImage/' . $member->member_image) : asset('assets/ladiesclub/backend/images/default-image.png') }}"
                                                                alt="Avatar 5">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h5 class="menu-header-title">{{$member->member_name}}</h5>
                                                        <h6 class="menu-header-subtitle">Designation</h6>
                                                    </div>
                                                    {{--                                                    <div class="menu-header-btn-pane pt-1">--}}
                                                    {{--                                                        <button class="btn-icon btn btn-warning btn-sm">View--}}
                                                    {{--                                                            Complete Profile--}}
                                                    {{--                                                        </button>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            {{--                                            <h6 class="text-muted text-uppercase font-size-md opacity-5 font-weight-normal">--}}
                                            {{--                                                Top Authors</h6>--}}
                                            <ul class="rm-list-borders list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                {{--                                                                <img width="42" class="rounded-circle"--}}
                                                                {{--                                                                     src="assets/images/avatars/5.jpg" alt="">--}}
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-user">
                                                                    <path
                                                                        d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                    <circle cx="12" cy="7" r="4"></circle>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">
                                                                    {{--                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>--}}
                                                                    Member Name
                                                                </div>
                                                                <div class="widget-subheading">Web Developer</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-user">
                                                                    <path
                                                                        d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                    <circle cx="12" cy="7" r="4"></circle>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Membership No.</div>
                                                                <div
                                                                    class="widget-subheading">{{$member->membership_no}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0 pt-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-home">
                                                                    <path
                                                                        d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Club</div>
                                                                <div
                                                                    class="widget-subheading">{{$member->club_name}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-tag">
                                                                    <path
                                                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                                                    <line x1="7" y1="7" x2="7" y2="7"></line>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Rank / Designation</div>
                                                                <div class="widget-subheading">{{$member->rank_name}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-tag">
                                                                    <path
                                                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                                                    <line x1="7" y1="7" x2="7" y2="7"></line>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Blood Group</div>
                                                                <div class="widget-subheading">{{$member->group_name}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-phone">
                                                                    <path
                                                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Phone</div>
                                                                <div class="widget-subheading">{{$member->member_phone}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-map-pin">
                                                                    <path
                                                                        d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                                    <circle cx="12" cy="10" r="3"></circle>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Signature</div>
                                                                <div class="widget-subheading">
                                                                    <img
                                                                        src="{{ $member->member_signature ? asset('storage/memberSignature/' . $member->member_signature) : asset('assets/ladiesclub/backend/images/default-image.png') }}"/>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text-center d-block card-footer">
                                            <a href="{{route('app.card.front', $member->user_id)}}" class="btn btn-info">Print ID Card-Front</a>
                                            <a href="{{route('app.card.back', $member->user_id)}}" class="btn btn-info">Print ID Card-Back</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="card card-absolute">
                                        <div class="card-header bg-secondary">
                                            <h5 class="text-white">RF ID Card</h5>
                                        </div>
                                        <div class="card-body">
                                            <div id="responseMessage"></div>
                                            <form action="#"
                                                  method="post" id="idCardForm">
                                                @csrf
                                                <div class="box">
                                                    <div class="box-body p-3">
                                                        <div class="alert alert-primary bold" role="alert">
                                                            <p>Current RF ID Card:
                                                                {{$member->id_card_number}}
                                                            </p>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="col-form-label required">New RF ID Card
                                                                No: </label>
                                                            <input type="text" name="rfid" class="form-control input-lg"
                                                                   value="{{$member->id_card_number}}" id="cardNo">
                                                            <input type="hidden" value="{{$member->user_id}}"
                                                                   id="userId">
                                                        </div>

                                                        <button class="btn btn-success" type="submit"
                                                                onclick="return confirm('Are you sure you want to save the new RF ID card number?')">
                                                            Save
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="tab-pane tabs-animation fade" id="tab-content-2" role="tabpanel">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card-shadow-primary card-border mb-3 card">
                                        <div class="dropdown-menu-header">
                                            <div class="dropdown-menu-header-inner bg-dark">
                                                <div class="menu-header-content">
                                                    <div class="avatar-icon-wrapper mb-3 avatar-icon-xl">
                                                        <div class="avatar-icon">
                                                            <img
                                                                src="{{ $member->member_image ? asset('storage/memberImage/' . $member->member_image) : asset('assets/ladiesclub/backend/images/default-image.png') }}"
                                                                alt="Avatar 5">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h5 class="menu-header-title">{{$member->member_name}}</h5>
                                                        <h6 class="menu-header-subtitle">Designation</h6>
                                                    </div>
                                                    {{--                                                    <div class="menu-header-btn-pane pt-1">--}}
                                                    {{--                                                        <button class="btn-icon btn btn-warning btn-sm">View--}}
                                                    {{--                                                            Complete Profile--}}
                                                    {{--                                                        </button>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            {{--                                            <h6 class="text-muted text-uppercase font-size-md opacity-5 font-weight-normal">--}}
                                            {{--                                                Top Authors</h6>--}}
                                            <ul class="rm-list-borders list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                {{--                                                                <img width="42" class="rounded-circle"--}}
                                                                {{--                                                                     src="assets/images/avatars/5.jpg" alt="">--}}
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-user">
                                                                    <path
                                                                        d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                    <circle cx="12" cy="7" r="4"></circle>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">
                                                                    {{--                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>--}}
                                                                    Member Name
                                                                </div>
                                                                <div class="widget-subheading">Web Developer</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-user">
                                                                    <path
                                                                        d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                    <circle cx="12" cy="7" r="4"></circle>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Membership No.</div>
                                                                <div
                                                                    class="widget-subheading">{{$member->membership_no}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0 pt-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-home">
                                                                    <path
                                                                        d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Club</div>
                                                                <div
                                                                    class="widget-subheading">{{$member->club_name}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-tag">
                                                                    <path
                                                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                                                    <line x1="7" y1="7" x2="7" y2="7"></line>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Rank / Designation</div>
                                                                <div class="widget-subheading">{{$member->rank_name}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-tag">
                                                                    <path
                                                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                                                    <line x1="7" y1="7" x2="7" y2="7"></line>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Blood Group</div>
                                                                <div class="widget-subheading">{{$member->group_name}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-phone">
                                                                    <path
                                                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Phone</div>
                                                                <div class="widget-subheading">{{$member->member_phone}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-map-pin">
                                                                    <path
                                                                        d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                                    <circle cx="12" cy="10" r="3"></circle>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Signature</div>
                                                                <div class="widget-subheading">
                                                                    <img
                                                                        src="{{ $member->member_signature ? asset('storage/memberSignature/' . $member->member_signature) : asset('assets/ladiesclub/backend/images/default-image.png') }}"/>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text-center d-block card-footer">
                                            <a href="{{route('app.card.front', $member->user_id)}}" class="btn btn-info">Print ID Card-Front</a>
                                            <a href="{{route('app.card.back', $member->user_id)}}" class="btn btn-info">Print ID Card-Back</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="card card-absolute">
                                        <div class="card-header bg-secondary">
                                            <h5 class="text-white">Change Password</h5>
                                        </div>
                                        <div class="card-body mb-3">
                                            <div id="responseMessage"></div>
                                            <div class="box">
                                                <div class="box-body no-padding">
                                                    <form method="POST"
                                                          action="" id="passwordUpdate">
                                                        @csrf
                                                        <div class="form-group row">
                                                            <label for="password"
                                                                   class="col-md-4 col-form-label text-lg-right">New
                                                                Password <strong class="text-danger">(Password needs to
                                                                    have at least 8
                                                                    characters)
                                                                </strong></label>

                                                            <div class="col-md-6">
                                                                <input id="password" type="password"
                                                                       class="form-control"
                                                                       name="password" autocomplete="current-password"
                                                                       aria-invalid="password">
                                                                <input type="hidden" name="user_id"
                                                                       value="{{$member->user_id}}" id="user_id">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="password_confirmation"
                                                                   class="col-md-4 col-form-label text-lg-right">New
                                                                Confirm
                                                                Password <strong class="text-danger">(Password needs to
                                                                    have at least 8
                                                                    characters)</strong></label>
                                                            <div class="col-md-6">
                                                                <input id="password_confirmation" type="password"
                                                                       class="form-control" name="password_confirmation"
                                                                       autocomplete="password_confirmation"
                                                                       id="password_confirmation">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-8 offset-md-4">
                                                                <button type="submit" class="btn btn-primary">
                                                                    Update Password
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane tabs-animation fade" id="tab-content-3" role="tabpanel">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card-shadow-primary card-border mb-3 card">
                                        <div class="dropdown-menu-header">
                                            <div class="dropdown-menu-header-inner bg-dark">
                                                <div class="menu-header-content">
                                                    <div class="avatar-icon-wrapper mb-3 avatar-icon-xl">
                                                        <div class="avatar-icon">
                                                            <img
                                                                src="{{ $member->member_image ? asset('storage/memberImage/' . $member->member_image) : asset('assets/ladiesclub/backend/images/default-image.png') }}"
                                                                alt="Avatar 5">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h5 class="menu-header-title">{{$member->member_name}}</h5>
                                                        <h6 class="menu-header-subtitle">Designation</h6>
                                                    </div>
                                                    {{--                                                    <div class="menu-header-btn-pane pt-1">--}}
                                                    {{--                                                        <button class="btn-icon btn btn-warning btn-sm">View--}}
                                                    {{--                                                            Complete Profile--}}
                                                    {{--                                                        </button>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            {{--                                            <h6 class="text-muted text-uppercase font-size-md opacity-5 font-weight-normal">--}}
                                            {{--                                                Top Authors</h6>--}}
                                            <ul class="rm-list-borders list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                {{--                                                                <img width="42" class="rounded-circle"--}}
                                                                {{--                                                                     src="assets/images/avatars/5.jpg" alt="">--}}
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-user">
                                                                    <path
                                                                        d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                    <circle cx="12" cy="7" r="4"></circle>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">
                                                                    {{--                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>--}}
                                                                    Member Name
                                                                </div>
                                                                <div class="widget-subheading">Web Developer</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-user">
                                                                    <path
                                                                        d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                    <circle cx="12" cy="7" r="4"></circle>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Membership No.</div>
                                                                <div
                                                                    class="widget-subheading">{{$member->membership_no}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0 pt-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-home">
                                                                    <path
                                                                        d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Club</div>
                                                                <div
                                                                    class="widget-subheading">{{$member->club_name}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-tag">
                                                                    <path
                                                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                                                    <line x1="7" y1="7" x2="7" y2="7"></line>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Rank / Designation</div>
                                                                <div class="widget-subheading">{{$member->rank_name}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-tag">
                                                                    <path
                                                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                                                    <line x1="7" y1="7" x2="7" y2="7"></line>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Blood Group</div>
                                                                <div class="widget-subheading">{{$member->group_name}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-phone">
                                                                    <path
                                                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Phone</div>
                                                                <div class="widget-subheading">{{$member->member_phone}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-map-pin">
                                                                    <path
                                                                        d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                                    <circle cx="12" cy="10" r="3"></circle>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Signature</div>
                                                                <div class="widget-subheading">
                                                                    <img
                                                                        src="{{ $member->member_signature ? asset('storage/memberSignature/' . $member->member_signature) : asset('assets/ladiesclub/backend/images/default-image.png') }}"/>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text-center d-block card-footer">
                                            <a href="{{route('app.card.front', $member->user_id)}}" class="btn btn-info">Print ID Card-Front</a>
                                            <a href="{{route('app.card.back', $member->user_id)}}" class="btn btn-info">Print ID Card-Back</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="card card-absolute">
                                        <div class="card-header bg-secondary">
                                            <h5 class="text-white">Profile Picture Update</h5>
                                        </div>
                                        <div class="card-body mb-3">
                                            <div id="responseMessage"></div>
                                            <div class="box">
                                                <div class="box-body no-padding">
                                                    <form method="POST"
                                                          action="" id="profileUpdate">
                                                        @csrf
                                                        <div class="form-group row">
                                                            <label for="password"
                                                                   class="col-md-4 col-form-label text-lg-right">Image
                                                                </strong></label>

                                                            <div class="col-md-6">
                                                                <input id="image" type="file"
                                                                       class="form-control"
                                                                       name="image" autocomplete="current-password"
                                                                       aria-invalid="image">
                                                                <input type="hidden" name="user_id"
                                                                       value="{{$member->user_id}}" id="user_id">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-8 offset-md-4">
                                                                <button type="submit" class="btn btn-primary">
                                                                    Update
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane tabs-animation fade" id="tab-content-4" role="tabpanel">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card-shadow-primary card-border mb-3 card">
                                        <div class="dropdown-menu-header">
                                            <div class="dropdown-menu-header-inner bg-dark">
                                                <div class="menu-header-content">
                                                    <div class="avatar-icon-wrapper mb-3 avatar-icon-xl">
                                                        <div class="avatar-icon">
                                                            <img
                                                                src="{{ $member->member_image ? asset('storage/memberImage/' . $member->member_image) : asset('assets/ladiesclub/backend/images/default-image.png') }}"
                                                                alt="Avatar 5">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <h5 class="menu-header-title">{{$member->member_name}}</h5>
                                                        <h6 class="menu-header-subtitle">Designation</h6>
                                                    </div>
                                                    {{--                                                    <div class="menu-header-btn-pane pt-1">--}}
                                                    {{--                                                        <button class="btn-icon btn btn-warning btn-sm">View--}}
                                                    {{--                                                            Complete Profile--}}
                                                    {{--                                                        </button>--}}
                                                    {{--                                                    </div>--}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-3">
                                            {{--                                            <h6 class="text-muted text-uppercase font-size-md opacity-5 font-weight-normal">--}}
                                            {{--                                                Top Authors</h6>--}}
                                            <ul class="rm-list-borders list-group list-group-flush">
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                {{--                                                                <img width="42" class="rounded-circle"--}}
                                                                {{--                                                                     src="assets/images/avatars/5.jpg" alt="">--}}
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-user">
                                                                    <path
                                                                        d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                    <circle cx="12" cy="7" r="4"></circle>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">
                                                                    {{--                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>--}}
                                                                    Member Name
                                                                </div>
                                                                <div class="widget-subheading">Web Developer</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-user">
                                                                    <path
                                                                        d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                                    <circle cx="12" cy="7" r="4"></circle>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Membership No.</div>
                                                                <div
                                                                    class="widget-subheading">{{$member->membership_no}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0 pt-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-home">
                                                                    <path
                                                                        d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                                                    <polyline points="9 22 9 12 15 12 15 22"></polyline>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Club</div>
                                                                <div
                                                                    class="widget-subheading">{{$member->club_name}}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-tag">
                                                                    <path
                                                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                                                    <line x1="7" y1="7" x2="7" y2="7"></line>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Rank / Designation</div>
                                                                <div class="widget-subheading">{{$member->rank_name}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-tag">
                                                                    <path
                                                                        d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                                                                    <line x1="7" y1="7" x2="7" y2="7"></line>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Blood Group</div>
                                                                <div class="widget-subheading">{{$member->group_name}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-phone">
                                                                    <path
                                                                        d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Phone</div>
                                                                <div class="widget-subheading">{{$member->member_phone}}
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="list-group-item">
                                                    <div class="widget-content p-0">
                                                        <div class="widget-content-wrapper">
                                                            <div class="widget-content-left mr-3">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                     height="24" viewBox="0 0 24 24" fill="none"
                                                                     stroke="currentColor" stroke-width="2"
                                                                     stroke-linecap="round" stroke-linejoin="round"
                                                                     class="feather feather-map-pin">
                                                                    <path
                                                                        d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                                    <circle cx="12" cy="10" r="3"></circle>
                                                                </svg>
                                                            </div>
                                                            <div class="widget-content-left">
                                                                <div class="widget-heading">Signature</div>
                                                                <div class="widget-subheading">
                                                                    <img
                                                                        src="{{ $member->member_signature ? asset('storage/memberSignature/' . $member->member_signature) : asset('assets/ladiesclub/backend/images/default-image.png') }}"/>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="text-center d-block card-footer">
                                            <a href="{{route('app.card.front', $member->user_id)}}" class="btn btn-info">Print ID Card-Front</a>
                                            <a href="{{route('app.card.back', $member->user_id)}}" class="btn btn-info">Print ID Card-Back</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="card card-absolute">
                                        <div class="card-header bg-secondary">
                                            <h5 class="text-white">Update Signature</h5>
                                        </div>
                                        <div class="card-body mb-3">
                                            <div id="responseMessage"></div>
                                            <div class="box">
                                                <div class="box-body no-padding">
                                                    <form method="POST"
                                                          action="" id="signatureUpdate">
                                                        @csrf
                                                        <div class="form-group row">
                                                            <label for="password"
                                                                   class="col-md-4 col-form-label text-lg-right">Signature(300X80), No Background are allow
                                                                </strong></label>

                                                            <div class="col-md-6">
                                                                <input id="signature" type="file"
                                                                       class="form-control"
                                                                       name="signature" autocomplete="current-password"
                                                                       aria-invalid="signature">
                                                                <input type="hidden" name="user_id"
                                                                       value="{{$member->user_id}}" id="user_id">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-8 offset-md-4">
                                                                <button type="submit" class="btn btn-primary">
                                                                    Update
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('#idCardForm').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission
                let userId = $('#userId').val();
                let cardNo = $('#cardNo').val();
                var token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token
                $.ajax({
                    url: "{{ route('app.member.idCardNoUpdate', ['id' => ':id']) }}".replace(':id', userId), // Your route here
                    type: "POST",
                    data: {
                        _token: token, // Include CSRF token
                        user_id: userId,
                        cardNo: cardNo,
                    },
                    success: function (response) {
                        $('#responseMessage').html('<p>' + response.message + '</p>');
                        $('#ajaxForm')[0].reset(); // Reset form on success
                    },
                    error: function (xhr) {
                        // Handle errors
                        let errors = xhr.responseJSON.errors;
                        alert(errors)
                        let errorMessage = '';
                        $.each(errors, function (key, value) {
                            errorMessage += '<p>' + value[0] + '</p>';
                        });
                        $('#responseMessage').html(errorMessage);
                    }
                });
            });
        });
        $(document).ready(function () {
            $('#passwordUpdate').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission
                let userId = $('#user_id').val();
                let pass = $('#password').val();
                let cPass = $('#password_confirmation').val();
                let token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token
                $.ajax({
                    url: "{{ route('app.member.updateMemberPassword', ['id' => ':id']) }}".replace(':id', userId), // Your route here
                    type: "POST",
                    data: {
                        _token: token, // Include CSRF token
                        user_id: userId,
                        password: pass,
                        password_confirmation: cPass
                    },
                    success: function (response) {
                        $('#responseMessage').html('<p>' + response.message + '</p>');
                        //$('#passwordUpdate')[0].reset(); // Reset form on success
                    },
                    error: function (xhr) {
                        $('.error').remove();

                        // Handle validation errors
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                // Append error message after the relevant input
                                $('#' + key).after('<span class="error text-danger">' + value[0] + '</span>');
                            });
                        } else {
                            $('#responseMessage').html('<p class="text-danger">Something went wrong. Please try again.</p>');
                        }
                    }
                });
            });
        });
        $(document).ready(function () {
            $('#profileUpdate').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission

                let userId = $('#user_id').val();
                let formData = new FormData(this); // Create FormData from the form
                let token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('app.member.updateMemberImage', ['id' => ':id']) }}".replace(':id', userId),
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': token // Add CSRF token to headers
                    },
                    data: formData,
                    processData: false, // Important for file upload
                    contentType: false, // Important for file upload
                    success: function (response) {
                        $('#responseMessage').html('<p class="text-success">' + response.message + '</p>');
                        // Optionally reset the form
                        // $('#profileUpdate')[0].reset();
                    },
                    error: function (xhr) {
                        $('.error').remove();

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                $('#' + key).after('<span class="error text-danger">' + value[0] + '</span>');
                            });
                        } else {
                            $('#responseMessage').html('<p class="text-danger">Something went wrong. Please try again.</p>');
                        }
                    }
                });
            });
        });
        $(document).ready(function () {
            $('#signatureUpdate').on('submit', function (e) {
                e.preventDefault(); // Prevent default form submission

                let userId = $('#user_id').val();
                let formData = new FormData(this); // Create FormData from the form
                let token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('app.member.updateMemberSignature', ['id' => ':id']) }}".replace(':id', userId),
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': token // Add CSRF token to headers
                    },
                    data: formData,
                    processData: false, // Important for file upload
                    contentType: false, // Important for file upload
                    success: function (response) {
                        $('#responseMessage').html('<p>' + response.message + '</p>');
                        // Optionally reset the form
                        // $('#profileUpdate')[0].reset();
                    },
                    error: function (xhr) {
                        $('.error').remove();

                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $.each(errors, function (key, value) {
                                $('#' + key).after('<span class="error text-danger">' + value[0] + '</span>');
                            });
                        } else {
                            $('#responseMessage').html('<p class="text-danger">Something went wrong. Please try again.</p>');
                        }
                    }
                });
            });
        });
    </script>
@endpush
