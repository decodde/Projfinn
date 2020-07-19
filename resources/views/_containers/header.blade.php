<header class="main-header bg-white opacity-09 h-88" data-react-to-megamenu="true" data-sticky-header="true" data-sticky-options='{ "stickyTrigger": "first-section" }'>

            <div class="mainbar-wrap">

                <span class="megamenu-hover-bg"></span>

                <div class="container-fluid mainbar-container">
                    <div class="mainbar">
                        <div class="row mainbar-row align-items-lg-stretch px-4">

                            <div class="col ">

                                <div class="navbar-header py-2">
                                    <a class="navbar-brand p-2" href="{{URL('/')}}" rel="home">
                                            <span class="navbar-brand-inner">
                                                <img class="logo-dark" src="{{ asset('assets/app-assets/images/adobe/logo.png') }}" width="120" alt="Projfinn">
                                                <img class="logo-sticky" src="{{ asset('assets/app-assets/images/adobe/logo.png') }}" width="120" alt="Projfinn">
                                                <img class="mobile-logo-default" src="{{ asset('assets/app-assets/images/adobe/logo.png') }}" width="120" alt="Projfinn">
                                                <img class="logo-default" src="{{ asset('assets/app-assets/images/adobe/logo.png') }}" width="100" alt="Projfinn">
                                            </span>
                                    </a>
                                    <button type="button" class="navbar-toggle collapsed nav-trigger style-mobile" data-toggle="collapse" data-target="#main-header-collapse" aria-expanded="false" data-changeclassnames='{ "html": "mobile-nav-activated overflow-hidden" }'>
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="bars">
                                                <span class="bar"></span>
                                                <span class="bar"></span>
                                                <span class="bar"></span>
                                            </span>
                                    </button>
                                </div><!-- /.navbar-header -->
                                <!-- /#main-header-collapse -->

                            </div><!-- /.col -->

                            <div class="col text-center">
                                <div class="collapse navbar-collapse" id="main-header-collapse">

                                    <ul id="primary-nav" class="main-nav nav nav-right align-items-lg-stretch justify-content-lg-center" data-submenu-options='{ "toggleType":"fade", "handler":"mouse-in-out" }'>

                                        <li>
                                            <a href="{{URL('/invest')}}">
                                                <span class="link-icon"></span>
                                                <span class="link-txt btn-underlined">
                                                        <span class="link-ext"></span>
                                                        <span class="txt">
                                                            How it works
                                                        </span>
                                                    </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{URL('/faq')}}">
                                                <span class="link-icon"></span>
                                                <span class="link-txt btn-underlined">
                                                        <span class="link-ext"></span>
                                                        <span class="txt">
                                                            FAQ
                                                            <span class="submenu-expander">
                                                            </span>
                                                        </span>
                                                    </span>
                                            </a>
                                        </li>

                                        <li class="menu-item-has-children megamenu megamenu-fullwidth">
                                            <a href="https://suppotr.owoafara.com/">
                                                <span class="link-icon"></span>
                                                <span class="link-txt btn-underlined">
                                                        <span class="link-ext"></span>
                                                        <span class="txt">
                                                            Business Support
                                                        </span>
                                                    </span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{URL('/contact')}}">
                                                <span class="link-icon"></span>
                                                <span class="link-txt btn-underlined">
                                                    <span class="link-ext"></span>
                                                    <span class="txt">
                                                        Contact Us
                                                    </span>
                                                </span>
                                            </a>
                                        </li>

                                    </ul>

                                </div>
                            </div>
                            @if(auth()->check())
                                <div class="col text-right">

                                    <div class="header-module">
                                        @if(auth()->user()->type === "investor")
                                            <a href="{{URL('/dashboard/i')}}" class="btn btn-default btn-sm round border-thin btn-register py-0">
                                        @elseif(auth()->user()->type === "admin")
                                            <a href="{{URL('/admin/rouzz')}}" class="btn btn-default btn-sm round border-thin btn-register py-0">
                                        @elseif(auth()->user()->type === "introducer")
                                            <a href="{{URL('/dashboard/e')}}" class="btn btn-default btn-sm round border-thin btn-register py-0">
                                        @else
                                            <a href="{{URL('/dashboard')}}" class="btn btn-default btn-sm round border-thin btn-register py-0">
                                        @endif

                                                <span>
                                                <span class="btn-txt">Go To Dashboard</span>
                                            </span>
                                        </a>

                                    </div><!-- /.header-module -->

                                </div><!-- /.col -->
                            @else
                                <div class="col text-right">

                                    <div class="header-module">

                                        <a href="{{URL('/login')}}" class="btn btn-underlined border-thin btn-bordered-gradient">
                                            <span>
                                                <span class="btn-txt">Login</span>
                                            </span>
                                        </a>

                                    </div><!-- /.header-module -->

                                    <div class="header-module">

                                        <a href="{{URL('/sign-up')}}" class="btn btn-default btn-sm round border-thin btn-register">
                                            <span>
                                                <span class="btn-txt">Sign up</span>
                                            </span>
                                        </a>

                                    </div><!-- /.header-module -->

                                </div><!-- /.col -->
                            @endif

                        </div><!-- /.mainbar-row -->
                    </div><!-- /.mainbar -->
                </div><!-- /.mainbar-container -->
            </div><!-- /.mainbar-wrap -->

        </header><!-- /.main-header -->
