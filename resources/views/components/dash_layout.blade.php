<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('panel_assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('panel_assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('panel_assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('panel_assets/css/vertical-layout-light/cleaned-style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('panel_assets/images/favicon.png') }}" />
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,
        body {
            overflow-x: hidden;
            /* no side-scroll on body */
        }
    </style>
    @stack('custom-css')
</head>

<body>
    <div class="container-scroller">
        <div class="page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                        <a class="navbar-brand brand-logo mr-0 mt-2" href="{{ route('main') }}">
                            <img src="{{ asset('assets/img/logo2.png') }}" class="mr-0 mt-4"
                                style="width: 150px; height: 50px;" alt="logo" />
                        </a>
                        <a class="navbar-brand brand-logo-mini" href="{{ route('main') }}">
                            <img src="{{ asset('assets/img/favicon.png') }}" alt="logo" />
                        </a>
                    </div>
                    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                        <button class="navbar-toggler navbar-toggler align-self-center" type="button"
                            data-toggle="minimize">
                            <span class="icon-menu"></span>
                        </button>
                        <ul class="navbar-nav mr-lg-2">
                            <li class="nav-item nav-search d-none d-lg-block">
                                <div class="input-group">
                                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                                        <span class="input-group-text" id="search">
                                            <i class="icon-search"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="navbar-search-input"
                                        placeholder="Search now" aria-label="search" aria-describedby="search">
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-nav navbar-nav-right">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="feedbackDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false" data-bs-flip="false">
                                    <i class="icon-bell mx-0"></i>
                                    <span class="count"></span>
                                </a>
                            </li>
                            <li class="nav-item nav-settings d-none d-lg-flex">
                                <a class="nav-link" href="#">
                                    <i class="ti-solid ti-user"></i>
                                </a>
                            </li>
                        </ul>
                        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                            data-toggle="offcanvas">
                            <span class="icon-menu"></span>
                        </button>
                    </div>
                </nav>
                <!-- partial -->
                <div class="container-fluid page-body-wrapper">
                    <!-- partial:partials/_settings-panel.html -->
                    <div class="theme-setting-wrapper">
                        <div id="settings-trigger"><i class="ti-settings"></i></div>
                        <div id="theme-settings" class="settings-panel">
                            <i class="settings-close ti-close"></i>
                            <p class="settings-heading">SIDEBAR SKINS</p>
                            <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                                <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                            </div>
                            <div class="sidebar-bg-options" id="sidebar-dark-theme">
                                <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                            </div>
                            <p class="settings-heading mt-2">HEADER SKINS</p>
                            <div class="color-tiles mx-0 px-4">
                                <div class="tiles success"></div>
                                <div class="tiles warning"></div>
                                <div class="tiles danger"></div>
                                <div class="tiles info"></div>
                                <div class="tiles dark"></div>
                                <div class="tiles default"></div>
                            </div>
                        </div>
                    </div>
                    <!-- partial -->
                    <!-- partial:partials/_sidebar.html -->
                    <nav class="sidebar sidebar-offcanvas" style="height: auto" id="sidebar">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('dashboard') }}">
                                    <i class="icon-grid menu-icon"></i>
                                    <span class="menu-title">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('ProductsTable') }}">
                                    <i class="icon-grid menu-icon"></i>
                                    <span class="menu-title">Products</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('categories') }}">
                                    <i class="icon-grid menu-icon"></i>
                                    <span class="menu-title">Categories</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="collapse" href="#List" aria-expanded="false"
                                    {{-- aria-controls="feedback"> --}}>
                                    <i class="icon-head menu-icon"></i>
                                    <span class="menu-title">Feedback</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="collapse" id="List">
                                    <ul class="nav flex-column sub-menu">
                                        <li
                                            class="{{ Route::is('ReviewFeedback') && request('status') == null ? 'nav-item' : '' }}">
                                            <a class="nav-link" href="{{ route('ReviewFeedback') }}">New</a>
                                        </li>
                                        <li
                                            class="{{ Route::is('ReviewFeedback') && request('status') == 'Approaved' ? 'nav-item' : '' }}">
                                            <a class="nav-link"
                                                href="{{ route('ReviewFeedback', ['status' => 'Approaved']) }}">Approaved</a>
                                        </li>
                                        <li
                                            class="{{ Route::is('ReviewFeedback') && request('status') == 'Rejected' ? 'nav-item' : '' }}">
                                            <a class="nav-link"
                                                href="{{ route('ReviewFeedback', ['status' => 'Rejected']) }}">Rejected</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </nav>
                    <!-- partial -->
                    <div class="container-fluid py-4">
                        {{ $slot }}
                        <!-- Footer -->
                        {{-- <footer class="mt-5 border-top pt-3 text-center text-muted">
                            <p>&copy; 2021 Premium Dashboard by <a href="https://www.bootstrapdash.com/"
                                    target="_blank">BootstrapDash</a></p>
                            <p>Distributed by <a href="https://www.themewagon.com/" target="_blank">Themewagon</a></p>
                        </footer> --}}
                    </div>
                    <!-- main-panel ends -->
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- plugins:js -->
    <script src="{{ asset('panel_assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    @stack('custom-js')
    <!-- inject:js -->
    <script src="{{ asset('panel_assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('panel_assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('panel_assets/js/template.js') }}"></script>
    <script src="{{ asset('panel_assets/js/settings.js') }}"></script>
    <script src="{{ asset('panel_assets/js/todolist.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script> --}}
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
