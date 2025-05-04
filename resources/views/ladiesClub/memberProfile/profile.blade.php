@extends('ladiesClub.layout.app')

@section('title', 'Member Profile')

@push('css')
{{--    <style nonce="{{ csp_nonce() }}">--}}
{{--        .css_1 {--}}
{{--            display: block;--}}
{{--        }--}}
{{--    </style>--}}
@endpush

@section('main_menu', 'Member')

@section('active_menu', 'Member Profile')

@section('content')
    <div class="alert alert-danger" role="alert">
        <marquee>
            <p style="font-family: Impact; font-size: 18pt">
                @isset($last_notice)
                    {{ $last_notice->content }}
                @else
                    No notice available.
                @endisset
            </p>
        </marquee>
    </div>

    <div class="user-profile social-app-profile">
        <div class="row">
            <div class="col-md-3">
                <div class="default-according style-1 faq-accordion job-accordion">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="p-0">
                                <button class="btn btn-link ps-0" data-bs-toggle="collapse" data-bs-target="#collapseicon2"
                                        aria-expanded="true" aria-controls="collapseicon2"><span
                                        class="text-warning fs-5 fw-bold">About
                                        Member</span>
                                </button>
                            </h5>
                        </div>
                        <div class="collapse show" id="collapseicon2" aria-labelledby="collapseicon2"
                             data-parent="#accordion">
                            <div class="card-body post-about">
{{--                                <div class="media">--}}
{{--                                    <img class="round-badge-dark me-3 w-25" src="{{ asset('storage/memberImage/' . $member->image) }}"--}}
{{--                                         alt="Member Avatar">--}}
{{--                                </div>--}}
                                @if (!empty($member) && isset($member->image))
                                    <div class="media">
                                        <img class="round-badge-dark me-3 w-25" src="{{ asset('storage/memberImage/' . $member->image) }}" alt="Member Avatar">
                                    </div>
                                @else
                                    <div class="media">
                                        <img class="round-badge-dark me-3 w-25" src="{{ asset('images/avatar.jpeg') }}" alt="Default Avatar">
                                    </div>
                                @endif
                                <hr>
                                <ul>
                                    <li>
                                        <div class="icon"><i data-feather="user"></i></div>
                                        <div>
                                            <h5>Member Name</h5>
                                            <p class="text-success fw-bold">{{ $member->name }}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i data-feather="user-check"></i></div>
                                        <div>
                                            <h5>Membership No.</h5>
                                            <p class="text-success fw-bold">{{ $member->membership_no }}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i data-feather="user-check"></i></div>
                                        <div>
                                            <h5>Member Designation</h5>
{{--                                            <p class="text-success fw-bold">--}}
{{--                                                {{ $member->club_designation ? $member->clubDesignation->title : '' }}--}}
{{--                                            </p>--}}
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i data-feather="home"></i></div>
                                        <div>
                                            <h5>Club</h5>
{{--                                            <p class="text-success fw-bold">{{ $member->club->name }}</p>--}}
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i data-feather="tag"></i></div>
                                        <div>
                                            <h5>Rank / Designation</h5>
                                            <p class="text-success fw-bold">{{ $member->rank_name ?? '' }}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i data-feather="tag"></i></div>
                                        <div>
                                            <h5>Blood Group</h5>
                                            <p class="text-success fw-bold">
                                                {{ $member->group_name ?? ''}}</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i data-feather="phone"></i></div>
                                        <div>
                                            <h5>Phone</h5>
                                            <p class="text-success fw-bold">{{ substr($member->phone, 2) }}
                                            </p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="icon"><i data-feather="map-pin"></i></div>
                                        <div>
                                            <h5>Signature</h5>
                                            <img class="me-3 w-75" src="{{ asset('storage/memberSignature/' . $member->member_signature) }}"
                                                 alt="Member Signature">
                                        </div>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="tab-content" id="top-tabContent">
                    <div class="tab-pane fade active show" id="timeline" role="tabpanel" aria-labelledby="timeline">
                        <div class="card card-absolute">
                            <div class="card-header bg-secondary mt50">
                                <h5 class="text-white">Member Details</h5>
                            </div>
                            <div class="card-body mt-5">
                                <div class="box">
                                    <div class="box-body no-padding">
                                        <table class="table table-condensed border table-responsive table-sm">
                                            <tbody>
                                            <tr>
                                                <td>#</td>
                                                <td>Member's Name:</td>
                                                <td><b>{{ $member->name }}</b></td>

                                                <td>#</td>
                                                <td>Husband's Name:</td>
                                                <td><b>{{ $member->spouse_name_en }}</b></td>
                                            </tr>

                                            <tr>
                                                <td>#</td>
                                                <td>Member's Name (In Bangla):</td>
                                                <td><b>{{ $member->name_bn }}</b></td>

                                                <td>#</td>
                                                <td>Husband's Name (In Bangla):</td>
                                                <td><b>{{ $member->spouse_name_bn }}</b></td>
                                            </tr>

                                            <tr>
                                                <td>#</td>
                                                <td>Membership No:</td>
                                                <td><b>{{ $member->membership_no }}</b></td>

                                                <td>#</td>
                                                <td>BA No:</td>
                                                <td><b>{{ $member->ba_no }}</b></td>
                                            </tr>

                                            <tr>
                                                <td>#</td>
                                                <td>Email:</td>
                                                <td><b>{{ $member->email }}</b></td>

                                                <td>#</td>
                                                <td>Rank / Designation:</td>
                                                <td>
                                                    <b>{{ $member->rank_name ?? '' }}</b>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>#</td>
                                                <td>Phone:</td>
                                                <td><b>{{ substr($member->phone, 2) }}</b></td>

                                                <td>#</td>
                                                <td>Working Unit:</td>
                                                <td>
                                                    <b>{{ $member->unit_name_en }}</b>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>#</td>
                                                <td>RFID Card No:</td>
                                                <td><b>
                                                        {{ $member->id_card_number }}</b>
                                                </td>

                                                <td>#</td>
                                                <td>Husband's Phone No:</td>
                                                <td><b>{{ substr($member->spouse_phone_number, 2) }}</b></td>
                                            </tr>

                                            <tr>
                                                <td>#</td>
                                                <td>Status</td>
                                                <td>
                                                    <b
                                                        class="right badge badge-{{ $member->status == 1 ? 'success' : 'danger' }}">{{ $member->status == 1 ? 'Active' : 'Inactive' }}</b>
                                                </td>

                                                <td></td>
                                                <td> </td>
                                                <td> </td>
                                            </tr>

                                            <tr>
                                                <td class="bg-secondary">#</td>
                                                <td class="bg-secondary">Member Since:</td>
                                                <td class="bg-secondary">
                                                    <b>{{ \Carbon\Carbon::parse($member->membership_date)->format('F d, Y') }}</b>
                                                </td>

                                                <td class="bg-success">#</td>
                                                <td class="bg-success">Last Payment Date:</td>
                                                <td class="bg-success">
{{--                                                    <b>{{ $member->connection_to ? \Carbon\Carbon::parse($member->connection_to)->format('F d, Y') : 'No Record Available' }}</b>--}}
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
@endsection

@push('js')
{{--    @include('backend.member.view_member.member_profile_js')--}}
@endpush
