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
                <div>Payment Management</div>
            </div>
            <div class="page-title-actions">
                {{--                @permission('club-create')--}}
{{--                <a href="{{ route('app.clubs.create') }}" class="btn-shadow mr-3 btn btn-primary" name="button">--}}
{{--                    <i class="fas fa-plus-circle"></i>&nbsp;Create Club--}}
{{--                </a>--}}
                {{--                @endpermission--}}
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">

                <div class="card-body">
                    <table style="width: 100%;" id="dataTable" class="table table-hover table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Member Name(Bangle)</th>
                            <th class="text-center">Pay Month</th>
                            <th class="text-center">Pay Amount</th>
{{--                            <th class="text-center">Reference No</th>--}}
                            <th class="text-center">Documents</th>
                            <th class="text-center">Payment Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($payments as $item)
                            <tr>
                                <td class="text-center text-muted">{{ $loop->index+1 }}</td>
                                <td class="text-center">{{ $item->name_bn }}</td>
                                <td class="text-center">{{ \Carbon\Carbon::parse($item->pay_month)->format('d-M-y') }}</td>
                                <td class="text-center">{{ $item->pay_amount }}</td>
{{--                                <td class="text-center">{{ $item->ref_no }}</td>--}}
                                <td class="text-center">
                                    <a href="#" class="view-document" onclick="documentImage('{{ asset('storage/memberPaySlip/' . $item->document) }}')">
                                        <i class="fas fa-paperclip"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    @if($item->payment_is_verified == true)
                                        <span class="badge badge-info">Completed</span>
                                    @else
                                        <span class="badge badge-warning">Pending</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if($item->payment_is_verified != true)
                                    <a href="#" data-payment-id="{{ $item->id }}" class="btn btn-primary" id="payStatusUpdate_{{ $item->id }}"><i
                                            class="fas fa-edit"></i></a>
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

@endsection
<div>
    <div class="modal fade" id="viewDocumentModal" tabindex="-1" aria-labelledby="viewDocumentModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewDocumentModalLabel">Payment Slip</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Placeholder for the document content -->
                    <iframe id="documentViewer" src="" style="width: 100%; height: 500px;" frameborder="0"></iframe>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        function documentImage(documentUrl) {
            $('#documentViewer').attr('src', documentUrl);
            // Show the modal
            $('#viewDocumentModal').modal('show');
        }
        $(document).ready(function() {
            $('a[id^="payStatusUpdate_"]').on('click', function() {
                event.preventDefault();
                var paymentId = $(this).data('payment-id');
                var url = '{{ route('app.pay.paymentUpdate', ':id') }}'.replace(':id', paymentId);
                $.ajax({
                    url: url, // Laravel route for updating the flag
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}' // CSRF token for security
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });
        });
    </script>
@endpush

