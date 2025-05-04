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
                <div>Send SMS</div>
            </div>
            <div class="page-title-actions">
                {{--                <a href="{{ route('app.device.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">--}}
                {{--                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list--}}
                {{--                </a>--}}
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form method="POST" action="{{route('app.inPersonSms.send')}}">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="full-featured-non-premium">Message</label>
                                    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Enter Phone Number" value="{{ old('phone_number') }}">
                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="full-featured-non-premium">Message</label>
                                    <textarea id="summernote"
                                              class="form-control @error('message') is-invalid @enderror"
                                              name="message">{{ old('message') }}</textarea>
                                    @error('message')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-arrow-circle-up"></i>&nbsp;Send
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
        $(document).ready(function () {
            $('.clubSelect').select2({
                placeholder: "Select Club",
                allowClear: true
            });
            $('.areaSelect').select2({
                placeholder: "Select Area",
                allowClear: true
            });
        });
        $(document).ready(function () {
            $('#area_id').on('change', function () {
                var areaId = $(this).val();
                var eventDropdown = $('#event_id');
                const eventByAreaUrl = "{{ route('app.event.area', ['area' => '::area_id::']) }}";
                // Clear previous options
                eventDropdown.empty().append('<option value=""></option>');

                if (areaId) {
                    let finalUrl = eventByAreaUrl.replace('::area_id::', areaId);
                    $.ajax({
                        url:  finalUrl,
                        type: 'GET',
                        dataType: 'json',
                        success: function (data) {
                            $.each(data, function (key, event) {
                                eventDropdown.append('<option value="' + event.id + '">' + event.title_bn + '</option>');
                            });
                        },
                        error: function (xhr, status, error) {
                            console.error('Error loading events:', error);
                            alert('Failed to load events. Please try again.');
                        }
                    });
                }
            });
        });
    </script>
@endpush
