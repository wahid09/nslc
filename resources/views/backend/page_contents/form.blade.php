@extends('layouts.backend.app')
@push('css')
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-accusoft icon-gradient bg-mean-fruit"></i>
                </div>
                <div>{{ isset($pageContent) ? 'Edit' : 'Create'}} Page Contents</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.page_contents.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form
                action="{{ isset($pageContent) ? route('app.page_contents.update', $pageContent->id) : route('app.page_contents.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @isset($pageContent)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="page">Page</label>
                                    <select id="page"
                                            class="form-control @error('category') is-invalid @enderror pageSelect"
                                            name="page" required autofocus>
                                        <option></option>
                                        @foreach ($pages as $page)
                                            <option value="{{ $page->id}}" @isset($pageContent)
                                                {{($pageContent->page_id == $page->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $page->title_bn}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slogan_bn"> title(Bangla) *</label>
                                    <input id="slogan_bn" type="text"
                                           class="form-control @error('slogan_bn') is-invalid @enderror"
                                           name="slogan_bn" value="{{ $pageContent->slogan_bn ?? old('slogan_bn') }}"
                                           required autocomplete="slogan_bn" autofocus placeholder="নাম">

                                    @error('slogan_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="banner">Banner</label>
                                    <input id="banner" type="file"
                                           class="dropify form-control @error('banner') is-invalid @enderror"
                                           name="banner"
                                           @isset($pageContent) data-default-file="{{asset('storage/content/banners/'. $pageContent->banner)}}" @endisset>
                                    <span>Image size will be: 1134 X 376</span>
                                    @error('banner')
                                    <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="full-featured-non-premium">Description</label>
                                    <textarea id="summernote"
                                              class="form-control @error('description_bn') is-invalid @enderror"
                                              name="description_bn">{{ $pageContent->description_bn ?? old('description_bn') }}</textarea>
                                    @error('description_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                @if(!empty($pageContent->image))
                                    <div class="form-group row">
                                        <label for="photo" class=""></label>
                                        @php
                                            $images = json_decode($pageContent->image);
                                        @endphp
                                        <div class="col-sm-8">
                                            @foreach($images as $item)
                                                <img src="{{ url('storage/content/images/'.$item) }}"
                                                     class="slide-photo" id="slider_photo" style="width: 200px;">
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group @if(!empty($pageContent->image)) '' @else sapoxAbout @endif">
                                    <label for="image">Image(multiple)</label>
                                    <input id="image" type="file"
                                           class="form-control @error('image') is-invalid @enderror"
                                           name="image[]"
                                           onchange="showImage(this, 'slider_photo')" multiple>
                                    <span>Image size will be: 384 X 338</span>
                                    @error('image')
                                    <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div
                                    class="form-group @if(!empty($pageContent->short_description_bn)) '' @else sapoxAbout @endif">
                                    <label for="full-featured-non-premium">Short Description</label>
                                    <textarea id="summernote_short"
                                              class="form-control @error('short_description_bn') is-invalid @enderror"
                                              name="short_description_bn">{{ $pageContent->short_description_bn ?? old('short_description_bn') }}</textarea>
                                    @error('short_description_bn')
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
                                               name="status" @isset($pageContent) {{ $pageContent->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($pageContent)
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
            $('.pageSelect').select2({
                placeholder: "Select Page",
                allowClear: true
            });
        });
    </script>
   
    <script>
        ClassicEditor
            .create(document.querySelector('#short'))
            .then(short => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        $('.sapoxAbout').hide();
        $("#page").on('select2:select', function (e) {
            var data = $("#page").val();
            if (data == 6) {
                $('.sapoxAbout').show();
            } else if (data == 8) {
                $('.sapoxAbout').show();
            } else if (data == 9) {
                $('.sapoxAbout').show();
            } else {
                $('.sapoxAbout').hide();
            }
        });
    </script>

@endpush
