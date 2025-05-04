<style>
    img.bb100 {
    position: fixed;
    right: 10px;
    width: 70px;
    margin-top: 9px;
}
</style>
<header class="">
    <!-- Navigation -->
    <nav class="primary-menu navbar navbar-expand-lg static-top animated fadeIn">
        <div class="container">
            <a class="navbar-brand" href="{{url('/')}}">
                @if(!empty($footer->logo))
                    <img src="{{asset('storage/logo/'.$footer->logo)}}" style="height: 80px; width: 83px;">
                @else
                <img src="{{asset('frontend/assets/images/logo.png')}}">
                @endif
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                মেন্যু
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a href="{{url('/')}}" class="nav-link {{ Request::is('/*') ? 'active' : ''}}">হোম</a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ url('about-us') }}" class="nav-link {{ Request::is('about-us*') ? 'active' : ''}}">আমাদের সম্পর্কে </a>--}}
{{--                    </li>--}}

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">বানী ও নোটিশ</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{url('bani')}}">বানী</a>
                            <a class="dropdown-item" href="{{url('notice')}}">নোটিশ/পত্র</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('about-us') }}" class="nav-link {{ Request::is('about-us*') ? 'active' : ''}}">আমাদের সম্পর্কে </a>
                    </li>
{{--                    <li class="nav-item dropdown">--}}
{{--                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">নীতিমালা</a>--}}
{{--                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">--}}
{{--                            @isset($file)--}}
{{--                            @foreach($file as $item)--}}
{{--                                @if($item->club_id == 1)--}}
{{--                                        <a class="dropdown-item" href="{{url('sapoxpdf/'.$item->attachment)}}">সেপকস</a>--}}
{{--                                    @elseif($item->club_id == 2)--}}
{{--                                        <a class="dropdown-item" href="{{url('ladiesclubpdf/'.$item->attachment)}}">লেডিস ক্লাব</a>--}}
{{--                                    @elseif($item->club_id == 3)--}}
{{--                                        $url = url('childrenclub/'.$item->attachment);--}}
{{--                                        <a class="dropdown-item" href="{{url('childrenclubpdf/'.$item->attachment)}}">চিলড্রেন ক্লাব</a>--}}
{{--                                    @endif--}}
{{--                                @endforeach--}}
{{--                                    @endisset--}}
{{--                        </div>--}}
{{--                    </li>--}}
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="{{url('sapox')}}">সেপকস </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($area as $item)
                            <a class="dropdown-item" href="{{url('details-sapox/'.$item->id)}}">{{$item->name_bn}}</a>
                            @endforeach
                        </div>
                    </li>

{{--                    <li class="nav-item">--}}
{{--                        <a href="{{url('sapox')}}" class="nav-link {{ Request::is('sapox*') ? 'active' : ''}}">সেপকস </a>--}}
{{--                    </li>--}}
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="{{url('ladies-club')}}">লেডিস ক্লাব </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($area as $item)
                                <a class="dropdown-item" href="{{url('details-ladiesclub/'.$item->id)}}">{{$item->name_bn}}</a>
                            @endforeach
                        </div>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{url('ladies-club')}}" class="nav-link {{ Request::is('ladies-club*') ? 'active' : ''}}">লেডিস ক্লাব </a>--}}
{{--                    </li>--}}
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="{{url('home-childrenclub')}}">চিলড্রেন ক্লাব </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($area as $item)
                                <a class="dropdown-item" href="{{url('details-childrenclub/'.$item->id)}}">{{$item->name_bn}}</a>
                            @endforeach
                        </div>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ url('policy') }}" class="nav-link {{ Request::is('policy*') ? 'active' : ''}}">নীতিমালা</a>
                    </li> --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle">নীতিমালা </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('policy') }}">নীতিমালা</a>
                            <a class="dropdown-item" href="{{ url('corected-policy') }}">সংশোধিত নীতিমালা</a>

                        </div>
                    </li>



                    <li class="nav-item">
                        <a href="{{ url('publication') }}" class="nav-link {{ Request::is('publication*') ? 'active' : ''}}">প্রকাশনী</a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{url('home-childrenclub')}}" class="nav-link">চিলড্রেন ক্লাব </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="{{ url('/our-products') }}" class="nav-link {{ Request::is('our-products*') ? 'active' : ''}}">আমাদের পণ্য </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="" class="nav-link">প্রজেক্টস </a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link search" href="{{route('app.dashboard')}}"><i class="fa fa-user"></i></a>--}}
{{--                    </li>--}}

                    @auth
                    <li class="nav-item dropdown">
                        {{-- <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i></a> --}}

                        <a class="nav-link " href=""><i class="fa fa-user-circle-o"></i>&nbsp;@if(!empty(Auth::user()->name_bn)){{Auth::user()->name_bn}} @else {{Auth::user()->username}} @endif
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @auth
                            @permission('access-dashboard')
                            <a class="dropdown-item" href="{{route('app.dashboard')}}">ড্যাশবোর্ড</a>
                            @endpermission
{{--                            @if(Auth::user()->role_id == 4)--}}
                            <a class="dropdown-item" href="{{url('user-profile')}}">প্রোফাইল</a>
{{--                                @endif--}}

                            <button type="button" tabindex="0" class="dropdown-item" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>&nbsp;লগআউট</button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            @endauth
                        </div>
                    </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link " href="{{url('login')}}"><i class="fa fa-sign-in"></i> লগিন
                            </a>
                        </li>
                    @endauth
                </ul>

            </div>
{{--            <img class="bb100" src="{{asset('frontend/assets/images/bb100.png')}}">--}}
        </div>
    </nav>
    <div class="clearhead"></div>

</header>

