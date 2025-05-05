<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ID Card Front</title>

    <style>
        html {
            margin: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            font-weight: 400;
            /* Regular weight */
        }

        .card {
            width: 2.13in;
            height: 3.63in;
            position: relative;
            border-radius: 3px;
            padding: 15px 18px 10px 15px;
            box-sizing: border-box;
            font-size: 11px;
            background-image: url('{{ public_path('assets/ladiesclub/backend/images/id-card/id-card-front.jpg') }}');
            background-size: cover;
            background-position: center;
        }

        .army-logo {
            position: absolute;
            top: 25px;
            width: 40px;
            height: 40px;
        }

        .club-title {
            font-size: 15px;
            position: absolute;
            top: 10px;
            left: 60px;
            font-weight: bold;
        }

        .club-name {
            font-size: 12px;
            position: absolute;
            top: 30px;
            left: 92px;
        }

        .barcode {
            position: absolute;
            top: 22px;
            left: 220px;
        }

        .membership_no {
            position: absolute;
            font-size: 12px;
            /* top: 165px; */
            left: 20px;
            white-space: nowrap;
            font-weight: bold;
        }

        .bar {
            position: absolute;
            top: 60px;
            left: 55px;
        }

        .bar-img {
            height: 3px;
            width: 163px;
        }

        .avatar {
            position: absolute;
            top: 77px;
            left: 20px;
        }

        .avatar-img {
            height: 90px;
            width: 80px;
            border-radius: 60%;
            border: 2px solid rgb(180, 105, 180);
        }

        .member-name {
            font-size: 11px;
            position: absolute;
            /* top: 184px; */
            left: 20px;
            font-weight: bold;
            width: 85%;
            word-wrap: break-word;
            word-break: break-all;
        }

        .member-deg {
            font-size: 11px;
            position: absolute;
            top: 227px;
            left: 20px;
            font-weight: bold;
            text-transform: uppercase;
            color: #FF41B2;
        }

        .husband-name-start {
            font-size: 11px;
            position: absolute;
            font-weight: bold;
            top: 243px;
            left: 20px;
        }

        .husband-name {
            font-size: 11px;
            position: absolute;
            font-weight: bold;
            top: 257px;
            left: 20px;
            width: 85%;
            word-wrap: break-word;
            word-break: break-all;
        }

        .check {
            position: absolute;
            top: 90px;
            left: 120px;
        }

        .check-img {
            height: 12px;
            width: 12px;
        }

        .phone {
            position: absolute;
            top: 120px;
            left: 120px;
        }

        .phone-img {
            height: 12px;
            width: 12px;
        }

        .blood-drop {
            position: absolute;
            top: 150px;
            left: 120px;
        }

        .blood-drop-img {
            height: 12px;
            width: 12px;
        }

        .issue-date {
            font-size: 11px;
            position: absolute;
            font-weight: bold;
            top: 77px;
            left: 140px;
        }

        .issue-date-text {
            font-size: 11px;
            position: absolute;
            font-weight: bold;
            top: 90px;
            left: 140px;
        }

        .emergency-contact {
            font-size: 11px;
            position: absolute;
            font-weight: bold;
            top: 107px;
            left: 140px;
        }

        .emergency-contact-text {
            font-size: 11px;
            position: absolute;
            font-weight: bold;
            top: 122px;
            left: 140px;
        }

        .blood-group {
            font-size: 11px;
            position: absolute;
            font-weight: bold;
            top: 138px;
            left: 140px;
        }

        .blood-group-text {
            font-size: 11px;
            position: absolute;
            font-weight: bold;
            top: 152px;
            left: 140px;
        }

        .bar-2 {
            position: absolute;
            top: 343px;
            left: 135px;
        }

        .bar-img-2 {
            height: 3px;
            width: 83px;
        }

        .holder-sign {
            font-size: 11px;
            position: absolute;
            font-weight: bold;
            top: 335px;
            left: 25px;
            white-space: nowrap;
        }

        .member-signature {
            position: absolute;
            top: 315px;
            left: 20px;
        }

        .member-signature-img {
            height: 22px;
            width: 80px;
        }

        .bar-3 {
            position: absolute;
            top: 343px;
            left: 20px;
        }

        .bar-img-3 {
            height: 3px;
            width: 83px;
        }

        .president-sign {
            font-size: 11px;
            position: absolute;
            font-weight: bold;
            top: 335px;
            left: 137px;
        }

        .president-signature {
            position: absolute;
            top: 315px;
            left: 135px;
        }

        .president-signature-img {
            height: 22px;
            width: 80px;
        }

        /* Dynamically set styles based on the member's name length */
        @php $member_name_top =strlen($member->name)>30 ? '184px' : '200px';
        $membership_no_top =strlen($member->name)>30 ? '165px' : '180px';
        @endphp

        .dynamic-member-name {
            top: {{ $member_name_top }};
        }

        .dynamic-membership-no {
            top: {{ $membership_no_top }};
        }
    </style>
