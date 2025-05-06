<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
{{--    <meta http-equiv="Content-Security-Policy" content="script-src 'self' 'nonce-abc123' cdn.datatables.net cdnjs.cloudflare.com code.jquery.com stackpath.bootstrapcdn.com;">--}}

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('main.css') }}" rel="stylesheet">
{{--    <link href="{{ asset('admin.css') }}" rel="stylesheet">--}}
{{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
    <link href="{{asset('assets/dropify/dropify.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/select/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/summernote/summernote-bs4.min.css')}}" rel="stylesheet">
    <link href="{{asset('DataTables/datatables.min.css')}}" rel="stylesheet">
    <style>
        .vertical-nav-menu ul > li > a {
            color: #6c757d;
            height: 2rem;
            line-height: 2rem;
            padding: 0 1.5rem 0;
            text-transform: lowercase;
            font-size: 16px;
        }

        .vertical-nav-menu ul > li > a:first-letter {
            text-transform: uppercase;
        }

        .scrollbar-sidebar {
            overflow-y: scroll;
            height: auto;
        }

        .dropify-wrapper .dropify-message p {
            font-size: initial;
        }

        .slide-photo {
            width: 320px;
            height: 100px;
        }

        .ck-editor__editable {
            min-height: 200px;
        }
        .flex-wrap {
            flex-wrap: wrap !important;
            float: left;
        }
        .dt-search{
            flex-wrap: wrap !important;
            float: right;
        }
        div.dt-container div.dt-info {
            white-space: nowrap;
            float: left;
        }
        div.dt-container div.dt-paging {
            margin: 0;
            float: right;
        }

    </style>
    @stack('css')
    {{--    <meta http-equiv="Content-Security-Policy"--}}
    {{--          content="script-src 'self' cdn.datatables.net cdnjs.cloudflare.com code.jquery.com stackpath.bootstrapcdn.com 'unsafe-inline';">--}}
        <?php //header('X-Frame-Options: DENY'); ?>
</head>
<body>
<div id="app">
    <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
        @include('layouts.backend.partials.header')
        <div class="app-main">
            @include('layouts.backend.partials.sidebar')
            <div class="app-main__outer">
                <div class="app-main__inner">
                    @yield('content')
                </div>
                @include('layouts.backend.partials.footer')
            </div>
            {{--            <script src="http://maps.google.com/maps/api/js?sensor=true"></script>--}}
        </div>
    </div>
</div>

<!-- Scripts -->
{{--<script src="{{ asset('assets/scripts/main.js') }}"></script>--}}
{{--<script src="{{ asset('admin.js') }}"></script>--}}
<!-- jQuery (must come first) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>--}}
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="https://code.jquery.com/ui/1.14.1/jquery-ui.min.js"></script>
{{--<script src="{{ asset('js/app.js') }}"></script>--}}
<script src="{{ asset('js/iziToast.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
{{--<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>--}}
{{--<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>--}}
{{--<script src="{{asset('backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>--}}
{{--<script src="{{asset('backend/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>--}}
{{--<script src="{{asset('backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>--}}
{{--<script src="{{asset('backend/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>--}}
{{--<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>--}}

{{--<script src="{{asset('backend/plugins/jszip/jszip.min.js')}}"></script>--}}
{{--<script src="{{asset('backend/plugins/pdfmake/pdfmake.min.js')}}"></script>--}}
{{--<script src="{{asset('backend/plugins/pdfmake/vfs_fonts.js')}}"></script>--}}
{{--<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>--}}
{{--<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>--}}
{{--<script src="{{asset('backend/plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>--}}
<script src="{{asset('DataTables/datatables.min.js')}}"></script>
<script src="{{asset('assets/select/select2.min.js')}}"></script>
<script src="{{asset('assets/dropify/dropify.min.js')}}"></script>
{{--<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>--}}
<script src="{{asset('assets/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('editor/tinymc.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#summernote').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
            tabsize: 2,
            height: 200,
            fontSizeUnits: ['px', 'pt'],
            lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0']
        });

        $('#summernote_short').summernote({
            toolbar: [
                // [groupName, [list of button]]
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ],
            tabsize: 2,
            height: 200,
            fontSizeUnits: ['px', 'pt'],
            lineHeights: ['0.2', '0.3', '0.4', '0.5', '0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '2.0', '3.0']
        });
    });
    $('.dropify').dropify();
    $('#dataTable').DataTable();
</script>
@stack('js')
@include('vendor.lara-izitoast.toast')
</body>
</html>
