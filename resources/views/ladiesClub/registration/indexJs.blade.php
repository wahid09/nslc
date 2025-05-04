<script>
    $(document).ready(function () {
        $('.select2').select2({
            placeholder: "Select an option",
            allowClear: true
        });

        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            bDestroy: true,
            order: [[1, 'asc']],
            bFilter: true,
            columnDefs: [
                {
                    className: "dt-center",
                    targets: "_all",
                    orderable: false
                }
            ],
            ajax: {
                url: "{{ route('app.members.data') }}",
                type: "POST",
                data: function (d) {
                    d.area_id = $('#area_id').val();
                    d._token = '{{ csrf_token() }}';
                }
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'membership_no', name: 'membership_no' },
                { data: 'spouse_name_en', name: 'spouse_name_en' },
                { data: 'spouse_ba_no', name: 'spouse_ba_no' },
                { data: 'rank_name', name: 'rank_name' },
                { data: 'member_name', name: 'member_name' },
                { data: 'email', name: 'email' },
                { data: 'member_phone', name: 'member_phone' },
                { data: 'id_card_number', name: 'id_card_number' },
                { data: 'status', name: 'status', orderable: false, searchable: false },
                { data: 'actions', name: 'actions', orderable: false, searchable: false },
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

        $(document).on('click', '.delete-member', function () {
            let id = $(this).data('id');
            if (!id) return alert("Member ID not found!");
            let url = "{{ route('app.member-registration.destroy', ':id') }}".replace(':id', id);
            if (confirm("Are you sure you want to delete this entry?")) {
                $.ajax({
                    url: url,
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
