    <header class="header axil-header header-style-1">
        <div class="axil-header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="header-top-dropdown">
                            {{--  <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    English
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">English</a></li>
                                    <li><a class="dropdown-item" href="#">Arabic</a></li>
                                    <li><a class="dropdown-item" href="#">Spanish</a></li>
                                </ul>
                            </div>
                            <div class="dropdown">
                                <button class="dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    USD
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">USD</a></li>
                                    <li><a class="dropdown-item" href="#">AUD</a></li>
                                    <li><a class="dropdown-item" href="#">EUR</a></li>
                                </ul>
                            </div>  --}}
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="header-top-link">
                            <ul class="quick-link mainmenu">
                                <li><a href="#"></a></li>
                                <li><a href="#"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Mainmenu Area  -->
        <div id="axil-sticky-placeholder"></div>
        <div class="axil-mainmenu">
            <div class="container">
                <div class="header-navbar">
                    <div class="header-brand">
                        <a href="{{ url('/') }}" class="logo logo-dark">
                            <img src="{{ asset('logo/logoAlfitri.png')}}" alt="Site Logo" style="height: 95px;">
                        </a>
                        <a href="{{ url('/') }}" class="logo logo-light">
                            <img src="{{ asset('logo/logoAlfitri.png')}}" alt="Site Logo" style="height: 95px;">
                        </a>
                    </div>
                    <div class="header-main-nav">
                        <!-- Start Mainmanu Nav -->
                        <nav class="mainmenu-nav">
                            <button class="mobile-close-btn mobile-nav-toggler"><i class="fas fa-times"></i></button>
                            <div class="mobile-nav-brand">
                                <a href="{{ url('/') }}" class="logo">
                                    <img src="{{ asset('logo/logoAlfitri.png')}}" alt="Site Logo" style="height: 70px;">
                                </a>
                            </div>
                            <ul class="mainmenu">
                                <li><a class="{{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">HOME</a></li>
                                <li><a class="{{ request()->is('shop') ? 'active' : '' }}" href="{{ url('/shop') }}">SHOP</a></li>
                                <li><a class="{{ request()->is('story') ? 'active' : '' }}" href="{{ url('/story') }}">STORY</a></li>
                                <li><a class="{{ request()->is('virtualOutlet') ? 'active' : '' }}" href="{{ url('/virtualOutlet') }}">VIRTUAL OUTLET</a></li>
                            </ul>
                        </nav>
                        <!-- End Mainmanu Nav -->
                    </div>
                    <div class="header-action">
                        <ul class="action-list">
                            <li class="axil-search">
                                <a href="javascript:void(0)" class="header-search-icon" title="Search">
                                    <i class="flaticon-magnifying-glass"></i>
                                </a>
                            </li>
                            {{-- <li class="wishlist">
                                <a class="{{ request()->is('/wishlist') ? 'active' : '' }}" href="{{ url('/wishlist') }}">
                                    <i class="flaticon-heart"></i>
                                </a>
                            </li> --}}
                            <li class="shopping-cart">
                                <a href="#" class="cart-dropdown-btn">
                                    <span class="cart-count">3</span>
                                    <i class="flaticon-shopping-cart"></i>
                                </a>
                            </li>
                            <li class="my-account">
                                <a href="javascript:void(0)">
                                    <i class="flaticon-person"></i>
                                </a>
                                <div class="my-account-dropdown">
                                    <span class="title">Hey, Sahabat Alfitri</span>
                                    <ul>
                                        <li>
                                            <a href="my-account.html">My Account</a>
                                        </li>
                                    </ul>
                                    <div class="login-btn">
                                        <a href="{{ route('login') }}" class="axil-btn btn-bg-primary">Login</a>
                                    </div>
                                    <div class="reg-footer text-center">No account yet? <a href="{{ route('register') }}" class="btn-link">REGISTER HERE.</a></div>
                                </div>
                            </li>
                            <li class="axil-mobile-toggle">
                                <button class="menu-btn mobile-nav-toggler">
                                    <i class="flaticon-menu-2"></i>
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Mainmenu Area -->
    </header>
