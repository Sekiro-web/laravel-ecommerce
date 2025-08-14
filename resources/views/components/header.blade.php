    <!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->

    <!-- header -->
    <div class="top-header-area" id="sticker">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 text-center">
                    <div class="main-menu-wrap" style="height: ;">
                        <!-- logo -->
                        <div class="site-logo mb-5">
                            <a href="{{ route('main') }}">
                                <img src="{{ asset('assets/img/logo.png') }}" style="width: 150px; height: 50px;"
                                    alt="404">
                            </a>
                        </div>
                        <!-- logo -->
                        <!-- menu start -->
                        <nav class="main-menu">
                            <ul>
                                <li>
                                    <a href="{{ route('main') }}">Home</a>
                                </li>

                                <li>
                                    <a href="{{ route('about') }}">About</a>
                                </li>
                                {{-- <li>
                                    <a>News</a>
                                    <ul class="sub-menu">
                                        <li><a href="news.html">News</a></li>
                                        <li><a href="single-news.html">Single News</a></li>
                                    </ul>
                                </li> --}}

                                <li>
                                    <a href="{{ route('contact') }}">Contact</a>
                                </li>

                                <li>
                                    <a>Shop</a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('products') }}">products</a></li>
                                        <li><a href="{{ route('checkOut') }}">Check Out</a></li>
                                        <li><a href="{{ route('cart') }}">Cart</a></li>
                                    </ul>
                                </li>

                                @guest
                                    @if (Route::has('login'))
                                        <li>
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                        </li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li>
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li>
                                        <a>
                                            {{ Auth::user()->name }}
                                        </a>
                                        <ul class="sub-menu">
                                            @if (auth()->user()->adminOrOwner())
                                                <li>
                                                    <a href="{{ route('dashboard') }}">Admins panel</a>
                                                </li>
                                            @endif
                                            <li aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    class="d-none">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </li>
                                @endguest

                                <li>
                                    <div class="header-icons">
                                        <a class="shopping-cart" href="cart.html"><i
                                                class="fas fa-shopping-cart"></i></a>
                                        <a class="mobile-hide search-bar-icon"><i class="fas fa-search"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </nav>
                        <a class="mobile-show search-bar-icon"><i class="fas fa-search"></i></a>
                        <div class="mobile-menu"></div>
                        <!-- menu end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end header -->

    <!-- search area -->
    <div class="search-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <span class="close-btn"><i class="fas fa-window-close"></i></span>
                    <div class="search-bar">
                        <div class="search-bar-tablecell">
                            <form action="{{ route('products') }}" method="get">
                                @csrf
                                <h3>Search For:</h3>
                                <input type="text" name="search" placeholder="Product">
                                <button class="btn btn-success" type="submit">Search <i
                                        class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end search area -->
