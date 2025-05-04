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
                <div>{{ isset($training) ? 'Edit' : 'Create'}} Events</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.training.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form
                action="{{ isset($training) ? route('app.training.update', $training->id) : route('app.training.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @isset($training)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="club">Club *</label>
                                    <select id="club"
                                            class="form-control @error('club') is-invalid @enderror clubSelect"
                                            name="club" required autofocus>
                                        <option></option>
                                        @foreach ($pages as $page)
                                            <option value="{{ $page->id}}" @isset($training)
                                                {{($training->club_id == $page->id) ? 'selected' : ''}}
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
                                    <label for="area">Area *</label>
                                    <select id="area"
                                            class="form-control @error('area') is-invalid @enderror areaSelect"
                                            name="area" required autofocus>
                                        <option></option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id}}" @isset($training)
                                                {{($training->area_id == $area->id) ? 'selected' : ''}}
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
                                    <label for="category">Event Category *</label>
                                    <select id="category"
                                            class="form-control @error('category') is-invalid @enderror eventSelect"
                                            name="category" required autofocus>
                                        <option></option>
                                        @foreach ($trainCategories as $item)
                                            <option value="{{ $item->id}}" @isset($training)
                                                {{($training->training_categorie_id == $item->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $item->name_bn}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="title_bn">title(Bangla) *</label>
                                    <input id="title_bn" type="text"
                                           class="form-control @error('title_bn') is-invalid @enderror" name="title_bn"
                                           value="{{ $training->title_bn ?? old('title_bn') }}" required
                                           autocomplete="title_bn" autofocus>

                                    @error('title_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="avatar">Image</label>
                                    <input id="avatar" type="file"
                                           class="dropify form-control @error('image') is-invalid @enderror"
                                           name="image" @isset($training) data-default-file="{{asset('storage/training/'.$training->image)}}" @endisset>
                                    <span>Image size will be: 368 X 305</span>
                                    @error('image')
                                    <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="training_date">Event Date</label>
                                    <input id="training_date" type="date"
                                           class="form-control @error('training_date') is-invalid @enderror"
                                           name="training_date"
                                           value="{{ ($training->training_date) ?? old('training_date') }}"
                                           autocomplete="training_date" autofocus>

                                    @error('training_date')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                {{--                                <div class="form-group">--}}
                                {{--                                    <label for="start_time">Event Start Time *</label>--}}
                                {{--                                    <input id="start_time" type="time"--}}
                                {{--                                           class="form-control @error('start_time') is-invalid @enderror"--}}
                                {{--                                           name="start_time" value="{{ $training->start_time ?? old('start_time') }}"--}}
                                {{--                                           autocomplete="start_time" autofocus>--}}

                                {{--                                    @error('start_time')--}}
                                {{--                                    <span class="invalid-feedback" role="alert">--}}
                                {{--                                    <strong>{{ $message }}</strong>--}}
                                {{--                                    </span>--}}
                                {{--                                    @enderror--}}
                                {{--                                </div>--}}


                                {{--                                <div class="form-group">--}}
                                {{--                                    <label for="end_time">Event End Time *</label>--}}
                                {{--                                    <input id="end_time" type="time"--}}
                                {{--                                           class="form-control @error('end_time') is-invalid @enderror" name="end_time"--}}
                                {{--                                           value="{{ $training->end_time ?? old('end_time') }}" autocomplete="end_time"--}}
                                {{--                                           autofocus>--}}

                                {{--                                    @error('end_time')--}}
                                {{--                                    <span class="invalid-feedback" role="alert">--}}
                                {{--                                    <strong>{{ $message }}</strong>--}}
                                {{--                                    </span>--}}
                                {{--                                    @enderror--}}
                                {{--                                </div>--}}

                                <div class="form-group">
                                    <label for="full-featured-non-premium">Description</label>
                                    <textarea id="summernote"
                                              class="form-control @error('description_bn') is-invalid @enderror"
                                              name="description_bn">{{ $training->description_bn ?? old('description_bn') }}</textarea>
                                    @error('description_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{-- <label for="status">Status</label> --}}
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                               class="custom-control-input @error('status') is-invalid @enderror"
                                               id="status"
                                               name="status" @isset($training) {{ $training->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($training)
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
            $('.clubSelect').select2({
                placeholder: "Select Club",
                allowClear: true
            });
            $('.areaSelect').select2({
                placeholder: "Select Area",
                allowClear: true
            });
            $('.eventSelect').select2({
                placeholder: "Select Event Category",
                allowClear: true
            });
        });
    </script>

@endpush
