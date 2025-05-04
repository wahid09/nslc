<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Select an option", // Set your placeholder text here
            allowClear: true // Optional, allows clearing the selection
        });
    });
    $(function () {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            order: [[1, 'asc']],
            "bFilter": true,
            columnDefs: [{
                className: "dt-center",
                targets: "_all",
                orderable: false
            }],
            ajax: {
                url: "{{ route('app.eventAttendedMemberList.search') }}",
                type: "POST",
                data: function (d) {
                    d.event_id = $('#event_id').val();
                    d.rank_id = $('#rank_id').val();
                    d.attend = $('#attend').val();
                    d._token = '{{ csrf_token() }}';
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false },
                { data: 'membership_no', name: 'membership_no' },
                { data: 'name', name: 'name' },
                { data: 'spouse_name_en', name: 'spouse_name_en' },
                { data: 'spouse_ba_no', name: 'spouse_ba_no' },
                { data: 'rank_name', name: 'rank_name' },
                { data: 'phone', name: 'phone' },
                { data: 'id_card_number', name: 'id_card_number' },
                { data: 'event_name', name: 'event_name' },
                { data: 'event_code', name: 'event_code' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            dom: 'lBfrtip',
            buttons: ['excel', 'csv', 'pdf', 'print'],
            language: {
                processing: '<i class="fa fa-circle-o-notch fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>'
            },
            drawCallback: function (settings) {
                var api = this.api();
                $('#total_data').html(api.ajax.json().recordsTotal);
            }
        });

        $('#search_form').on('submit', function (event) {
            event.preventDefault();
            table.draw(true);
        });

        window.form_reset = function () {
            document.getElementById("search_form").reset();
            $('.select2').val(null).trigger('change');
            table.ajax.reload(null, false);
        }

        // Mark as attended
        $(document).on('click', '.update-attendance', function () {
            let id = $(this).data('id');
            if (!id) return alert("Member ID not found!");

            if (confirm("Mark this member as attended?")) {
                $.ajax({
                    url: "{{ route('app.eventMemberList.is_attend', ':id') }}".replace(':id', id),
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        table.ajax.reload(null, false);
                    },
                    error: function () {
                        alert("Something went wrong.");
                    }
                });
            }
        });

        // Delete row
        $(document).on('click', '.delete-member', function () {
            let id = $(this).data('id');
            if (!id) return alert("Member ID not found!");

            if (confirm("Are you sure you want to delete this entry?")) {
                $.ajax({
                    url: "/event-members/" + id,
                    type: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (res) {
                        alert(res.message);
                        table.ajax.reload(null, false);
                    },
                    error: function () {
                        alert("Failed to delete.");
                    }
                });
            }
        });
    });
</script>

