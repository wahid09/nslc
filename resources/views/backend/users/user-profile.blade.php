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
                                <a href="{{route('app.password.edit')}}" class="list-group-item-action list-group-item">Change Password</a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="main-card mb-3 card">
                <div class="card-body"><h5 class="card-title">User Info</h5>
                    <div class="row">
                        <div class="col-md-3">
                            @if(!empty($userInfo->image))
                                <img src="{{asset('storage/users/'.$userInfo->image)}}" alt="{{$userInfo->name_bn}}" width="200px">
                                @else
                                <img src="{{asset('assets/images/avatars/avatar.png')}}" alt="avatar">
                            @endif
                        </div>
                        <div class="col-md-6">
                            <table class="table">
                                <thead class="thead-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Gender</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @if(!empty($userInfo))
                                    <td>{{$userInfo->name_bn}}</td>
                                    <td>{{$userInfo->role_name}}</td>
                                    <td>
                                        @if($userInfo->gender == 1)
                                            Male
                                            @else
                                        Women
                                            @endif
                                    </td>
                                        @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
