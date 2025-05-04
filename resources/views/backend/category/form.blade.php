@extends('layouts.backend.app')
@push('css')
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-sitemap icon-gradient bg-mean-fruit"></i>
                </div>
                <div>{{ isset($category) ? 'Edit' : 'Create'}} Category</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.categories.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form action="{{ isset($category) ? route('app.categories.update', $category->id) : route('app.categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @isset($category)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name_bn">Name(Bangla) *</label>
                                    <input id="name_bn" type="text" class="form-control @error('name_bn') is-invalid @enderror" name="name_bn" value="{{ $category->name_bn ?? old('name_bn') }}" required autocomplete="name_bn" autofocus placeholder="ক্যাটাগরি নাম">

                                    @error('title_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    {{-- <label for="status">Status</label> --}}
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input @error('status') is-invalid @enderror" id="status" name="status" @isset($category) {{ $category->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($category)
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
