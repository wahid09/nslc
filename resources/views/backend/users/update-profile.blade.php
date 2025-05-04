@extends('layouts.backend.app')
@push('css')
    {{-- <link href="{{asset('assets/dropify/dropify.min.css')}}" rel="stylesheet"> --}}
    {{-- <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }

        .slide-photo {
            width: 320px;
            height: 100px;
        }
    </style> --}}
@endpush

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="col-md-12">
                <div class="main-card mb-3 card">
                    <div class="card-body"><h5 class="card-title">User Ino List</h5>
                        <div>
                            <ul class="list-group">
                                <a href="{{route('app.userprofile.index')}}"
                                   class="list-group-item-action list-group-item {{Request::is('app/userprofile*') ? 'active' : ''}}">Profile</a>
                                <a href="{{route('app.userprofile.update')}}"
                                   class="list-group-item-action list-group-item {{Request::is('app/update-profile*') ? 'active' : ''}}">Upadte
                                    Profile</a>
                                <a href="{{route('app.password.edit')}}"
                                   class="list-group-item-action list-group-item {{Request::is('app/password-edit*') ? 'active' : ''}}">Change
                                    Password</a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <form action="{{ route('app.userprofile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Update User Information</h5>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input id="phone" type="text"
                                               class="form-control @error('phone') is-invalid @enderror" name="phone"
                                               maxlength="15" placeholder="(XXX) XXX-XXXX"
                                               value="{{ $userInfo->phone ?? old('phone') }}">

                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-control @error('gender') is-invalid @enderror"
                                                name="gender">
                                            <option>--Select Gender--</option>
                                            <option value="1"
                                                    @if(!empty($userInfo)) @if($userInfo->gender == 1) selected @endif @endif>
                                                Male
                                            </option>
                                            <option value="0"
                                                    @if(!empty($userInfo)) @if($userInfo->gender == 0) selected @endif @endif>
                                                Female
                                            </option>
                                        </select>
                                        @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                                </span>
                                        @enderror
                                    </div>
                                    {{-- @if(!empty($userInfo->image))
                                        <div class="form-group row">
                                            <label for="photo" class=""></label>
                                            <div class="col-sm-8">
                                                <img src="{{ url('storage/users/'.$userInfo->image) }}"
                                                     class="slide-photo" id="slider_photo" style="width: 200px;">
                                            </div>
                                        </div>
                                    @endif --}}
                                    <div class="form-group">
                                        <label for="image">Profile Image</label>
                                        <input id="image" type="file"
                                               class="dropify form-control @error('image') is-invalid @enderror"
                                               name="image" onchange="showImage(this, 'slider_photo')" @isset($userInfo) data-default-file="{{asset('storage/users/'. $userInfo->image)}}" @endisset>

                                        @error('image')
                                        <span class="text-danger" role="alert">
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
    
    <script>
        
        $('#phone')

            .on('keypress', function (e) {
                var key = e.charCode || e.keyCode || 0;
                var phone = $(this);
                if (phone.val().length === 0) {
                    phone.val(phone.val() + '(');
                }
                // Auto-format- do not expose the mask as the user begins to type
                if (key !== 8 && key !== 9) {
                    if (phone.val().length === 6) {
                        phone.val(phone.val() + ')');
                    }
                    if (phone.val().length === 7) {
                        phone.val(phone.val() + ' ');
                    }
                    if (phone.val().length === 11) {
                        phone.val(phone.val() + '-');
                    }
                    if (phone.val().length >= 15) {
                        phone.val(phone.val().slice(0, 13));
                    }
                }

                // Allow numeric (and tab, backspace, delete) keys only
                return (key == 8 ||
                    key == 9 ||
                    key == 46 ||
                    (key >= 48 && key <= 57) ||
                    (key >= 96 && key <= 105));
            })

            .on('focus', function () {
                phone = $(this);

                if (phone.val().length === 0) {
                    phone.val('(');
                } else {
                    var val = phone.val();
                    phone.val('').val(val); // Ensure cursor remains at the end
                }
            })

            .on('blur', function () {
                $phone = $(this);

                if ($phone.val() === '(') {
                    $phone.val('');
                }
            });
    </script>
    <script type="text/javascript">
        //Image Show Before Upload Start
        $(document).ready(function () {
            $('input[type="file"]').change(function (e) {
                var fileName = e.target.files[0].name;
                if (fileName) {
                    $('#fileLabel').html(fileName);
                }
            });
        });

        function showImage(data, imgId) {
            if (data.files && data.files[0]) {
                var obj = new FileReader();
                obj.onload = function (d) {
                    var image = document.getElementById(imgId);
                    image.src = d.target.result;
                }
                obj.readAsDataURL(data.files[0]);
            }
        }

        //Image Show Before Upload End
    </script>
@endpush
