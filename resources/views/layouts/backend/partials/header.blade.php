<style>
    .logo-src {
        height: 50px;
        width: 50px;
        background: url(frontend/assets/images/logo.png)
    }

    .head-text {
        font-size: 16px;
        font-weight: bold;
        margin-left: 5px;
    }
</style>
<div class="app-header header-shadow">
    <div class="app-header__logo">
        <div class="head-text mt-2">
            {{--            <p>{{authuser()->club_name}} - {{authuser()->area_name}}</p>--}}
            <p>{{ optional(authuser())->club_name ?? 'N/A' }} - {{ optional(authuser())->area_name ?? 'N/A' }}</p>
        </div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                        data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
                <span>
                    <button type="button"
                            class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
    </div>
    <div class="app-header__content">
        <div class="app-header-left">
            <div class="search-wrapper">
                <div class="input-holder">
                    <input type="text" class="search-input" placeholder="Type to search">
                    <button class="search-icon"><span></span></button>
                </div>
                <button class="close"></button>
            </div>
            <ul class="header-menu nav">
                <li class="nav-item">
                    <a href="{{url('/')}}" class="nav-link" target="_blank">
                        <i class="nav-link-icon fa fa-database"> </i>
                        Visit site
                    </a>
                </li>

            </ul>
        </div>
        <div class="app-header-right">
            <div class="header-btn-lg pr-0">
                <div class="widget-content p-0">
                    <div class="widget-content-wrapper">
                        <div class="widget-content-left">
                            <div class="btn-group">
                                <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                    @if(!empty(image()->image))
                                        <img width="42" class="rounded-circle"
                                             src="{{asset('storage/users/'.image()->image)}}" alt="">
                                    @else
                                        <img width="42" class="rounded-circle"
                                             src="{{asset('assets/images/avatars/av.jpg')}}" alt="">
                                    @endif
                                    <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                </a>
                                <div tabindex="-1" role="menu" aria-hidden="true"
                                     class="dropdown-menu dropdown-menu-right">
                                    <a href="{{route('app.userprofile.index')}}" tabindex="0" class="dropdown-item"><i
                                            class="fas fa-users"></i>&nbsp;Profile</a>
                                    <a href="{{route('app.password.edit')}}" tabindex="0" class="dropdown-item"><i
                                            class="fas fa-unlock"></i>&nbsp;Change Password</a>
                                    <button type="button" tabindex="0" class="dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                            class="fas fa-sign-out-alt"></i>&nbsp;Logout
                                    </button>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="widget-content-left  ml-3 header-user-info">
                            <div class="widget-heading">
                                {{ Auth::user()->name }}
                            </div>
                            <div class="widget-subheading">
                                {{ Auth::user()->role->name }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
