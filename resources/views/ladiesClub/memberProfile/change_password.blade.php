@extends('ladiesClub.layout.app')
@section('title', 'Change Password')

@push('css')
@endpush

@section('main_menu', 'Home')

{{--@section('active_menu', 'Change Password')--}}

{{--@section('link', route('user.userdashboard'))--}}

@section('content')

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header bg-primary text-white mb-3">
                        <h5 class="mb-0">Change Your Password</h5>

                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{route('app.member.updatePassword')}}">
                            @csrf
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm
                                    Password</label>
                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password"
                                           class="form-control @error('password_confirmation') is-invalid @enderror"
                                           name="password_confirmation" autocomplete="new-password">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-10 text-end">
                                    <button type="submit" class="btn btn-success-gradien">
                                        Update Password
                                    </button>
                                </div>
                            </div>

{{--                            @if ($errors->any())--}}
{{--                                <div class="alert alert-danger">--}}
{{--                                    <ul>--}}
{{--                                        @foreach ($errors->all() as $error)--}}
{{--                                            <li>{{ $error }}</li>--}}
{{--                                        @endforeach--}}
{{--                                    </ul>--}}
{{--                                </div>--}}
{{--                            @endif--}}

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
@endpush
