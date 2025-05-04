@extends('layouts.backend.app')
@push('css')
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-calendar-plus icon-gradient bg-mean-fruit"></i>
                </div>
                <div>{{ isset($calender) ? 'Edit' : 'Create'}} Calender</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.calender.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form
                action="{{ isset($calender) ? route('app.calender.update', $calender->id) : route('app.calender.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @isset($calender)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="club">Club *</label>
                                    <select id="club"
                                            class="form-control @error('club') is-invalid @enderror roleSelect"
                                            name="club" required autofocus>
                                        <option></option>
                                        @foreach ($pages as $page)
                                            <option value="{{ $page->id}}" @isset($calender)
                                                {{($calender->club_id == $page->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $page->name_bn}}</option>
                                        @endforeach
                                    </select>
                                    @error('club')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="area">Area</label>
                                    <select id="area"
                                            class="form-control @error('area') is-invalid @enderror areaSelect"
                                            name="area" required autofocus>
                                        <option></option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id}}" @isset($calender)
                                                {{($calender->area_id == $area->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $area->name_bn}}</option>
                                        @endforeach
                                    </select>
                                    @error('area')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="title">title *</label>
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{ $calender->title ?? old('title') }}" required autocomplete="title"
                                           autofocus placeholder="Title must be in english">

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="start">Event Start Date *</label>
                                    <input id="start" type="date"
                                           class="form-control @error('start') is-invalid @enderror" name="start"
                                           value="{{ ($calender->start) ?? old('start') }}" autocomplete="start"
                                           autofocus>

                                    @error('start')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="end">Event End Date *</label>
                                    <input id="end" type="date" class="form-control @error('end') is-invalid @enderror"
                                           name="end" value="{{ ($calender->end) ?? old('end') }}" autocomplete="end"
                                           autofocus>

                                    @error('end')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label for="repeating">Repeating Event? *</label>--}}
{{--                                    <input id="repeating" type="checkbox"--}}
{{--                                           class="@error('repeating') is-invalid @enderror" name="repeating"--}}
{{--                                           value="{{ ($calender->repeating) ?? old('repeating') }}"--}}
{{--                                           autocomplete="repeating" autofocus>--}}

{{--                                    @error('repeating')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

                                {{--                                <div class="form-group startTime">--}}
                                {{--                                    <label for="groupId">Previous Event</label>--}}
                                {{--                                    <select id="groupId" class="form-control" name="groupId">--}}
                                {{--                                        @foreach ($calenders as $calenderpre)--}}
                                {{--                                            <option value="{{ $calenderpre->id}}" @isset($calender)--}}
                                {{--                                                {{($calender->id == $calenderpre->id) ? 'selected' : ''}}--}}
                                {{--                                                @endisset--}}
                                {{--                                            >{{ $calenderpre->title}}</option>--}}
                                {{--                                        @endforeach--}}
                                {{--                                    </select>--}}
                                {{--                                </div>--}}

                                {{--                                <div class="form-group startTime">--}}
                                {{--                                    <label for="start_time">Event Start Time *</label>--}}
                                {{--                                    <input id="start_time" type="time" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{ $calender->start_time ?? old('start_time') }}" autocomplete="start_time" autofocus>--}}

                                {{--                                    @error('start_time')--}}
                                {{--                                    <span class="invalid-feedback" role="alert">--}}
                                {{--                                    <strong>{{ $message }}</strong>--}}
                                {{--                                    </span>--}}
                                {{--                                    @enderror--}}
                                {{--                                </div>--}}

                                {{--                                <div class="form-group startTime">--}}
                                {{--                                    <label for="end_time">Event End Time *</label>--}}
                                {{--                                    <input id="end_time" type="time" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{ $calender->end_time ?? old('end_time') }}" autocomplete="end_time" autofocus>--}}

                                {{--                                    @error('end_time')--}}
                                {{--                                    <span class="invalid-feedback" role="alert">--}}
                                {{--                                    <strong>{{ $message }}</strong>--}}
                                {{--                                    </span>--}}
                                {{--                                    @enderror--}}
                                {{--                                </div>--}}

                                <div class="form-group">
                                    {{-- <label for="status">Status</label> --}}
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                               class="custom-control-input @error('status') is-invalid @enderror"
                                               id="status"
                                               name="status" @isset($calender) {{ $calender->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($calender)
                                        <i class="fas fa-arrow-circle-up"></i>&nbsp;Update
                                </button>
                                @else
                                    <i class="fas fa-plus-circle"></i>&nbsp;Create</button>
                                @endisset


                            </div>

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('.roleSelect').select2({
                placeholder: "Select Club",
                allowClear: true
            });
            $('.areaSelect').select2({
                placeholder: "Select Area",
                allowClear: true
            });
        });
    </script>
    <script>
        $(".startTime").hide();
        $("#repeating").click(function () {
            if ($(this).is(":checked")) {
                $(".startTime").show();
            } else {
                $(".startTime").hide();
            }
        });
    </script>

@endpush
