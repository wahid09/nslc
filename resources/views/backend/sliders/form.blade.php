@extends('layouts.backend.app')
@push('css')
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-slideshare icon-gradient bg-mean-fruit"></i>
                </div>
                <div>{{ isset($slider) ? 'Edit' : 'Create'}} Slider</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.sliders.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form action="{{ isset($slider) ? route('app.sliders.update', $slider->id) : route('app.sliders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @isset($slider)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="club">Club/Org *</label>
                                    <select id="club" class="form-control @error('club') is-invalid @enderror clubSelect" name="club" required autofocus>
                                        <option></option>
                                        @foreach ($pages as $page)
                                            <option value="{{ $page->id}}" @isset($slider)
                                                {{($slider->club_id == $page->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $page->name_bn}}</option>
                                        @endforeach
                                    </select>
                                    @error('page')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="title_bn">title(Bangla) *</label>
                                    <input id="title_bn" type="text" class="form-control @error('title_bn') is-invalid @enderror" name="title_bn" value="{{ $slider->title_bn ?? old('title_bn') }}" required autocomplete="title_bn" autofocus>

                                    @error('title_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label for="avatar">Slide</label>
                                    <input id="slide" type="file" class="dropify form-control @error('slide') is-invalid @enderror" name="slide" @isset($slider) data-default-file="{{asset('storage/slider/'. $slider->slide)}}" @endisset>
                                    <span>Image size will be: 1366 X 682</span>
                                    @error('slide')
                                    <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="full-featured-non-premium">Description</label>
                                    <textarea id="summernote" class="form-control @error('description') is-invalid @enderror" name="description">{{ $slider->description ?? old('description') }}</textarea>
                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{-- <label for="status">Status</label> --}}
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" id="status" name="status" @isset($slider) {{ $slider->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($slider)
                                        <i class="fas fa-arrow-circle-up"></i>&nbsp;Update</button>
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
        $(document).ready(function() {
            $('.clubSelect').select2({
                placeholder: "Select Club",
                allowClear: true
            });
        });
    </script>



@endpush
