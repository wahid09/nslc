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
                <div>{{ isset($unit) ? 'Edit' : 'Create'}} Unit</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.unit.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form action="{{ isset($unit) ? route('app.unit.update', $unit->id) : route('app.unit.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @isset($unit)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Unit Name(English)</label>
                                    <input id="name" type="text"
                                           class="form-control @error('unit_name_en') is-invalid @enderror" name="unit_name_en"
                                           value="{{ $unit->unit_name_en ?? old('unit_name_en') }}" required autocomplete="unit_name_en"
                                           autofocus>

                                    @error('unit_name_en')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="name">Unit Name(Bangla)</label>
                                    <input id="name" type="text"
                                           class="form-control @error('unit_name_bn') is-invalid @enderror" name="unit_name_bn"
                                           value="{{ $unit->unit_name_bn ?? old('unit_name_bn') }}" required autocomplete="unit_name_bn"
                                           autofocus>

                                    @error('unit_name_bn')
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
                                               name="status" @isset($unit) {{ $unit->is_active==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    @isset($unit)
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
