@extends('layouts.backend.app')
@push('css')
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-file icon-gradient bg-mean-fruit"></i>
                </div>
                <div>Edit Footer Information</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.footers.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form action="{{ isset($fInfo) ? route('app.footers.update', $fInfo->id) : route('app.footers.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="slogan_bn">Footer Info *</label>
                                    <textarea id="slogan_bn" class="form-control @error('slogan_bn') is-invalid @enderror" name="slogan_bn">{{ $fInfo->slogan_bn ?? old('slogan_bn') }}
                                    </textarea>
                                    @error('slogan_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="contact_bn">Contact Info *</label>
                                    <textarea id="summernote" class="form-control @error('contact_bn') is-invalid @enderror" name="contact_bn">{{ $fInfo->contact_bn ?? old('contact_bn') }}
                                    </textarea>
                                    @error('contact_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="avatar">Logo</label>
                                    <input id="avatar" type="file" class="dropify form-control @error('logo') is-invalid @enderror" name="logo" @isset($fInfo) data-default-file="{{asset('storage/logo/'.$fInfo->logo)}}" @endisset>

                                    @error('logo')
                                    <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($fInfo)
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
@endpush
