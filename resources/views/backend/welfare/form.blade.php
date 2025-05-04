@extends('layouts.backend.app')
@push('css')
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-won-sign"></i>
                </div>
                <div>{{ isset($welfare) ? 'Edit' : 'Create'}} Welfare</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.welfares.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form
                action="{{ isset($welfare) ? route('app.welfares.update', $welfare->id) : route('app.welfares.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @isset($welfare)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="club">Club/Org *</label>
                                    <select id="club"
                                            class="form-control @error('club') is-invalid @enderror roleSelect"
                                            name="club" required autofocus>
                                        <option></option>
                                        @foreach ($pages as $page)
                                            <option value="{{ $page->id}}" @isset($welfare)
                                                {{($welfare->club_id == $page->id) ? 'selected' : ''}}
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
                                            <option value="{{ $area->id}}" @isset($welfare)
                                                {{($welfare->area_id == $area->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $area->name_bn}}</option>
                                        @endforeach
                                    </select>
                                    @error('title_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="title_bn">title(Bangla) *</label>
                                    <input id="title_bn" type="text"
                                           class="form-control @error('title_bn') is-invalid @enderror" name="title_bn"
                                           value="{{ $welfare->title_bn ?? old('title_bn') }}" required
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
                                           name="image"
                                           @isset($welfare) data-default-file="{{asset('storage/welfare/'.$welfare->image)}}" @endisset>
                                    <span>Image size will be: 368 X 305</span>
                                    @error('image')
                                    <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="slogan_bn">Slogan</label>
                                    <input id="slogan_bn" type="text"
                                           class="form-control @error('slogan_bn') is-invalid @enderror"
                                           name="slogan_bn" value="{{ $welfare->slogan_bn ?? old('slogan_bn') }}"
                                           autocomplete="title_bn" autofocus>

                                    @error('slogan_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="full-featured-non-premium">Description</label>
                                    <textarea id="summernote"
                                              class="form-control @error('description_bn') is-invalid @enderror"
                                              name="description_bn">{{ $welfare->description_bn ?? old('description_bn') }}</textarea>
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
                                               name="status" @isset($welfare) {{ $welfare->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($welfare)
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

@endpush
