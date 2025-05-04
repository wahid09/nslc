<footer class="footer" id="ftr-clr">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 footer-copyright">
                <p class="mb-0 text-white">
                    {{ __('Copyright © ' . date('Y') . ' | All Rights Reserved by Army Ladies Club') }}
                </p>
            </div>
            <div class="col-md-6">
                <p class="pull-right mb-0 text-white">Powered By | <a href="" target="_blank"
                                                                      class="text-white">ITDTE, AHQ GS Br</a>
                </p>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<script src="{{ asset('assets/ladiesclub/backend/js/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('assets/ladiesclub/backend/js/icons/feather-icon/feather.min.js') }}"></script>
<script src="{{ asset('assets/ladiesclub/backend/js/icons/feather-icon/feather-icon.js') }} "
        crossorigin="anonymous"></script>
<script src="{{ asset('assets/ladiesclub/backend/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('assets/ladiesclub/backend/js/config.js') }}"></script>
<script src="{{ asset('assets/ladiesclub/backend/js/bootstrap/popper.min.js') }}"></script>
<script src="{{ asset('assets/ladiesclub/backend/js/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/ladiesclub/backend/js/script.js') }}"></script>
<script src="{{ asset('assets/ladiesclub/backend/js/toastr.min.js') }}"></script>
<script src="{{asset('frontend/assets/js/jquery.fancybox.min.js')}}"></script>
{{--{!! Toastr::message() !!}--}}
{{--<script nonce="{{ csp_nonce() }}">--}}
<script>
    $(document).ready(function () {
        $('#summernote').summernote({
            tabsize: 2,
            height: 100
        });
    });
    @if ($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error('{{ $error }}', 'Error', {
        closeButton: true,
        progressBar: true,
    });
    @endforeach
        @endif
        console.log = function () {
    };
</script>
@stack('js')
</body>

</html>
