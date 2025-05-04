<div class="page-main-header">
    <div class="main-header-right row m-0" id="hd-clr">
        <div class="main-header-left">
            <div class="logo-wrapper">
                <a href="">
                    <img class="img-fluid" id="img1" src="{{ asset('assets/ladiesclub/backend/images/logo/logo.PNG') }}"
                         alt="">
                </a>
            </div>
            <div class="dark-logo-wrapper">
                {{--                <a href="{{ url('user/user-profile/' . Auth::id()) }}">--}}
                {{--                    <img id="img1" class="img-fluid" src="{{ asset('assets/backend/images/logo/logo.PNG') }}"--}}
                {{--                         alt="">--}}
                {{--                </a>--}}
            </div>
            <div class="toggle-sidebar"><i class="status_toggle middle text-white" data-feather="align-center"
                                           id="sidebar-toggle"></i></div>
        </div>
        <div class="left-menu-header col">
            <ul>
                <li>
                    <h3 class="text-white" id="stl_1">Army Ladies Club</h3>
                </li>
            </ul>
        </div>
        <div class="nav-right col pull-right right-menu p-0">
            <ul class="nav-menus">
                <li class="onhover-dropdown p-0">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-light">
                            <i data-feather="log-out"></i> Log out
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <div class="d-lg-none pull-right w-auto text-white">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf

                <button type="submit" class="btn btn-iconsolid btn-light">
                    <i data-feather="log-out"></i>
                </button>
            </form>
        </div>
        {{-- <div class="d-lg-none mobile-toggle pull-right w-auto text-white"><i data-feather="more-horizontal"></i></div> --}}
    </div>
</div>
