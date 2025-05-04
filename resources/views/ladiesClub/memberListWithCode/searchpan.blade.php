<div class="row">
    <div class="col-md-12">
        <div class="card card-dark">
            <form action="" method="post" id="search_form">
                <div class="row pl-3 pt-3">
                    <div class="col-3">
                        <label>Event</label>
                        <select id="event_id" class="form-control select2">
                            <option></option>
                            @foreach (\App\Models\Event::select('id', 'title_bn')->where('status', 1)->where('club_id', 2)->where('area_id', Auth::user()->area_id)->get() as $data)
                                <option value="{{ $data->id }}">{{ $data->title_bn }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label>Rank</label>
                        <select id="rank_id" class="form-control select2">
                            <option></option>
                            @foreach (\App\Models\Rank::select('id', 'name')->where('status', 1)->orderBy('rank_order', 'ASC')->get() as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row pl-3 pt-3">
                    <div class="col-9">
                        <button class="btn btn-primary col-md-3" type="submit">Submit</button>
                        <button class="btn btn-secondary" onclick="form_reset()">Clear</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
