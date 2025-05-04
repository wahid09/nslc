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
                <div>{{ isset($event) ? 'Edit' : 'Create'}} Event</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.ladies-club-event.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>
    @php
    @endphp
    <div class="row">
        <div class="col-12">
            <form action="{{ isset($event) ? route('app.ladies-club-event.update', $event->id) : route('app.ladies-club-event.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @isset($event)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">
                                <div class="form-group notice">
                                    <label for="club">Club *</label>
                                    <input type="text" class="form-control" value="লেডিস ক্লাব" readonly>
                                    @error('club')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group notice">
                                    <label for="area">Area *</label>
                                    <select id="area"
                                            class="form-control @error('area') is-invalid @enderror areaSelect"
                                            name="area">
                                        <option></option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id}}" @isset($event)
                                                {{($event->area_id == $area->id) ? 'selected' : ''}}
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
                                    <label for="title_bn">Event title(Bangla) *</label>
                                    <input id="title_bn" type="text"
                                           class="form-control @error('title_bn') is-invalid @enderror" name="title_bn"
                                           value="{{ $event->title_bn ?? old('title_bn') }}" required
                                           autocomplete="title_bn" autofocus>

                                    @error('title_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

{{--                                <div class="form-group">--}}
{{--                                    <label for="avatar">Attachment</label>--}}
{{--                                    <input id="avatar" type="file"--}}
{{--                                           class="dropify form-control @error('attachment') is-invalid @enderror"--}}
{{--                                           name="attachment" onchange="showImage(this, 'slider_photo')">--}}
{{--                                    <span>The attachment must be a file of type: pdf, docx.</span>--}}
{{--                                    @error('attachment')--}}
{{--                                    <span class="text-danger" role="alert">--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}

                                <div class="form-group">
                                    <label for="full-featured-non-premium">Event Description</label>
                                    <textarea id="summernote"
                                              class="form-control @error('description_bn') is-invalid @enderror"
                                              name="description_bn">{{ $event->description_bn ?? old('description_bn') }}</textarea>
                                    @error('description_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="notice_date">Event Date *</label>
                                    <input id="notice_date" type="date"
                                           class="form-control @error('event_date') is-invalid @enderror"
                                           name="event_date" value="" autocomplete="event_date" autofocus>

                                    @error('event_date')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    --}}{{-- <label for="status">Status</label> --}}
{{--                                    <div class="custom-control custom-switch">--}}
{{--                                        <input type="checkbox" id="isPrivate"--}}
{{--                                               class="custom-control-input @error('private') is-invalid @enderror"--}}
{{--                                               id="private"--}}
{{--                                               name="private" @isset($notice) {{ $notice->private==true ? 'checked' : ''}} @endisset>--}}
{{--                                        <label class="custom-control-label" for="isPrivate">Private?</label>--}}
{{--                                    </div>--}}
{{--                                    @error('private')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                    <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}


{{--                                <div class="form-group">--}}
{{--                                    --}}{{-- <label for="status">Status</label> --}}
{{--                                    <div class="custom-control custom-switch">--}}
{{--                                        <input type="checkbox"--}}
{{--                                               class="custom-control-input @error('is_footer') is-invalid @enderror"--}}
{{--                                               id="is_footer"--}}
{{--                                               name="is_footer" @isset($notice) {{ $notice->is_footer==true ? 'checked' : ''}} @endisset>--}}
{{--                                        <label class="custom-control-label" for="is_footer">Is Footer ?</label>--}}
{{--                                    </div>--}}
{{--                                    @error('is_footer')--}}
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
                                               name="status" @isset($event) {{ $event->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($event)
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
    <script nonce="abc123">
        $(document).ready(function () {
            $('.clubSelect').select2({
                placeholder: "Select Club",
                allowClear: true
            });
            $('.areaSelect').select2({
                placeholder: "Select Area",
                allowClear: true
            });
        });
    </script>

@endpush
