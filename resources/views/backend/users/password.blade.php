@extends('layouts.backend.app')
@push('css')

@endpush

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">User Ino List</h5>
                        <div>
                            <ul class="list-group">
                                <a href="{{route('app.userprofile.index')}}" class="list-group-item-action list-group-item {{Request::is('app/userprofile*') ? 'active' : ''}}">Profile</a>
                                <a href="{{route('app.userprofile.edit')}}" class="list-group-item-action list-group-item">Upadte Profile</a>
                                <a href="{{route('app.password.edit')}}" class="list-group-item-action list-group-item {{Request::is('app/password-edit*') ? 'active' : ''}}">Change Password</a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <form action="{{ route('app.password.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Update Password</h5>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="current_pass">Current Password</label>
                                        <input id="current_pass" type="password" class="form-control @error('current_pass') is-invalid @enderror" name="current_pass" placeholder="Enter your current password" autocomplete="off">

                                        @error('current_pass')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="off" autofocus placeholder="Enter new Password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="confirm_password">Confirm password</label>
                                            <input id="confirm_password" type="password" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="off" autofocus placeholder="Confirm password">

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                            @enderror
                                        </div>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus-circle"></i>&nbsp;Update
                                    </button>
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
