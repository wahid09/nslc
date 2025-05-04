@extends('ladiesClub.layout.app')

@section('title', 'Member Dashboard')

@push('css')
    {{--    <style nonce="{{ csp_nonce() }}">--}}
    <style>
        .card_height {
            padding: 25px !important;
        }

        .css1 {
            font-size: 45px;
        }

        .card-counter {
            box-shadow: 2px 2px 10px #DADADA;
            margin: 5px;
            padding: 20px 10px;
            background-color: #fff;
            border-radius: 5px;
            transition: .3s linear all;
            position: relative;
            display: flex;
            /* Use flex to align items */
            flex-direction: column;
            /* Stack items vertically */
            height: auto;
            /* Allow height to adjust */
            text-decoration: none;
            /* Remove underline */
            color: inherit;
            /* Inherit text color */
        }

        .card-counter:hover {
            box-shadow: 4px 4px 20px #A55AA5;
            transition: .3s linear all;
            transform: scale(1.07);
        }

        .card-counter.primary {
            background-color: #007bff;
            color: #FFF;
        }

        .card-counter.danger {
            background-color: #ef5350;
            color: #FFF;
        }

        .card-counter.success {
            background-color: #66bb6a;
            color: #FFF;
        }

        .card-counter.info {
            background-color: #26c6da;
            color: #FFF;
        }

        .card-counter .top-row {
            display: flex;
            /* Flex for icon and number */
            justify-content: space-between;
            /* Space between items */
            align-items: center;
            /* Center items vertically */
        }

        .card-counter i {
            font-size: 5em;
            opacity: 0.3;
            margin-right: 10px;
            /* Add space between icon and number */
        }

        .card-counter .count-numbers {
            font-size: 30px;
            display: block;
            text-align: right;
            /* Align the number to the right */
        }

        .card-counter .count-name {
            font-style: italic;
            text-transform: capitalize;
            opacity: 0.7;
            display: block;
            font-size: 18px;
            text-align: right;
            /* Align the name to the right */
            margin-top: 5px;
            /* Add some space above the count name */
        }
    </style>
@endpush

@section('main_menu', 'Member')

@section('active_menu', 'Member Dashboard')

@section('content')
    <div class="row mb-5">
        <div class="col-md-3">
            <a href="{{ route('app.member.profile') }}" class="card-counter primary">
                <div class="top-row">
                    <i class="fa fa-id-card-o"></i>
                    <span class="count-numbers">{{ $member->membership_no }}</span>
                </div>
                <span class="count-name">Membership No.</span>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('app.member.payment') }}" class="card-counter danger">
                <div class="top-row">
                    <i class="fa fa-money"></i>
                    <span class="count-numbers">{{$paymentDue ?? '0'}}</span>
                </div>
                <span class="count-name">Payment Due</span>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('app.member.payment') }}" class="card-counter success">
                <div class="top-row">
                    <i class="fa fa-info"></i>
                    <span class="count-numbers">
                        @if(!empty($lastPayment))
                        {{ \Carbon\Carbon::parse($lastPayment)->format('d-M-Y') }}
                            @else
                            --
                        @endif
                    </span>
                </div>
                <span class="count-name">Last Payment</span>
            </a>
        </div>

        <div class="col-md-3">
            <a href="{{ route('app.member.profile') }}" class="card-counter info">
                <div class="top-row">
                    <i class="fa fa-user"></i>
                    <span class="count-numbers">{{ $member->status == 1 ? 'Active' : 'Inactive' }}</span>
                </div>
                <span class="count-name">Member Status</span>
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 col-xl-6">
            <div class="card">
                <div class="card-header">
                    Member Payment History (Bar Chart)
                </div>
                <div class="card-body">
                    <canvas id="memberChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-6">
            <div class="card">
                <div class="card-header">
                    Submit Feedback
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('app.feedback.store')}}">
                        @csrf
                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" name="subject" required>
                        </div>
                        <div class="mb-3">
                            <label for="details" class="form-label">Details</label>
                            <textarea class="form-control" id="summernote" name="details" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mb-3">Submit Feedback</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('memberChart').getContext('2d');

        // Dummy data
        const paymentData = {
            //labels: ['01-Jul-2024', '01-Aug-2024', '01-Sep-2024', '01-Oct-2024', '01-Nov-2024'],
            labels:<?php
            echo json_encode($pay_month);
            ?>,
            datasets: [{
                label: '',
                //data: [200, 200, 200, 200, 200],
                //data:json_encode($pay_amount),// Dummy data for each month
                data:<?php
                echo json_encode($pay_amount);
                ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)', // Red
                    'rgba(54, 162, 235, 0.2)', // Blue
                    'rgba(255, 206, 86, 0.2)', // Yellow
                    'rgba(75, 192, 192, 0.2)', // Green
                    'rgba(153, 102, 255, 0.2)' // Purple
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
        };

        const memberChart = new Chart(ctx, {
            type: 'bar',
            data: paymentData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Amount Paid (Tk)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Payment Month'
                        }
                    }
                },
                animation: {
                    duration: 1000, // Set overall animation duration
                    onComplete: () => {
                        const chartInstance = memberChart;
                        const ctx = chartInstance.ctx;
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'bottom';

                        memberChart.data.datasets.forEach((dataset, i) => {
                            const meta = chartInstance.getDatasetMeta(i);
                            meta.data.forEach((bar, index) => {
                                const data = dataset.data[index];
                                ctx.fillText(data, bar.x, bar.y - 5);
                            });
                        });
                    }
                },
                plugins: {
                    animation: {
                        delay: (context) => {
                            let delay = 0;
                            if (context.type === 'data' && context.mode === 'default' && !context.dropped) {
                                delay = context.dataIndex * 300 + context.datasetIndex * 100;
                                context.dropped = true;
                            }
                            return delay;
                        }
                    }
                }
            }
        });
    </script>
@endpush
