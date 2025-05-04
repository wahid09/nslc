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
                <div>{{ isset($course) ? 'Edit' : 'Create'}} Course</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.course.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form
                action="{{ isset($course) ? route('app.course.update', $course->id) : route('app.course.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @isset($course)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="course_name">Course Title *</label>
                                    <input id="course_name" type="text" class="form-control @error('course_name') is-invalid @enderror" name="course_name" value="{{ $course->course_name ?? old('course_name') }}" required autocomplete="course_name" autofocus>

                                    @error('course_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="full-featured-non-premium">Description</label>
                                    <textarea id="summernote"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description">{{ $course->description ?? old('description') }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="course_start_date">Course Start Date *</label>
                                    <input id="course_start_date" type="date" class="form-control @error('course_start_date') is-invalid @enderror" name="course_start_date" value="{{ isset($course) ? \Carbon\Carbon::parse($course->start_date)->format('Y-m-d') : old('course_start_date')}}" required autocomplete="course_start_date" autofocus>
                                    @error('course_start_date')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="course_end_date">Course End Date *</label>
                                    <input id="course_end_date" type="date" class="form-control @error('course_end_date') is-invalid @enderror" name="course_end_date" value="{{isset($course) ? \Carbon\Carbon::parse($course->end_time)->format('Y-m-d') :  old('course_end_date') }}" required autocomplete="course_end_date" autofocus>
                                    @error('course_end_date')
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
                                               name="status" @isset($course) {{ $course->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($course)
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


@endpush
