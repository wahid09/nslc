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
                <div>{{ isset($courseResult) ? 'Edit' : 'Create'}} Course Result</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.courseResult.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form
                action="{{ isset($courseResult) ? route('app.courseResult.update', $courseResult->id) : route('app.courseResult.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @isset($courseResult)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="club">Course *</label>
                                    <select id="course_id"
                                            class="form-control @error('course_id') is-invalid @enderror roleSelect"
                                            name="course_id" required>
                                        <option></option>
                                        @foreach ($courses as $item)
                                            <option value="{{ $item->id}}" @isset($courseResult)
                                                {{($courseResult->course_id == $item->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $item->course_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('course_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="full-featured-non-premium">Description</label>
                                    <textarea id="summernote"
                                              class="form-control @error('description') is-invalid @enderror"
                                              name="description">{{ $courseResult->description ?? old('description') }}</textarea>
                                    @error('description')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="full-featured-non-premium">Result Document(PDF Format)</label>
                                    <input type="file"
                                              class="form-control @error('course_doc') is-invalid @enderror"
                                              name="course_doc" accept="application/pdf">
                                    @error('course_doc')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="publish_date">Result Publication Date *</label>
                                    <input id="publish_date" type="date" class="form-control @error('publish_date') is-invalid @enderror" name="publish_date" value="{{ isset($courseResult) ? \Carbon\Carbon::parse($courseResult->publish_date)->format('Y-m-d') : old('publish_date')}}" required autocomplete="course_start_date" autofocus>
                                    @error('publish_date')
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
                                               name="status" @isset($courseResult) {{ $courseResult->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($courseResult)
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
            $('#course_id').select2({
                placeholder: "Select Course",
                allowClear: true
            });

        });
    </script>
@endpush
