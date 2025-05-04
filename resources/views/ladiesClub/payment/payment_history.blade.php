@extends('ladiesClub.layout.app')

@section('title', 'Payment History')

@push('css')
{{--    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ladiesclub/backend/css/select2.css') }}">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/ladiesclub/backend/css/datatables.css') }}">
    <style>
{{--    <style nonce="{{ csp_nonce() }}">--}}
        .css1 {
            width: 100%;
        }
    </style>
@endpush

@section('main_menu', 'Bills Management')

@section('active_menu', 'Payment History')

@section('link', '')

@section('content')

    <div class="row">
        @if (1 != 1)
            {{-- @if (!check_user_data_valid(user_id())) --}}
            <div class="alert alert-danger" role="alert">
                <h5>আপনার ইনফরমেশন সার্ভার এ আপডেট নয়। তথ্য আপডেট করতে যোগাযোগ করুন : +8801718181416</h5>
            </div>
        @else
            <div class="row justify-content-center mb-3">
                <div class="col-md-12">
                    <a href="{{route('app.member.payBill')}}" class="btn btn-lg btn-block btn-danger" class="css1">Pay your
                        monthly payment</a>
                </div>
            </div>
            <br>
            <br>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Payment History</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="basic-1">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Payment Date</th>
                                    <th scope="col">Amount</th>
{{--                                    <th scope="col">reference NO</th>--}}
                                    <th scope="col">Payment Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($payHistory as $key => $data)
                                    <tr>
                                        <th scope="row">{{ $key + 1 }}</th>
                                        <td>{{ \Illuminate\Support\Carbon::parse($data->created_at)->format('M d, Y') }}
                                        </td>
                                        <td>{{ $data->pay_amount }}</td>
{{--                                        <td>{{ $data->ref_no }}</td>--}}
                                        <td>
                                            @if($data->payment_is_verified == 1)
                                            <span class="right badge badge-success float-right">Verified</span>
                                                @else
                                                <span class="right badge badge-warning float-right">Pending</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        @endif
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/ladiesclub/backend/js/datatable/datatables/plugin/datatables.min.js') }}"></script>
    <script nonce="YKXiTcrg6o4DuumXQDxYRv9gHPlZng6z">
        $(document).ready(function() {
            $('#basic-1').DataTable();
        });
    </script>
@endpush
