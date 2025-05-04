@extends('layouts.backend.app')
@push('css')
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-chart-area icon-gradient bg-mean-fruit"></i>
                </div>
                <div>{{ isset($blood) ? 'Edit' : 'Create'}} Blood Group</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.blood-group.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form action="{{ isset($blood) ? route('app.blood-group.update', $blood->id) : route('app.blood-group.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @isset($blood)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="group_name">Group Name</label>
                                    <input id="group_name" type="text" class="form-control @error('group_name') is-invalid @enderror" name="group_name" value="{{ $blood->group_name ?? old('group_name') }}" required autocomplete="group_name" autofocus>

                                    @error('group_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{-- <label for="status">Status</label> --}}
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" id="status" name="status" @isset($blood) {{ $blood->is_active==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($blood)
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
