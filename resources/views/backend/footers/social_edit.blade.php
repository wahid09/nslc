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
                <div>{{ isset($links) ? 'Edit' : 'Create'}} Social Links</div>
            </div>
{{--            <div class="page-title-actions">--}}
{{--                <a href="{{ route('app.pages.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">--}}
{{--                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list--}}
{{--                </a>--}}
{{--            </div>--}}
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form action="{{ isset($links) ? route('app.socials.update', $links->id) : route('app.social.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
{{--                @isset($page)--}}
{{--                    @method('PUT')--}}
{{--                @endisset--}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="fb_link">Facebook Link</label>
                                    <input id="fb_link" type="text" class="form-control @error('fb_link') is-invalid @enderror" name="fb_link" value="{{ $links->fb_link ?? old('fb_link') }}" required autocomplete="title_bn" autofocus placeholder="">

                                    @error('fb_link')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="twitter_link">Twitter Link</label>
                                    <input id="twitter_link" type="text" class="form-control @error('twitter_link') is-invalid @enderror" name="twitter_link" value="{{ $links->twitter_link ?? old('twitter_link') }}" required autocomplete="title_bn" autofocus placeholder="">

                                    @error('twitter_link')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="instra_link">Instragram Link</label>
                                    <input id="instra_link" type="text" class="form-control @error('instra_link') is-invalid @enderror" name="instra_link" value="{{ $links->instra_link ?? old('instra_link') }}" required autocomplete="title_bn" autofocus placeholder="">

                                    @error('instra_link')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($links)
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
