<header class="main-nav" id="nav-clr">
    <div class="sidebar-user text-center"><a class="setting-primary" href="{{ route('app.member.change_password') }}"><i
                data-feather="settings" class="text-white"></i></a><img class="img-90 rounded-circle" src="{{ isset($member) ? asset('storage/memberImage/' . $member->image) : asset('assets/ladiesclub/backend/images/default-image.png') }}"
                                                                        alt="">
        <div class="badge-bottom"><span class="badge badge-primary">{{ isset($member) ? $member->name : 'No Name' }}</span></div>

        <p class="mb-0 font-roboto text-white f-s-italic">Army Ladies Club</p>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                                                              aria-hidden="true"></i></div>
                    </li>

                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="text-white">Ladies Club Member</h6>
                        </div>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{ route('app.member.dashboard') }}">
                            <i data-feather="home" class="text-white"></i>
                            <span class="text-white">Dashboard</span>
                        </a>
                    </li>

                    {{-- <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{ url('user/user-ssl-payment/' . Auth::id()) }}">
                            <i data-feather="home" class="text-white"></i>
                            <span class="text-white">SSL Payment</span>
                        </a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{ url('user/user-tap-payment/' . Auth::id()) }}">
                            <i data-feather="home" class="text-white"></i>
                            <span class="text-white">TAP Payment</span>
                        </a>
                    </li> --}}

                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{ route('app.member.profile') }}">
                            <i data-feather="user" class="text-white"></i>
                            <span class="text-white">Profile</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{ route('app.member.event') }}">
                            <i data-feather="sunset" class="text-white"></i>
                            <span class="text-white">Event</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{route('app.member.notice')}}">
                            <i data-feather="bell" class="text-white"></i>
                            <span class="text-white">Notice</span>
                        </a>
                    </li>

{{--                    <li class="dropdown">--}}
{{--                        <a class="nav-link menu-title link-nav" href="{{route('app.member.gallery')}}">--}}
{{--                            <i data-feather="home" class="text-white"></i>--}}
{{--                            <span class="text-white">Gallery</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{route('app.member.payment')}}">
                            <i data-feather="dollar-sign" class="text-white"></i>
                            <span class="text-white">Bills Management</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{route('app.member.updateProfile')}}">
                            <i data-feather="user-plus" class="text-white"></i>
                            <span class="text-white">Update Profile</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{route('app.member.updateProfile.picture')}}">
                            <i data-feather="image" class="text-white"></i>
                            <span class="text-white">Update Profile Picture</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{route('app.update.signature')}}">
                            <i data-feather="check-circle" class="text-white"></i>
                            <span class="text-white">Update Signature</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{route('app.member.change_password')}}">
                            <i data-feather="eye-off" class="text-white"></i>
                            <span class="text-white">Change Password</span>
                        </a>
                    </li>

                    {{-- <li class="dropdown">
                        <a class="nav-link menu-title link-nav" href="{{ url('user/user-feedback/' . Auth::id()) }}">
                            <i data-feather="home" class="text-white"></i>
                            <span class="text-white">Feedback</span>
                        </a>
                    </li> --}}

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>
