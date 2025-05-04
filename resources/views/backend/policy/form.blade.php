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
                <div>{{ isset($policy) ? 'Edit' : 'Create'}} Policy</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.policy.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form action="{{ isset($policy) ? route('app.policy.update', $policy->id) : route('app.policy.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @isset($policy)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="club">Club/Org *</label>
                                    <select id="club"
                                            class="form-control @error('club') is-invalid @enderror roleSelect"
                                            name="club" required autofocus>
                                        <option></option>
                                        @foreach ($clubs as $club)
                                            <option value="{{ $club->id}}" @isset($policy)
                                                {{($policy->club_id == $club->id) ? 'selected' : ''}}
                                                @endisset
                                            >{{ $club->name_bn}}</option>
                                        @endforeach
                                    </select>
                                    @error('club')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="Title">Title(Bangla)</label>
                                    <input id="title" type="text"
                                           class="form-control @error('title') is-invalid @enderror" name="title"
                                           value="{{ $policy->title ?? old('title') }}" required autocomplete="title"
                                           autofocus>

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="attachment">Attachment</label>
                                    <input id="attachment" type="file"
                                           class="dropify form-control @error('attachment') is-invalid @enderror"
                                           name="attachment" value="{{ $policy->attachment ?? old('attachment') }}"
                                           autocomplete="attachment" autofocus @isset($policy) data-default-file="{{asset('storage/policy/'.$policy->attachment)}}" @endisset>
                                    <span>The attachment must be a file of type: pdf, docx.</span>
                                    @error('attachment')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    {{-- <label for="status">Status</label> --}}
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                               class="custom-control-input @error('corected') is-invalid @enderror"
                                               id="corected"
                                               name="corected" @isset($policy) {{ $policy->corected==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="corected">Revised?</label>
                                    </div>
                                    @error('corected')
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
                                               name="status" @isset($policy) {{ $policy->status==true ? 'checked' : ''}} @endisset>
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
<script>
    $(document).ready(function() {
            $('.roleSelect').select2({
             placeholder: "Select Club",
             allowClear: true
        });
            $('.areaSelect').select2({
             placeholder: "Select Area",
             allowClear: true
        });
        });
</script>
@endpush
