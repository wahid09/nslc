@extends('ladiesClub.layout.app')

@section('title', 'Pay bill')

@push('css')
    <style>
        {{--    <style nonce="{{ csp_nonce() }}">--}}
        .typewriter h1 {
            color: #f80369;
            font-family: monospace;
            overflow: hidden;
            border-right: .15em solid orange;
            white-space: nowrap;
            margin: 0 auto;
            font-size: 1.5vw;
            text-align: center;
            animation: typing 3.5s steps(30, end),
            blink-caret .5s step-end infinite;
        }

        @keyframes typing {
            from {
                width: 0
            }

            to {
                width: 100%
            }
        }

        @keyframes blink-caret {

            from,
            to {
                border-color: transparent
            }

            50% {
                border-color: orange
            }
        }

        @media screen and (max-width: 600px) {
            .typewriter h1 {
                font-size: 3vw;
                text-align: center;
            }
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .csss1 {
            text-align: center;
            font-weight: bolder;
        }

        .csss2 {
            text-align: center;
            font-size: 20px;
        }

        .csss3 {
            display: none;
        }

        .bg_pink {
            background-color: #e3c5e3;
        }
    </style>
@endpush

@section('main_menu', 'Home')

@section('active_menu', 'Pay Bill')

{{--@section('link', route('user.userdashboard'))--}}

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-xl-10">
                <div class="card">
                    <form action="{{route('app.member.makePayment')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-header pb-0">
                            {{-- <h5>Pay Bill</h5> --}}
                        </div>
                        <div class="card-body pb-3">
                            <ul class="list-group">
                                <li class="list-group-item bg_pink csss2"><span class="badge badge-danger ">Fee
                                        per month: {{$payPerMonth->monthly_payable_amount}} TK</span></li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Member
                                    Since:
                                    <span class="badge bg-primary ">{{ date('M d, Y', strtotime($membershipInfo->membership_date)) }}
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Expiry
                                    Date:
                                    <span class="badge bg-primary ">{{ date('M d, Y', strtotime($membershipInfo->expiry_date)) }}
                                    </span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Last Pay
                                    Month:
                                    <span class="badge bg-primary ">
                                        @if(!empty($lastPayment->pay_month))
                                        {{ date('M d, Y', strtotime($lastPayment->pay_month)) }}
                                        @endif
                                    </span>
                                </li>
                                @if(!empty($totalMonthsDue))
                                    <li class="list-group-item d-flex justify-content-between align-items-center">Total
                                        Due ({{$totalMonthsDue}}) Month:
                                        <span class="badge bg-primary ">{{ $totalAmountOfDue }}
                                    </span>
                                    </li>
                                @endif
                                {{--                                <li class="list-group-item d-flex justify-content-between align-items-center">User--}}
                                {{--                                    Status--}}
                                {{--                                    @if ($membershipInfo->status == 1)--}}
                                {{--                                        <span class="right badge badge-success float-right">Active</span>--}}
                                {{--                                    @elseif($member->status == 0)--}}
                                {{--                                        <span class="right badge badge-warning float-right">Suspended</span>--}}
                                {{--                                    @elseif($member->status == 2)--}}
                                {{--                                        <span class="right badge badge-danger float-right">Deleted</span>--}}
                                {{--                                    @endif--}}
                                {{--                                </li>--}}
                                <br>
                            </ul>
                            <div class="typewriter csss3" id="output">
                                <h1 id="show_value"></h1>
                            </div>
                            @if(!empty($totalAmountOfDue))
                                <div class="row">
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Pay Amount</label>
                                        <div class="col-sm-10">
                                            <input type="number" class="form-control @error('pay_amount') is-invalid @enderror" id="total_amount"
                                                   name="pay_amount" value="{{$totalAmountOfDue ?? 0}}">
                                            @error('pay_amount')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
{{--                                    <div class="form-group row">--}}
{{--                                        <label for="staticEmail" class="col-sm-2 col-form-label">Pay Reference--}}
{{--                                            Number</label>--}}
{{--                                        <div class="col-sm-10">--}}
{{--                                            <input type="text" class="form-control" id="total_amount" name="ref_no">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="form-group row">
                                        <label for="staticEmail" class="col-sm-2 col-form-label">Pay Slip</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control @error('file') is-invalid @enderror" id="total_amount" name="file">
                                            @error('file')
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" id="member_id" name="member_id" value="{{ Auth::user()->id }}">

                                </div>
                            @else
                                <div class="row">
                                    <div class="alert alert-primary" role="alert">
                                        Your Monthly Payment Up to date!
                                    </div>
                                </div>
                            @endif
                        </div>

                        {{-- <div class="payment-options row mt-3">
                                <div class="col-5 text-center">
                                    <label>
                                        <input type="radio" name="payment_method" value="1" required>
                                        <img src="{{ asset('assets/backend/images/2.png') }}" alt="SSL Commerz"
                                            class="img-fluid">
                                    </label>
                                </div>
                                <div class="col-2">
                                </div>
                                <div class="col-5 text-center">
                                    <label>
                                        <input type="radio" name="payment_method" value="2" required>
                                        <img src="{{ asset('assets/backend/images/1.png') }}" alt="TAP"
                                            class="img-fluid">
                                    </label>
                                </div>
                            </div> --}}

                        <div class="row mt-3 justify-content-center">
                            <div class="col-md-6">
                                @if(!empty($totalAmountOfDue))
                                    <button type="submit" class="btn btn-primary w-100" id="pay_now_button">Make
                                        Payment
                                    </button>
                                @endif
                                {{-- <button type="button" class="btn btn-primary w-100" id="pay_now_button"
                                        onclick="iframeInitiate(this)">Make Payment</button> --}}
                                {{-- <a class="btn btn-primary w-100"
                                        href="{{ url('user/user-tap-payment/' . Auth::id()) }}"><i data-feather=""
                                            class="text-white"></i>
                                        Make Payment
                                    </a> --}}
                            </div>
                        </div>
                </div>
                </form>
                <!-- Payment options banner image -->
                {{-- <div class="text-center mt-4">
                        <img src="{{ asset('assets/backend/images/SSLCommerz-Pay.png') }}" alt="Payment Options"
                            style="width: 100%;">
                    </div> --}}
            </div>
        </div>
    </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js">
    </script>
    <script src="https://merchant-pg-ui-prod.tadlbd.com/script.js"></script>
    <script>
        {{--    <script nonce="{{ csp_nonce() }}">--}}
        {{--        $(document).ready(function() {--}}
        {{--            // Get the initial value from the input field on page load--}}
        {{--            var query = $('#number_of_month').val();--}}
        {{--            updateTotalAmount(query); // Call the function to update the total amount--}}

        {{--            // Event listener for changes in the input field--}}
        {{--            $(document).on('keyup', '#number_of_month', function() {--}}
        {{--                var query = $(this).val();--}}
        {{--                updateTotalAmount(query); // Call the function to update the total amount--}}
        {{--            });--}}

        {{--            function updateTotalAmount(query) {--}}
        {{--                if (query != 0) {--}}
        {{--                    document.getElementById("output").style.display = "block";--}}
        {{--                    document.getElementById("pay_now_button").disabled = false;--}}
        {{--                    var monthly_bill = 200;--}}
        {{--                    var tot_price = query * monthly_bill;--}}
        {{--                    document.getElementById("total_amount").value = tot_price;--}}
        {{--                    $('#show_value').text('Your total bill for ' + query + ' months is ' + tot_price + ' taka.');--}}
        {{--                } else {--}}
        {{--                    document.getElementById("output").style.display = "none";--}}
        {{--                    document.getElementById("pay_now_button").disabled = true; // Disable the button if query is 0--}}
        {{--                }--}}
        {{--            }--}}
        {{--        });--}}

        {{--            @if ($number_of_due_month >= 3)--}}
        {{--        var query = {{ $number_of_due_month }};--}}
        {{--        if (query != 0) {--}}
        {{--            document.getElementById("output").style.display = "block";--}}
        {{--            document.getElementById("pay_now_button").disabled = false;--}}
        {{--            var monthly_bill = 200;--}}
        {{--            var tot_price = query * monthly_bill;--}}
        {{--            document.getElementById("total_amount").value = tot_price;--}}
        {{--            $('#show_value').text('সর্বমোট ' + tot_price + ' টাকার বিল পরিশোধ করছেন ' + query + ' মাসের জন্য');--}}
        {{--        } else {--}}
        {{--            document.getElementById("output").style.display = "none";--}}
        {{--            document.getElementById("pay_now_button").disabled = false;--}}
        {{--        }--}}
        {{--        @endif--}}

        //---------------------------------- tab payment integration ---------------------------
        // function iframeInitiate(param) {
        //     // 1. Getting the Access Token
        //     var settings = {
        //         url: "https://auth-prod.tadlbd.com/oauth/token",
        //         method: "POST",
        //         timeout: 0,
        //         headers: {
        //             Authorization: "Basic YXJteS1vZmZpY2Vycy1jbHViOkdHMmJDd0dDdlA2Mnda",
        //             "Content-Type": "application/x-www-form-urlencoded",
        //         },
        //         data: {
        //             grant_type: "password",
        //             username: "army-officers-club-user",
        //             password: "xtTl86ZPMAx5mM",
        //         },
        //         async: false,
        //     };

        //     $.ajax(settings).done(function(response) {
        //         // 2. Loading the iFrame
        //         tapIFrame($('body'), {
        //             token: response.access_token,
        //             authAPIKey: "9554b0b1-ed06-4d03-9267-a28498d96f3f",
        //             paymentMode: "iFrame",
        {{--//             requestorReferenceId: {{ user_id() }},--}}
        {{--//             callBackUrl: '{{ route('tappayment') }}',--}}
        //             amount: $("#total_amount").val(),
        //             invoiceNumber: $("#number_of_month").val(),
        //             additionalInformation: '{' + $("#number_of_month").val() + '}',
        //             popUpCloseTimeOut: 3
        //         });
        //     });
        // }

        // // 3. Handle event
        // function tapWindowClosed(payment) {
        //     if (payment.status = "completed") {
        {{--//         window.location.href = "{{ route('user.user_profile') }}";--}}
        //     } else {
        //         toastr.error('Payment not success please try again', 'Warning');
        //     }
        // }

        // // Required
        // function receiver(event) {
        //     console.log(event.data)
        //     if (event.origin != 'https://mwstaging.tadlbd.com') {
        //         console.log('mismatch');
        //         return;
        //     }

        //     if (event.data.func == "tapWindowClosed") {
        //         tapWindowClosed(event.data.param);
        //     }
        // }

        // // Required
        // if (window.addEventListener) {
        //     window.addEventListener("message", receiver, false);
        // } else {
        //     window.attachEvent("onmessage", receiver);
        // }
    </script>
@endpush
