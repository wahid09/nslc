@extends('layouts.backend.app')
@push('css')
    <link href="{{asset('assets/select/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/dropify/dropify.min.css')}}" rel="stylesheet">
    <style>
        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }

        .slide-photo {
            width: 320px;
            height: 100px;
        }
    </style>
@endpush

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="fas fa-calendar-plus icon-gradient bg-mean-fruit"></i>
                </div>
                <div>{{ isset($notice) ? 'Edit' : 'Create'}} Notice</div>
            </div>
            <div class="page-title-actions">
                <a href="{{ route('app.notices.index') }}" class="btn-shadow mr-3 btn btn-warning" name="button">
                    <i class="fas fa-arrow-left"></i>&nbsp;Back to list
                </a>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-12">
            <form action="{{ isset($notice) ? route('app.notices.update', $notice->id) : route('app.notices.store') }}"
                  method="POST" enctype="multipart/form-data">
                @csrf
                @isset($notice)
                    @method('PUT')
                @endisset
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-card mb-3 card">

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="title_bn">title(Bangla) *</label>
                                    <input id="title_bn" type="text"
                                           class="form-control @error('title_bn') is-invalid @enderror" name="title_bn"
                                           value="{{ $notice->title_bn ?? old('title_bn') }}" required
                                           autocomplete="title_bn" autofocus>

                                    @error('title_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="avatar">Attachment</label>
                                    <input id="avatar" type="file"
                                           class="dropify form-control @error('attachment') is-invalid @enderror"
                                           name="attachment" onchange="showImage(this, 'slider_photo')">

                                    @error('attachment')
                                    <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="full-featured-non-premium">Description</label>
                                    <textarea id="body"
                                              class="form-control @error('description_bn') is-invalid @enderror"
                                              name="description_bn">{{ $notice->description_bn ?? old('description_bn') }}</textarea>
                                    @error('description_bn')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="notice_date">Notice Date *</label>
                                    <input id="notice_date" type="date"
                                           class="form-control @error('notice_date') is-invalid @enderror"
                                           name="notice_date" value="" autocomplete="notice_date" autofocus>

                                    @error('notice_date')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    {{-- <label for="status">Status</label> --}}
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" id="isPrivate"
                                               class="custom-control-input @error('private') is-invalid @enderror"
                                               id="private"
                                               name="private" @isset($notice) {{ $notice->private==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="isPrivate">Private?</label>
                                    </div>
                                    @error('private')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    {{-- <label for="status">Status</label> --}}
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox"
                                               class="custom-control-input @error('is_footer') is-invalid @enderror"
                                               id="is_footer"
                                               name="is_footer" @isset($notice) {{ $notice->is_footer==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="is_footer">Is Footer ?</label>
                                    </div>
                                    @error('is_footer')
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
                                               name="status" @isset($notice) {{ $notice->status==true ? 'checked' : ''}} @endisset>
                                        <label class="custom-control-label" for="status">Status</label>
                                    </div>
                                    @error('status')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    @isset($notice)
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
    <script src="{{asset('assets/select/select2.min.js')}}"></script>
    <script src="{{asset('assets/dropify/dropify.min.js')}}"></script>
    <script src="{{asset('assets/tinymce/tinymce.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('.roleSelect').select2();
        });
        $('.dropify').dropify();
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
            $('.notice').hide();
            //$('.editnotice').hide();
            $('#isPrivate').change(function (e) {
                var data = $('#isPrivate').prop('checked');
                if (data == true) {
                    $('.notice').show();
                    $('.editnotice').show();
                } else {
                    $('.notice').hide();
                    $('.editnotice').hide();
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
    <script>
        tinymce.init({
            selector: '#body',
            plugins: 'print preview paste importcss searchreplace autolink directionality code visualblocks visualchars image link media codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
            imagetools_cors_hosts: ['picsum.photos'],
            toolbar: 'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | preview | insertfile image media link anchor codesample | ltr rtl',
            toolbar_sticky: true,
            image_advtab: true,
            content_css: '{{asset('assets/tinymce/codepen.min.css')}}',
            importcss_append: true,
            height: 400,
            image_caption: true,
            quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
            noneditable_noneditable_class: "mceNonEditable",
            toolbar_mode: 'sliding',
            contextmenu: "link image imagetools table",
        });
    </script>

@endpush
