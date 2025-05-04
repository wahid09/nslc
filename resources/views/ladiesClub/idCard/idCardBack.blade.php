<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ID Card Back</title>
{{--    <style nonce="{{ csp_nonce() }}">--}}
    <style>
        html {
            margin: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
        }

        .card {
            width: 3.42in;
            height: 2.13in;
            position: relative;
            border-radius: 3px;
            padding: 15px 18px 10px 15px;
            box-sizing: border-box;
            font-size: 11px;
            background-image: url('{{ public_path('assets/ladiesclub/backend/images/id-card/id-card-back.png') }}');
            background-size: cover;
            background-position: center;
            font-weight: bold;
        }

        .text-container {
            font-size: 11px;
            text-align: justify;
            margin-bottom: 5px;
        }

        .expiry-date {
            font-size: 9px;
            text-align: justify;
            margin-bottom: 5px;
        }

        .powered-by {
            font-size: 10px;
            top: 130px;
            position: absolute;
            left: 260px;
        }

        .til {
            position: absolute;
            top: 155px;
            left: 240px;
        }

        .til-logo {
            height: 30px;
            width: auto;
        }

        .qr-container {
            top: 123px;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .qr-container img {
            height: 60px;
            border: 2px solid black;
            /* Add border around the QR code */
            padding: 4px;
            /* Add some padding to separate the border from the QR code */
        }

        .issuer {
            font-size: 10px;
            position: absolute;
            top: 204px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            white-space: nowrap;
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>
<div class="card">
    <div class="text-container">
        <p>This card is the property of {{ $clubData->name }} to whom it must be returned upon lost or found
            unattended. The use of this card is covered by the terms of the {{ $clubData->name }}.
        </p>
        <p>If found, please return this to {{ $clubData->name }}, {{ $clubData->address }}</p>
    </div>

    <div class="expiry-date">
        {{-- <p>Expiry Date: {{ \Carbon\Carbon::parse($member->expiry_date)->format('F d, Y') }} </p> --}}
        <p>Expiry Date: {{ \Carbon\Carbon::parse($member->expiry_date)->format('M d, Y') }} </p>
    </div>

    <div class="powered-by">
        <p>Powered By:</p>
    </div>

    <div class="til">
        <img class="til-logo" src="{{ public_path('assets/frontend/img/til-logo.png') }}" alt="til-logo">
    </div>

    <div class="qr-container">
        <img src="data:image/png;base64, {!! $qrcode !!}">
    </div>

    <div class="issuer">
        <p>Issuing Authority : {{ $clubData->name }}</p>
    </div>
</div>
</body>

</html>
