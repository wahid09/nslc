<div class="row">
    <div class="col-md-12">
        <div class="card card-dark">
            <form action="" method="post" id="search_form">
                @csrf
                <div class="row pl-3 pt-3">
                    <div class="col-2">
                        <label>Devices</label>
                        <select id="device_id" name="device_id" class="form-control select2">
                            <option value="" selected>Please Select</option>
                            @foreach (\App\Models\Device::all() as $data)
                                <option value="{{ $data->id }}">{{ $data->device_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-2">
                        <label>Membership No:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="membership_no" name="membership_no">
                        </div>
                    </div>

                    <div class="col-2">
                        <label>Member Name:</label>
                        <div class="form-group">
                            <input type="text" class="form-control" id="member_name" name="member_name">
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label>Date from:</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="from_date"
                                   id="from_date">
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label>Date to:</label>
                            <input type="date" class="form-control" value="{{ date('Y-m-d') }}" name="to_date"
                                   id="to_date">
                        </div>
                    </div>
                </div>

                <div class="row pl-3">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>
                            Search</button>
                        <button type="button" onclick="form_reset()" class="btn btn-danger btn-sm"><i
                                class="fa fa-sync"></i> Reset</button>
{{--                        <button type="button" onclick="downloadRecords()" class="btn btn-success btn-sm"><i--}}
{{--                                class="fa fa-download"></i> Download Attendance Records</button>--}}
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
