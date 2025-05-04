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
                <div>{{ isset($device) ? 'Edit' : 'Add'}} Device</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.device.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form action="{{ isset($device) ? route('app.device.update', $device->id) : route('app.device.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @isset($device)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="device_name">Device Name</label>
                                    <input id="device_name" type="text" class="form-control @error('device_name') is-invalid @enderror" name="device_name" value="{{ $device->device_name ?? old('device_name') }}" required autocomplete="name_bn" autofocus>

                                    @error('device_name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="device_number">Device Number</label>
                                    <input id="device_number" type="number" class="form-control @error('device_number') is-invalid @enderror" name="device_number" value="{{ $device->device_number ?? old('device_number') }}" required autocomplete="slogan_bn" autofocus>

                                    @error('device_number')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="device_ip">Device IP</label>
                                    <input id="device_ip" type="text" class="form-control @error('device_ip') is-invalid @enderror" name="device_ip" value="{{ $device->device_ip ?? old('device_ip') }}" required autocomplete="device_ip" autofocus>

                                    @error('device_ip')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    {{-- <label for="status">Status</label> --}}
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" id="status" name="status" @isset($device) {{ $device->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($device)
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
