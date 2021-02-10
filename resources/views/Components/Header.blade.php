<style>
    header {
        position: fixed !important;
        border-bottom: 1px solid #ddd;
    }
    .custom-profile {
        font-size: 16px;
        margin-top: 20px;
        cursor: pointer;
    }
    .custom-profile ul {
        background-color: #fff;
        position: fixed;
        top: 70px;right: 5%;
        top: -150%;
        border: 1px solid #ddd;
        border-radius: 6px;
        padding: 0px;
        width: 150px;
        text-align: left;
        transition: 0.4s;
    }
    .custom-profile:hover ul { top: 60px; }
    .custom-profile ul li {
        line-height: 45px;
        padding: 0px 25px;;
    }
    #customRegisterButton,
    .forMobile { display: none !important; }

    @media (max-width: 480px) {
        .forMobile { display: block !important; }
        #customRegisterButton {
            display: block;
            position: fixed;
            bottom: 0px;left: 0px;right: 0px;
            width: 100%;
            color: #fff;
            background-color: #f6506b;
            height: 45px;
            z-index: 5;
            font-weight: bold;
        }
        #qlwapp {
            top: 72% !important;
        }
    }
</style>
<header class="main-header header-style-one">
    <div class="header-upper">
        <div class="outer-container">
            <div class="clearfix">
                <div class="pull-left logo-box">
                    <div class="logo">
                        <a href="{{ route('user.index') }}" class="custom-logo-link" rel="home" aria-current="page"><img width="1009" height="235" src="{{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black.png" class="custom-logo" alt="Data Science Weekend" srcset="{{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black.png 1009w, {{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black-600x140.png 600w, {{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black-300x70.png 300w, {{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black-768x179.png 768w, {{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black-850x198.png 850w" sizes="(max-width: 1009px) 100vw, 1009px" /></a>
                    </div>
                </div>
                <div class="nav-outer clearfix">
                    <div class="mobile-nav-toggler"><span class="icon flaticon-menu"></span></div>
                    <nav class="main-menu navbar-expand-md">
                        <div class="navbar-header">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse scroll-nav clearfix" id="navbarSupportedContent">
                            <ul id="menu-header" class="navigation clearfix"><li id="menu-item-2943" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home page_item page-item-2085 current_page_item menu-item-2943"><a href="{{ route('user.index') }}" aria-current="page">Home</a></li>
                                <li id="menu-item-2620" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2620"><a href="#">DSW 2020</a>
                                    <ul class="sub-menu">
                                        <li id="menu-item-3082" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3082"><a href="{{ route('user.rundown') }}">Rundown</a></li>
                                        @foreach ($eventTypes as $type)
                                            <li class="menu-item menu-item-type-post_type menu-item-object-custom menu-item-has-children menu-item-3082">
                                                <a href="#">
                                                    {{ $type->name }} 
                                                </a>
                                                <ul class="sub-menu">
                                                    @foreach ($type->events as $event)
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page">
                                                            <a href="{{ route('user.event', $event->id) }}">
                                                                {{ $event->title }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li id="menu-item-2620" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2620"><a href="{{ route('user.ticket') }}">Tickets</a></li>
                                <li id="menu-item-2276" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2276"><a href="{{ route('user.contact') }}">Contact Us</a></li>
                                @if (Auth::guard('user')->check())
                                    <li id="menu-item-2276" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2276"><a href="{{ route('user.myTeam') }}">My Team</a></li>
                                    <li id="menu-item-2276" class="forMobile menu-item menu-item-type-post_type menu-item-object-page menu-item-2276"><a href="{{ route('user.profile') }}">Profile</a></li>
                                    <li id="menu-item-2276" class="forMobile menu-item menu-item-type-post_type menu-item-object-page menu-item-2276"><a href="{{ route('user.logout') }}">Logout</a></li>
                                @else
                                    <li id="menu-item-2276" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2276"><a href="{{ route('user.loginPage') }}">Login</a></li>
                                @endif
                            </ul>
                        </div>
                    </nav>
                    <div class="outer-box">
                        <div class="search-box-btn"><span class="icon flaticon-search"></span></div>
                        <div class="btn-box">
                            @if (!Auth::guard('user')->check())
                                <a href="{{ route('user.registerPage') }}" class="theme-btn btn-style-one mt-2">Register Now</a>
                            @else
                                <div class="custom-profile">
                                    <i class="fas fa-user mr-1"></i> {{ $myData->name }} <i class="ml-2 fas fa-angle-down"></i>
                                    <ul>
                                        <a href="{{ route('user.profile') }}">
                                            <li>Profile</li>
                                        </a>
                                        <a href="{{ route('user.myTicket') }}">
                                            <li>My Tickets</li>
                                        </a>
                                        <a href="{{ route('user.logout') }}">
                                            <li>Logout</li>
                                        </a>
                                    </ul>
                                </div>
                                <ul id="menu-header" class="navigation clearfix d-none">
                                    <li id="menu-item-2620" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2620"><a href="#">{{ $myData->name }}</a>
                                        <ul class="sub-menu">
                                            <li class="menu-item menu-item-type-post_type menu-item-object-custom menu-item-has-children menu-item-3082">
                                                <a href="#">Profile</a>
                                            </li>
                                            <li class="menu-item menu-item-type-post_type menu-item-object-custom menu-item-has-children menu-item-3082">
                                                <a href="#">Logout</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-menu">
        <div class="menu-backdrop"></div>
        <div class="close-btn"><span class="icon flaticon-cancel"></span></div>
        <nav class="menu-box">
            <div class="nav-logo">
                <a href="./index.html">
                    <img src="{{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black.png" alt="Logo">
                </a>
            </div>
            <ul class="navigation clearfix">
                <!--Keep This Empty / Menu will come through Javascript-->
            </ul>
        </nav>
    </div>
</header>

<a href="#">
    <button id="customRegisterButton">REGISTER NOW</button>
</a>
