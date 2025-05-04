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
                <div>{{ isset($sobanetry) ? 'Edit' : 'Create'}} Leader</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.showroome.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form
                action="{{ isset($showroomes) ? route('app.showroome.update', $showroomes->id) : route('app.showroome.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @isset($showroomes)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="area">Area</label>
                                    <select id="area"
                                            class="form-control @error('area') is-invalid @enderror roleSelect"
                                            name="area_id" required autofocus>
                                        <option></option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id}}" @isset($showroomes)
                                                {{($showroomes->area_id == $area->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $area->name_bn}}</option>
                                        @endforeach
                                    </select>
                                    @error('area_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="title">Title *</label>
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{ $showroomes->title ?? old('title') }}" required
                                           autocomplete="title" autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="house">House No *</label>
                                    <input id="house" type="text"
                                           class="form-control @error('house') is-invalid @enderror" name="house"
                                           value="{{ $showroomes->house ?? old('house') }}" required
                                           autocomplete="house" autofocus>

                                    @error('house')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="road">Raod No *</label>
                                    <input id="road" type="text"
                                           class="form-control @error('road') is-invalid @enderror" name="road"
                                           value="{{ $showroomes->road ?? old('road') }}" required autocomplete="road"
                                           autofocus>

                                    @error('road')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="area">Area *</label>
                                    <input id="area" type="text"
                                           class="form-control @error('area') is-invalid @enderror" name="area"
                                           value="{{ $showroomes->area ?? old('area') }}" required autocomplete="area"
                                           autofocus>

                                    @error('area')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone">Phone No *</label>
                                    <input id="phone" type="tel"
                                           class="form-control @error('phone') is-invalid @enderror" name="phone"
                                           value="{{ $showroomes->phone ?? old('phone') }}" required
                                           autocomplete="phone" autofocus>

                                    @error('phone')
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
                                           @isset($showroomes) data-default-file="{{asset('storage/showrooms/'.$showroomes->image)}}" @endisset>
                                    <span>Image size will be: 384 X 270</span>
                                    @error('image')
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
                                               name="status" @isset($showroomes) {{ $showroomes->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($showroomes)
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
                placeholder: "Select Area",
                allowClear: true
            });
        });
    </script>

@endpush
