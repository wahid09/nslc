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
                <div>{{ isset($tutorial) ? 'Edit' : 'Create'}} Tutorial</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.tutorial.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form
                action="{{ isset($tutorial) ? route('app.tutorial.update', $tutorial->id) : route('app.tutorial.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @isset($tutorial)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="role">Admin Type *</label>
                                    <select id="role"
                                            class="form-control @error('role') is-invalid @enderror clubSelect"
                                            name="role" required autofocus>
                                        <option></option>
                                        @foreach ($roles as $item)
                                            <option value="{{ $item->id}}" @isset($tutorial)
                                                {{($tutorial->role_id == $item->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $item->name_bn}}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="title_bn">title *</label>
                                    <input id="title_bn" type="text"
                                           class="form-control @error('title_bn') is-invalid @enderror" name="title"
                                           value="{{ $tutorial->title ?? old('title') }}" required
                                           autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-group">
                                    <label for="avatar">Video *</label>
                                    <input id="slide" type="file"
                                           class="dropify form-control @error('video') is-invalid @enderror"
                                           name="video"
                                           @isset($tutorial) data-default-file="{{asset('storage/video/'. $tutorial->video)}}" @endisset>
                                    @error('video')
                                    <span class="text-danger" role="alert">
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
                                               name="status" @isset($tutorial) {{ $tutorial->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($tutorial)
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
        });
    </script>



@endpush
