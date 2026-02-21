<!doctype html>
<html class="no-js" lang="en">
<head>
    <title>@yield('title', 'MVGC Services Private Limited')</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="description" content="@yield('meta_description', 'MVGC Services Private Limited - Leading Facility Management and Manpower Service Provider.')">
    <!-- favicon icon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/apple-touch-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('images/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('images/apple-touch-icon-114x114.png') }}">
    <!-- google fonts preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- style sheets and font icons -->
    <link rel="stylesheet" href="{{ asset('css/vendors.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/icon.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}"/>
    @yield('extra_css')
</head>
<body data-mobile-nav-style="classic">
    <!-- start header -->
    <header>
        <!-- start navigation -->
        <nav class="navbar navbar-expand-lg header-transparent bg-transparent header-reverse" data-header-hover="light">
            <div class="container-fluid">
                <div class="col-auto col-xxl-3 col-lg-2 me-lg-0 me-auto">
                    <a class="navbar-brand" href="{{ route('frontend.home') }}">
                        <img src="{{ asset('images/MVG_logo_wh.png') }}" data-at2x="{{ asset('images/MVG_logo_wh.png') }}" alt="MVGC Logo" class="default-logo">
                        <img src="{{ asset('images/MVG_logo .png') }}" data-at2x="{{ asset('images/MVG_logo .png') }}" alt="MVGC Logo" class="alt-logo">
                        <img src="{{ asset('images/MVG_logo .png') }}" data-at2x="{{ asset('images/MVG_logo .png') }}" alt="MVGC Logo" class="mobile-logo">
                    </a>
                </div>
                <div class="col-auto menu-order position-static">
                    <button class="navbar-toggler float-start" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
                        <span class="navbar-toggler-line"></span>
                        <span class="navbar-toggler-line"></span>
                        <span class="navbar-toggler-line"></span>
                        <span class="navbar-toggler-line"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav alt-font">
                            <li class="nav-item"><a href="{{ route('frontend.home') }}" class="nav-link">Home</a></li>
                            <li class="nav-item"><a href="{{ route('frontend.about') }}" class="nav-link">About</a></li>
                            <li class="nav-item dropdown dropdown-with-icon-style02">
                                <a href="{{ route('frontend.services') }}" class="nav-link">Services</a>
                                <i class="fa-solid fa-angle-down dropdown-toggle" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false"></i>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                    <li><a href="{{ route('frontend.services.manpower') }}"><i class="bi bi-people"></i>Skilled &amp; Unskilled Manpower</a></li>
                                    <li><a href="{{ route('frontend.services.security') }}"><i class="bi bi-shield-check"></i>Security Services</a></li>
                                    <li><a href="{{ route('frontend.services.vehicle') }}"><i class="bi bi-truck"></i>Vehicle Rental Services</a></li>
                                    <li><a href="{{ route('frontend.services.catering') }}"><i class="bi bi-cup-hot"></i>Catering Services</a></li>
                                    <li><a href="{{ route('frontend.services.garden') }}"><i class="bi bi-flower1"></i>Garden Maintenance</a></li>
                                    <li><a href="{{ route('frontend.services.cleaning') }}"><i class="bi bi-droplet"></i>Deep Cleaning Services</a></li>
                                    <li><a href="{{ route('frontend.services.data') }}"><i class="bi bi-clipboard-data"></i>Data Entry Services</a></li>
                                    <li><a href="{{ route('frontend.services.hospital') }}"><i class="bi bi-hospital"></i>Hospital Specialized Staff</a></li>
                                    <li><a href="{{ route('frontend.services.civil') }}"><i class="bi bi-building"></i>Civil Engineering Manpower</a></li>
                                    <li><a href="{{ route('frontend.services.housekeeping') }}"><i class="bi bi-house-check"></i>Housekeeping Services</a></li>
                                    <li><a href="{{ route('frontend.services.civilwork') }}"><i class="bi bi-cone-striped"></i>Civil Works</a></li>
                                </ul>
                            </li>
                            <li class="nav-item"><a href="{{ route('frontend.contact') }}" class="nav-link">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-auto col-xxl-3 col-lg-2 text-end d-none d-sm-flex">
                    <div class="header-icon">
                        <div class="d-none d-xxl-inline-block me-25px xxl-me-10px">
                            <div class="alt-font fs-15 xl-fs-13 widget-text fw-500">
                                <span class="w-35px h-35px bg-base-color d-inline-block lh-36 me-10px border-radius-100px"><i class="feather icon-feather-phone me-10px"></i></span>
                                <a href="tel:+917720007466" class="widget-text text-white-hover">+91 7720007466</a>
                            </div>
                        </div>
                        <div class="header-button">
                            @guest
                                <a href="{{ route('login') }}" class="btn btn-very-small btn-transparent-white-light btn-rounded">Login</a>
                            @else
                                <a href="{{ route('home') }}" class="btn btn-very-small btn-transparent-white-light btn-rounded">Dashboard</a>
                            @endguest
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <!-- end navigation -->
    </header>
    <!-- end header -->

    @yield('content')

    <!-- start footer -->
    <footer class="pt-5 pb-5 sm-pt-40px sm-pb-45px footer-dark bg-extra-medium-slate-blue">
        <div class="container">
            <div class="row justify-content-center">
                <!-- start footer column -->
                <div class="col-lg-3 col-sm-6 last-paragraph-no-margin order-5 order-sm-4 order-lg-1 text-center text-sm-start">
                    <a href="{{ route('frontend.home') }}" class="footer-logo mb-15px d-block d-lg-inline-block">
                        <img src="{{ asset('images/MVG_logo_wh.png') }}" data-at2x="{{ asset('images/MVG_logo_wh.png') }}" alt="MVGC Logo">
                    </a>
                    <p class="w-90 sm-w-100 d-inline-block mb-15px">One of the leading Service Providers in Housekeeping and Facility Management Services all over Maharashtra and India.</p>
                    <p>&COPY; 2026 <a href="{{ route('frontend.home') }}" class="text-white text-decoration-line-bottom">MVGC Services Private Limited. All Rights Reserved.</a></p>
                </div>
                <!-- end footer column -->
                <!-- start footer column -->
                <div class="col-5 col-lg-2 col-sm-4 md-mb-50px sm-mb-30px order-1 order-lg-2">
                    <span class="alt-font d-block text-white mb-5px">Company</span>
                    <ul>
                        <li><a href="{{ route('frontend.about') }}">About us</a></li>
                        <li><a href="{{ route('frontend.services') }}">Our services</a></li>
                        <li><a href="{{ route('frontend.contact') }}">Contact</a></li>
                    </ul>
                </div>
                <!-- end footer column -->
                <!-- start footer column -->
                <div class="col-7 col-lg-2 col-sm-4 md-mb-50px sm-mb-30px order-2 order-lg-3">
                    <span class="alt-font d-block text-white mb-5px">Services</span>
                    <ul>
                        <li><a href="{{ route('frontend.services.manpower') }}">Manpower</a></li>
                        <li><a href="{{ route('frontend.services.security') }}">Security</a></li>
                        <li><a href="{{ route('frontend.services.cleaning') }}">Cleaning</a></li>
                        <li><a href="{{ route('frontend.services.housekeeping') }}">Housekeeping</a></li>
                    </ul>
                </div>
                <!-- end footer column -->
                <!-- start footer column -->
                <div class="col-5 col-lg-2 col-sm-4 md-mb-50px sm-mb-30px order-3 order-lg-4">
                    <span class="alt-font d-block text-white mb-5px">Social connect</span>
                    <ul>
                        <li><a href="https://www.facebook.com/" target="_blank">Facebook</a></li>
                        <li><a href="http://www.twitter.com" target="_blank">Twitter</a></li>
                        <li><a href="http://www.instagram.com" target="_blank">Instagram</a></li>
                        <li><a href="https://www.linkedin.com/" target="_blank">LinkedIn</a></li>
                    </ul>
                </div>
                <!-- end footer column -->
                <!-- start footer column -->
                <div class="col-7 col-lg-3 col-sm-6 xs-mb-30px last-paragraph-no-margin order-4 order-sm-5 order-lg-5">
                    <span class="alt-font d-block text-white mb-5px">Get in touch</span>
                    <p class="w-80 lg-w-100 md-w-70 sm-w-100 mb-10px">MVG Empire, 3rd floor, Sea-Wood Tower, Near Khatib Dairy, Old Gangapur Naka, Gangapur Road, Nashik-422013</p>
                    <div><i class="feather icon-feather-phone-call icon-very-small text-white me-10px"></i><a href="tel:+917720007466" class="text-white">+91 7720007466</a></div>
                    <div><i class="feather icon-feather-mail icon-very-small text-white me-10px"></i><a href="mailto:mvgcservicespvtltd@gmail.com" class="text-white text-decoration-line-bottom">mvgcservicespvtltd@gmail.com</a></div>
                </div>
                <!-- end footer column -->
            </div>
        </div>
    </footer>
    <!-- end footer -->

    <!-- start scroll progress -->
    <div class="scroll-progress d-none d-xxl-block">
        <a href="#" class="scroll-top" aria-label="scroll">
            <span class="scroll-text">Scroll</span><span class="scroll-line"><span class="scroll-point"></span></span>
        </a>
    </div>
    <!-- end scroll progress -->

    <!-- javascript libraries -->
    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/vendors.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js') }}"></script>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
    @yield('extra_js')
</body>
</html>
