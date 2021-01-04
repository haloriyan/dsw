<header class="main-header header-style-one">
    <div class="header-upper">
        <div class="outer-container">
            <div class="clearfix">
                <div class="pull-left logo-box">
                    <div class="logo">
                        <a href="./index.html" class="custom-logo-link" rel="home" aria-current="page"><img width="1009" height="235" src="{{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black.png" class="custom-logo" alt="Data Science Weekend" srcset="{{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black.png 1009w, {{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black-600x140.png 600w, {{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black-300x70.png 300w, {{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black-768x179.png 768w, {{ env('APP_URL') }}/wp-content/uploads/2020/10/cropped-DSW-logo-black-850x198.png 850w" sizes="(max-width: 1009px) 100vw, 1009px" /></a>
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
                            <ul id="menu-header" class="navigation clearfix"><li id="menu-item-2943" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home page_item page-item-2085 current_page_item menu-item-2943"><a href="./index.html" aria-current="page">Home</a></li>
                                <li id="menu-item-2620" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-2620"><a href="#">DSW 2020</a>
                                    <ul class="sub-menu">
                                        {{-- <li id="menu-item-3082" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-3082"><a href="./rundown-data-science-weekend/index.html">Rundown</a></li> --}}
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
                                <li id="menu-item-2276" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-2276"><a href="{{ route('user.contact') }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </nav>
                    <div class="outer-box">
                        <div class="search-box-btn"><span class="icon flaticon-search"></span></div>
                        <div class="btn-box">
                            <a href="./events/data-science-weekend-2020/index.html" class="theme-btn btn-style-one">Register Now</a>
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