@extends('layouts.backend.app')
@push('css')
    <style>

    </style>
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-check icon-gradient bg-mean-fruit"></i>
                </div>
                <div>{{ isset($rank) ? 'Edit' : 'Create'}} Rank</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.ranks.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form action="{{ isset($rank) ? route('app.ranks.update', $rank->id) : route('app.ranks.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @isset($rank)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Rank Name(English)</label>
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ $rank->name ?? old('name') }}" required autocomplete="name"
                                           autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name_bn">Rank Name(Bangla)</label>
                                    <input id="name_bn" type="text"
                                           class="form-control @error('name_bn') is-invalid @enderror" name="name_bn"
                                           value="{{ $rank->name_bn ?? old('name_bn') }}" required
                                           autocomplete="name_bn" autofocus>

                                    @error('name_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="rank_order">Rank Order</label>
                                    <input id="rank_order" type="number"
                                           class="form-control @error('rank_order') is-invalid @enderror"
                                           name="rank_order" value="{{ $rank->rank_order ?? old('rank_order') }}"
                                           required autocomplete="rank_order" autofocus>

                                    @error('rank_order')
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
                                               name="status" @isset($rank) {{ $rank->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    @isset($policy)
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
    <script src="{{asset('assets/select/select2.min.js')}}"></script>
    <script src="{{asset('assets/dropify/dropify.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.roleSelect').select2();
        });
        $(document).ready(function () {
            $('.areaSelect').select2();
        });
        $('.dropify').dropify();
    </script>

@endpush
