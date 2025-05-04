@extends('layouts.backend.app')
@push('css')
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-calendar-plus icon-gradient bg-mean-fruit"></i>
                </div>
                <div>{{ isset($sobanetry) ? 'Edit' : 'Create'}} Board Member</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.leader.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form
                action="{{ isset($sobanetry) ? route('app.leader.update', $sobanetry->id) : route('app.leader.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @isset($sobanetry)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="club">Club *</label>
                                    <select id="club"
                                            class="form-control @error('club') is-invalid @enderror clubSelect"
                                            name="club" required autofocus>
                                        <option></option>
                                        @foreach ($pages as $page)
                                            <option value="{{ $page->id}}" @isset($sobanetry)
                                                {{($sobanetry->club_id == $page->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $page->name_bn}}</option>
                                        @endforeach
                                    </select>
                                    @error('club')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="area">Area</label>
                                    <select id="area"
                                            class="form-control @error('area') is-invalid @enderror areaSelect"
                                            name="area_id" required autofocus>
                                        <option></option>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id}}" @isset($sobanetry)
                                                {{($sobanetry->area_id == $area->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $area->name_bn}}</option>
                                        @endforeach
                                    </select>
                                    @error('area_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="user_id">Member Name</label>
                                    <select id="user_id"
                                            class="form-control @error('user_id') is-invalid @enderror userSelect"
                                            name="user_id" required autofocus>
                                        {{-- <option></option> --}}
                                        <option></option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}"
                                                @isset($sobanetry)
                                                    {{ $sobanetry->user_id == $user->id ? 'selected' : '' }}
                                                @endisset
                                            >
                                                {{ $user->name ?: $user->name_bn }} <!-- Show name, fallback to name_bn -->
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="appointment">Appointment *</label>
                                    <select id="appointment"
                                            class="form-control @error('appointment') is-invalid @enderror roleSelect"
                                            name="appointment" required autofocus>
                                        <option></option>
                                        @foreach ($appointments as $appointment)
                                            <option value="{{ $appointment->id}}" @isset($sobanetry)
                                                {{($sobanetry->appointment_id == $appointment->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $appointment->name_bn}}</option>
                                        @endforeach
                                    </select>
                                    @error('appointment')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                {{-- <div class="form-group">
                                    <label for="name_bn">Name(Bangla) *</label>
                                    <input id="name_bn" type="text"
                                           class="form-control @error('name_bn') is-invalid @enderror" name="name_bn"
                                           value="{{ $sobanetry->name_bn ?? old('name_bn') }}" autocomplete="name_bn"
                                           autofocus placeholder="Name">

                                    @error('name_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div> --}}
                                <div class="form-group">
                                    <label for="name_bn">Seniority Order *</label>
                                    <input id="seniority_order" type="number"
                                           class="form-control @error('seniority_order') is-invalid @enderror" name="seniority_order"
                                           value="{{ $sobanetry->seniority_order ?? old('seniority_order') }}" autocomplete="name_bn"
                                           autofocus placeholder="Seniority Order ex:1, 2,3">

                                    @error('seniority_order')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="avatar">Image</label>
                                    <input id="avatar" type="file"
                                           class="dropify form-control @error('image') is-invalid @enderror"
                                           name="image" @isset($sobanetry) data-default-file="{{asset('storage/leader/'.$sobanetry->image)}}" @endisset>

                                    @error('image')
                                    <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <span class="" role="alert">Image size will be: 512x490</span>
                                </div>

                                <div class="form-group">
                                    <label for="full-featured-non-premium">Description</label>
                                    <textarea id="summernote"
                                              class="form-control @error('description_bn') is-invalid @enderror"
                                              name="description_bn">{{ $sobanetry->description_bn ?? old('description_bn') }}</textarea>
                                    @error('description_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="appoint_in">Appoint start Date *</label>
                                    <input id="appoint_in" type="date"
                                           class="form-control @error('appoint_in') is-invalid @enderror"
                                           name="appoint_in" value="{{ ($sobanetry->appoint_in) ?? old('appoint_in') }}"
                                           autocomplete="appoint_in" autofocus>

                                    @error('appoint_in')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="appoint_out">Appoint End Date</label>
                                    <input id="appoint_out" type="date"
                                           class="form-control @error('appoint_out') is-invalid @enderror"
                                           name="appoint_out"
                                           value="{{ ($sobanetry->appoint_out) ?? old('appoint_out') }}"
                                           autocomplete="appoint_out" autofocus>

                                    @error('appoint_out')
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
                                               name="status" @isset($sobanetry) {{ $sobanetry->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($sobanetry)
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
    <script>
        $(document).ready(function () {
            $('.clubSelect').select2({
                placeholder: "Select Club",
                allowClear: true
            });
            $('.areaSelect').select2({
                placeholder: "Select Area",
                allowClear: true
            });
            $('.roleSelect').select2({
                placeholder: "Select Appointment",
                allowClear: true
            });
            $('.userSelect').select2({
                placeholder: "Select user",
                allowClear: true
            });
            function fetchUsers() {
                let clubId = $('#club').val();
                let areaId = $('#area').val();

                if (clubId && areaId) {
                    $.ajax({
                        url: "{{ route('app.get.user') }}", // Update with your route
                        type: "GET",
                        data: {
                            club_id: clubId,
                            area_id: areaId
                        },
                        success: function (response) {
                            let selectedUserId = "{{ isset($sobanetry) ? $sobanetry->user_id : '' }}";
                            $('#user_id').empty().append('<option></option>');
                            $.each(response.users, function (key, user) {
                                let displayName = user.name ? user.name : user.name_bn;
                                let isSelected = user.id == selectedUserId ? 'selected' : '';
                                $('#user_id').append(`<option value="${user.id}" ${isSelected}>${displayName}</option>`);
                            });
                        }
                    });
                }
            }

            $('#club, #area').change(fetchUsers);
        });
    </script>

@endpush
