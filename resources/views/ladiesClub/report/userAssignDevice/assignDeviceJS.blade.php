<script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Select Option"
        });
    });

    $(function() {
        var table = $('.yajra-datatable').DataTable({
            "order": [
                [1, 'desc']
            ],
            "bFilter": true,
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
                url: "{{ route('app.user.device.search') }}",
                type: 'POSt',
                data: function(d) {
                    d.device_id = $('#device_id').val();
                    d.status = $('#status').val();
                    d.rank_id = $('#rank_id').val();
                    d._token = '{{ csrf_token() }}'
                }
            },
            columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex',
                searchable: false
            },
                {
                    data: 'membership_no',
                    name: 'membership_no',
                    orderable: false
                },
                {
                    data: 'name',
                    name: 'name',
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
                    data: 'card_id',
                    name: 'card_id',
                    orderable: false
                },
                // {
                //     data: 'status',
                //     name: 'status',
                //     orderable: false
                // },
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
            ],
            dom: 'lBfrtip',
            buttons: [
                'excel', 'csv', 'pdf', 'print'
            ],
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
</script>