</head>

<body>
<div class="card">
    <img class="army-logo" src="{{ public_path('assets/ladiesclub/backend/images/logo/logo.png') }}" alt="army-logo">

    <div class="club-title">
        <p>ARMY LADIES CLUB</p>
    </div>

    <div class="club-name">
        <p>Dhaka Region</p>
    </div>

    {{-- <div class="barcode">
        {!! $barcode !!}
    </div> --}}

    <div class="membership_no dynamic-membership-no">
        <p>MEMBER NO: {{ $member->membership_no }}</p>
    </div>

    <div class="bar">
        <img class="bar-img" src="{{ public_path('assets/ladiesclub/backend/images/id-card/bar.png') }}" alt="bar-img">
    </div>

    <div class="avatar">
        <img class="avatar-img" src="{{ public_path('storage/memberImage/' . $member->image) }}" alt="Member Avatar">
    </div>

    <div class="member-name dynamic-member-name">
        <p>{{ $member->name }}</p>
    </div>

    <div class="member-deg">
{{--        <p>{{ $clubDesignation->name ? $clubDesignation->name : '' }}</p>--}}
        <p>{{ $clubDesignation->name ?? '' }}</p>
    </div>

    <div class="husband-name-start">
        <p>Spouse of</p>
    </div>

    <div class="husband-name">
       <p>{{ $member->spouse_ba_no }} {{ $member->sp_rank }} {{ $member->spouse_name_en }}</p>
    </div>

    <div class="check">
        <img class="check-img" src="{{ public_path('assets/ladiesclub/backend/images/id-card/check.png') }}" alt="check-img">
    </div>

    <div class="phone">
        <img class="phone-img" src="{{ public_path('assets/ladiesclub/backend/images/id-card/phone.png') }}" alt="phone-img">
    </div>

    <div class="blood-drop">
        <img class="blood-drop-img" src="{{ public_path('assets/ladiesclub/backend/images/id-card/blood-drop.png') }}"
             alt="blood-drop-img">
    </div>

    <div class="issue-date">
        <p>Issue Date</p>
    </div>

    <div class="issue-date-text">
        <p>{{ \Carbon\Carbon::parse($member->membership_date)->format('M d, Y') }}</p>
{{--        <p>{{ \Carbon\Carbon::parse($member->issue_date)->format('M d, Y') }}</p>--}}
    </div>

    <div class="emergency-contact">
        <p>Mobile No.</p>
    </div>

    <div class="emergency-contact-text">
        <p>{{ $member->phone ? substr($member->phone, 2) : '' }}</p>
    </div>

    <div class="blood-group">
        <p>Blood Group</p>
    </div>

    <div class="blood-group-text">
       <p>{{ $member->group_name ? $member->group_name : '' }}</p>
    </div>

    <div class="bar-2">
        <img class="bar-img-2" src="{{ public_path('assets/ladiesclub/backend/images/id-card/bar.png') }}" alt="bar-img-2">
    </div>

    <div class="holder-sign">
        <p>Holder's Sign</p>
    </div>

    <div class="member-signature">
       <img class="member-signature-img" src="{{ public_path('storage/memberSignature/' . $member->member_signature) }}" alt="member-signature">
    </div>

    <div class="bar-3">
        <img class="bar-img-3" src="{{ public_path('assets/ladiesclub/backend/images/id-card/bar.png') }}" alt="bar-img-3">
    </div>

    <div class="president-sign">
        <p>Club President</p>
    </div>

    <div class="president-signature">
        <img class="president-signature-img" src="{{ public_path('storage/memberSignature/' . $presidents->member_signature) }}"
             alt="president-signature">
    </div>
</div>
</body>

</html>
