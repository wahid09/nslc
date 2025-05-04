@extends('ladiesClub.layout.app')

@section('title', 'Update Profile')

@push('css')
    <style>
        /*.btn-file {*/
        /*    position: relative;*/
        /*    overflow: hidden;*/
        /*}*/

        /*.form-group {*/
        /*    padding: 30px;*/
        /*}*/

        /*.btn-file input[type=file] {*/
        /*    position: absolute;*/
        /*    top: 0;*/
        /*    right: 0;*/
        /*    min-width: 100%;*/
        /*    min-height: 100%;*/
        /*    font-size: 100px;*/
        /*    text-align: right;*/
        /*    filter: alpha(opacity=0);*/
        /*    opacity: 0;*/
        /*    outline: none;*/
        /*    background: white;*/
        /*    cursor: inherit;*/
        /*    display: block;*/
        /*}*/

        .input-group {
            margin-bottom: 30px;
        }

        #img-upload {
            width: 200px;
            height: 200px;
        }

        .as-console-wrapper {
            display: none !important;
        }
    </style>
@endpush

@section('main_menu', 'Notices')

@section('active_menu', 'Notices')

@section('link', '')

@section('content')
    <div class="row">
        <div class="col-12">
            <form
                action="{{route('app.member.updateProfile.picture.save')}}"
                method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="main-card mb-3 card">
                            <div class="card-header text-center">
{{--                                <b style="font-size: large">Husband's Information</b>--}}
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Upload Image</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            <span class="btn btn-default btn-file">
                                                <input type="file" id="imgInp" name="profile_image">
                                            </span>
                                        </span>
{{--                                        <input type="text" name="img" class="form-control" readonly>--}}
                                    </div>
                                    <img id='img-upload'/>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="card-footer float-right">
                    <button type="submit" class="btn btn-primary float-right">
                        <i class="fas fa-arrow-circle-up"></i>&nbsp;Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $(document).on('change', '.btn-file :file', function () {
                var input = $(this),
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [label]);
            });

            $('.btn-file :file').on('fileselect', function (event, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = label;

                if (input.length) {
                    input.val(log);
                } else {
                    //if (log) alert(log);
                }

            });

            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#img-upload').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp").change(function () {
                readURL(this);
            });
        });
    </script>
@endpush
