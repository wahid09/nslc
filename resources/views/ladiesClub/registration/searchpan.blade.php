<div class="row">
    <div class="col-md-12">
        <div class="card card-dark">
            <form action="" method="post" id="search_form">
                <div class="row pl-3 pt-3">
                    <div class="col-3">
                        <label>Area</label>
                        <select id="area_id" class="form-control select2">
                            <option value="" selected>Please Select</option>
                            @foreach (\App\Models\Area::active()->select('id', 'name')->get() as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row pl-3 pt-3">
                    {{--                    <div class="col-1">--}}
                    {{--                    </div>--}}
                    <div class="col-9">
                        <button class="btn btn-primary col-md-3" type="submit">Submit</button>
                        <button class="btn btn-secondary" onclick="form_reset()">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
