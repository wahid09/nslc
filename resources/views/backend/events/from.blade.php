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
                <div>{{ isset($event) ? 'Edit' : 'Create'}} Event</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.events.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form action="{{ isset($event) ? route('app.events.update', $event->id) : route('app.events.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @isset($event)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="title_bn">title(Bangla) *</label>
                                    <input id="title_bn" type="text" class="form-control @error('title_bn') is-invalid @enderror" name="title_bn" value="{{ $event->title_bn ?? old('title_bn') }}" required autocomplete="title_bn" autofocus>

                                    @error('title_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                @if(!empty($event->image))
                                    <div class="form-group row">
                                        <label for="photo" class=""></label>
                                        <div class="col-sm-8">
                                            <img src="{{ url('storage/events/'.$event->image) }}" class="slide-photo" id="slider_photo">
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group">
                                    <label for="avatar">Image</label>
                                    <input id="avatar" type="file" class="dropify form-control @error('image') is-invalid @enderror" name="image">
                                    <span>Image size will be: 368 X 305</span>
                                    @error('image')
                                    <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="event_date">Event Date *</label>
                                    <input id="event_date" type="date" class="form-control @error('event_date') is-invalid @enderror" name="event_date" value="{{ ($event->event_date) ?? old('event_date') }}" autocomplete="event_date" autofocus>

                                    @error('event_date')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="start_date">Event Start Time *</label>
                                    <input id="start_date" type="time" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ $event->start_time ?? old('start_time') }}" autocomplete="start_time" autofocus>

                                    @error('start_date')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="end_date">Event End Time *</label>
                                    <input id="end_date" type="time" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ $event->end_time ?? old('end_time') }}" autocomplete="end_time" autofocus>

                                    @error('end_date')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="full-featured-non-premium">Description</label>
                                    <textarea id="full-featured-non-premium" class="form-control @error('description_bn') is-invalid @enderror" name="description_bn">{{ $event->description_bn ?? old('description_bn') }}</textarea>
                                    @error('description_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{-- <label for="status">Status</label> --}}
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" id="status" name="status" @isset($event) {{ $event->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($event)
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
    <script src="{{asset('assets/select/select2.min.js')}}"></script>
    <script src="{{asset('assets/dropify/dropify.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('.roleSelect').select2();
        });
        $('.dropify').dropify();
    </script>

    <script type="text/javascript">
        //Image Show Before Upload Start
        $(document).ready(function(){
            $('input[type="file"]').change(function(e){
                var fileName = e.target.files[0].name;
                if (fileName){
                    $('#fileLabel').html(fileName);
                }
            });
        });
        function showImage(data, imgId){
            if(data.files && data.files[0]){
                var obj = new FileReader();
                obj.onload = function(d){
                    var image = document.getElementById(imgId);
                    image.src = d.target.result;
                }
                obj.readAsDataURL(data.files[0]);
            }
        }
        //Image Show Before Upload End
    </script>

@endpush
