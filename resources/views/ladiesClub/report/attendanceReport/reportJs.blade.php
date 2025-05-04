{{--<script nonce="{{ csp_nonce() }}">--}}
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });

    $(function() {
        var table = $('.yajra-datatable').DataTable({
            "order": [
                [1, 'desc']
            ],
            "bFilter": false,
            "columnDefs": [{
                "className": "dt-center",
                "targets": "_all",
                orderable: false
            }],
            "bDestroy": true,
            processing: true,
            serverSide: true,
            "language": {
                processing: '<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
            },
            drawCallback: function(settings) {
                var api = this.api();
                $('#total_data').html(api.ajax.json().recordsTotal);
            },
            ajax: {
                url: "{{ route('app.attendance.report.search') }}",
                type: 'POST',
                data: function(d) {
                    d.membership_no = $('#membership_no').val();
                    d.member_name = $('#member_name').val();
                    d.from_date = $('#from_date').val();
                    d.to_date = $('#to_date').val();
                    d.device_id = $('#device_id').val();
                    d._token = '{{ csrf_token() }}'
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error("AJAX Error:", textStatus, errorThrown);
                    alert(
                        "An error occurred while processing your request. Please try again later."
                    );
                }
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false
            },
                {
                    data: 'badge_number',
                    name: 'badge_number',
                    orderable: false
                },
                {
                    data: 'membership_no',
                    name: 'membership_no',
                    orderable: false
                },
                {
                    data: 'member_name',
                    name: 'member_name',
                    orderable: false
                },
                {
                    data: 'spouse_name_en',
                    name: 'spouse_name_en',
                    orderable: false
                },
                {
                    data: 'rank_name',
                    name: 'rank_name',
                    orderable: false
                },
                {
                    data: 'phone',
                    name: 'phone',
                    orderable: false
                },
                {
                    data: 'auth_date',
                    name: 'auth_date',
                    orderable: false
                },
                {
                    data: 'auth_time',
                    name: 'auth_time',
                    orderable: false
                },
                {
                    data: 'device',
                    name: 'device',
                    orderable: false
                },
                // {
                //     data: 'type',
                //     name: 'type',
                //     orderable: false
                // }
            ],
            dom: 'lBfrtip',
            buttons: ['csv', 'excel', 'pdf', 'print'],
        });

        $('#search_form').on('submit', function(event) {
            event.preventDefault();
            table.draw(true);
        });
    });

    function form_reset() {
        document.getElementById("search_form").reset();
        $('.select2').val(null).trigger('change');
        $('.yajra-datatable').DataTable().ajax.reload(null, false);
    }

    function downloadRecords() {
        const from_date = $('#from_date').val();
        const to_date = $('#to_date').val();
        const device_id = $('#device_id').val();
        const membership_no = $('#membership_no').val();
        const member_name = $('#member_name').val();

        const url = "{{ url('admin/attendance/download_records') }}";
        window.location.href =
            `${url}?from_date=${from_date}&to_date=${to_date}&device_id=${device_id}&membership_no=${membership_no}&member_name=${member_name}`;
    }
</script>
