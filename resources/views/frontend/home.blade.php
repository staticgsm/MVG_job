@extends('layouts.frontend')

@section('title', 'MVGC Services Private Limited - Home')

@section('content')
<!-- start section -->
<section class="section-dark p-0 bg-dark-gray"> 
    <div class="swiper lg-no-parallax magic-cursor  full-screen md-h-600px sm-h-500px ipad-top-space-margin swiper-light-pagination" data-slider-options='{ "slidesPerView": 1, "loop": true, "parallax": true, "speed": 1000, "pagination": { "el": ".swiper-pagination-bullets", "clickable": true }, "navigation": { "nextEl": ".slider-one-slide-next-1", "prevEl": ".slider-one-slide-prev-1" }, "autoplay": { "delay": 4000, "disableOnInteraction": false },  "keyboard": { "enabled": true, "onlyInViewport": true }, "effect": "slide" }'>
        <div class="swiper-wrapper">
            <!-- start slider item -->
            <div class="swiper-slide overflow-hidden">
                <div class="cover-background position-absolute top-0 start-0 w-100 h-100" data-swiper-parallax="500" style="background-image:url('{{ asset('images/slider1.png') }}');">
                    <div class="opacity-light bg-gradient-sherpa-blue-black"></div>
                    <div class="container h-100" data-swiper-parallax="-500">
                        <div class="row align-items-center h-100">
                            <div class="col-xl-7 col-lg-8 col-md-10 position-relative text-white text-center text-md-start" data-anime='{ "el": "childs", "translateX": [100, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                <div>
                                    <span class="fs-20 opacity-6 mb-25px sm-mb-15px d-inline-block fw-300">Best solutions for your business</span>
                                </div>
                                <h1 class="alt-font w-90 xl-w-100 text-shadow-double-large ls-minus-2px">Agency for your <span class="fw-600">great business.</span></h1>
                                <a href="{{ route('frontend.services') }}" class="btn btn-extra-large btn-rounded with-rounded btn-base-color btn-box-shadow box-shadow-extra-large mt-20px sm-mt-0">Get started now<span class="bg-white text-base-color"><i class="fas fa-arrow-right"></i></span></a>
                            </div>
                        </div>
                        <div class="position-absolute bottom-minus-45px" data-anime='{ "translateY": [150, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'><span class="alt-font number text-base-color opacity-3 fs-190 fw-600 ls-minus-5px">01</span></div>
                    </div>
                </div>
            </div>
            <!-- end slider item -->
            <!-- start slider item -->
            <div class="swiper-slide overflow-hidden">
                <div class="cover-background position-absolute top-0 start-0 w-100 h-100" data-swiper-parallax="500" style="background-image:url('{{ asset('images/slider2.png') }}');">
                    <div class="opacity-light bg-gradient-sherpa-blue-black"></div>
                    <div class="container h-100" data-swiper-parallax="-500">
                        <div class="row align-items-center h-100">
                            <div class="col-xl-7 col-lg-8 col-md-10 position-relative text-white text-center text-md-start" data-anime='{ "el": "childs", "translateX": [100, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'> 
                                <div>
                                    <span class="fs-20 opacity-6 mb-25px sm-mb-15px d-inline-block fw-300">Delivering beautiful digital products</span>
                                </div>
                                <h1 class="alt-font w-90 xl-w-100 text-shadow-double-large ls-minus-2px">Shape the future of<span class="fw-600"> marketing.</span></h1> 
                                <a href="{{ route('frontend.services') }}" class="btn btn-extra-large btn-rounded with-rounded btn-base-color btn-box-shadow box-shadow-extra-large mt-20px sm-mt-0">Get started now<span class="bg-white text-base-color"><i class="fa-solid fa-arrow-right"></i></span></a>
                            </div>
                            <div class="position-absolute bottom-minus-45px" data-anime='{ "translateY": [150, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'><span class="alt-font number text-base-color opacity-3 fs-190 fw-600 ls-minus-5px">02</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end slider item -->
            <!-- start slider item -->
            <div class="swiper-slide overflow-hidden">
                <div class="cover-background position-absolute top-0 start-0 w-100 h-100" data-swiper-parallax="500" style="background-image:url('{{ asset('images/slider3.png') }}');">
                    <div class="opacity-light bg-gradient-sherpa-blue-black"></div>
                    <div class="container h-100" data-swiper-parallax="-500">
                        <div class="row align-items-center h-100">
                            <div class="col-xl-7 col-lg-8 col-md-10 position-relative text-white text-center text-md-start" data-anime='{ "el": "childs", "translateX": [100, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                                <div>
                                    <span class="fs-20 opacity-6 mb-25px sm-mb-15px d-inline-block fw-300">Business strategies and top ideas</span>
                                </div>
                                <h1 class="alt-font w-90 xl-w-100 text-shadow-double-large ls-minus-2px">Provide solutions to <span class="fw-600">small business.</span></h1>
                                <a href="{{ route('frontend.services') }}" class="btn btn-extra-large btn-rounded with-rounded btn-base-color btn-box-shadow box-shadow-extra-large mt-20px sm-mt-0">Get started now<span class="bg-white text-base-color"><i class="fa-solid fa-arrow-right"></i></span></a>
                            </div>
                            <div class="position-absolute bottom-minus-45px" data-anime='{ "translateY": [150, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'><span class="alt-font number text-base-color opacity-3 fs-190 fw-600 ls-minus-5px">03</span></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end slider item -->
        </div>
        <!-- start slider pagination -->
        <div class="swiper-pagination swiper-pagination-clickable swiper-pagination-bullets"></div>
        <!-- end slider pagination -->
    </div>
</section>
<!-- end section -->

<!-- start section -->
<section class="border-bottom border-color-extra-medium-gray pt-40px pb-40px overflow-hidden">
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-4 row-cols-sm-2 justify-content-center align-items-center" data-anime='{ "el": "childs", "translateX": [-15, 0], "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 200, "easing": "easeOutQuad" }'>
            <!-- start features box item -->
            <div class="col icon-with-text-style-08 md-mb-30px text-center text-sm-start">
                <div class="feature-box feature-box-left-icon-middle d-inline-flex align-middle">
                    <div class="feature-box-icon me-10px">
                        <i class="bi bi-shield-check icon-very-medium text-base-color"></i>
                    </div>
                    <div class="feature-box-content">
                        <span class="alt-font fw-500 text-dark-gray d-block lh-26">World-class services</span>
                    </div>
                </div>
            </div>
            <!-- end features box item -->
            <!-- start features box item -->
            <div class="col icon-with-text-style-08 md-mb-30px text-center text-sm-start">
                <div class="feature-box feature-box-left-icon-middle d-inline-flex align-middle">
                    <div class="feature-box-icon me-10px">
                        <i class="bi bi-hourglass icon-very-medium text-base-color"></i>
                    </div>
                    <div class="feature-box-content">
                        <span class="alt-font fw-500 text-dark-gray d-block lh-26">ISO 9001:2008 Certified</span>
                    </div>
                </div>
            </div>
            <!-- end features box item -->
            <!-- start features box item -->
            <div class="col icon-with-text-style-08 xs-mb-30px text-center text-sm-start">
                <div class="feature-box feature-box-left-icon-middle d-inline-flex align-middle">
                    <div class="feature-box-icon me-10px">
                        <i class="bi bi-award icon-very-medium text-base-color"></i>
                    </div>
                    <div class="feature-box-content">
                        <span class="alt-font fw-500 text-dark-gray d-block lh-26">Skilled Manpower</span>
                    </div>
                </div>
            </div>
            <!-- end features box item -->
            <!-- start features box item -->
            <div class="col icon-with-text-style-08 text-center text-sm-start">
                <div class="feature-box feature-box-left-icon-middle d-inline-flex align-middle">
                    <div class="feature-box-icon me-10px">
                        <i class="bi bi-briefcase icon-very-medium text-base-color"></i>
                    </div>
                    <div class="feature-box-content">
                        <span class="alt-font fw-500 text-dark-gray d-block lh-26">Grow your business</span>
                    </div>
                </div>
            </div>
            <!-- end features box item -->
        </div>
    </div>
</section>
<!-- end section -->

<!-- start section -->
<section class="pb-8 md-pb-17 xs-pb-28">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-xl-5 col-lg-6 col-md-9 md-mb-50px text-center text-lg-start" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <span class="bg-solitude-blue text-uppercase fs-13 ps-25px pe-25px alt-font fw-600 text-base-color lh-40 sm-lh-55 border-radius-100px d-inline-block mb-25px">About business</span>
                <h3 class="alt-font text-dark-gray fw-600 ls-minus-1px mb-20px sm-w-85 xs-w-100 mx-auto">Smart and effective business solutions.</h3>
                <p>MVGC Services Private Limited was incorporated in 2018. We offer an array of Facility Management Services including Specialized Mechanized Housekeeping, Skilled and Unskilled Manpower, Security Services, and Vehicle Rental basis.</p>
                <div class="d-flex flex-row justify-content-center justify-content-lg-start align-items-center mt-35px">
                    <div class="w-120px me-25px flex-shrink-0">
                        <div class="chart-percent">
                            <span class="pie-chart-style-01 d-flex align-items-center justify-content-center text-center" data-line-width="7" data-percent="90" data-size="120" data-track-color="#ededed" data-start-color="#ef7f1a" data-end-color="#ef7f1a">
                                <span class="percent d-flex align-items-center justify-content-center alt-font fs-26 text-dark-gray fw-600 ls-minus-1px"></span>
                            </span>
                        </div>
                    </div>
                    <div class="text-start">
                        <span class="fs-20 lh-28 text-dark-gray alt-font fw-500 d-inline-block w-70 xs-w-100">Client Satisfaction (Transparent & convenient services) <span class="text-decoration-line-bottom-medium fw-600 text-base-color">last 2 years.</span></span>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 offset-xl-1 position-relative">
                <div class="text-end w-80 md-w-75 ms-auto" data-animation-delay="500" data-shadow-animation="true" data-bottom-top="transform: translateY(50px)" data-top-bottom="transform: translateY(-50px)">
                    <img src="{{ asset('images/homepage2.png') }}" alt="" class="border-radius-5px">
                </div>
                <div class="w-60 md-w-50 xs-w-55 overflow-hidden position-absolute left-15px bottom-minus-50px" data-shadow-animation="true" data-animation-delay="500" data-bottom-top="transform: translateY(-50px)" data-top-bottom="transform: translateY(50px)">
                    <img src="{{ asset('images/homepage1.png') }}" alt="" class="border-radius-5px box-shadow-quadruple-large" />
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->

<!-- start section -->
<section class="bg-solitude-blue">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-xl-7 col-lg-9 col-md-10 text-center">
                <h3 class="alt-font text-dark-gray fw-600 ls-minus-1px" data-anime='{ "translateY": [30, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>Professional and highly dedicated business services</h3>
            </div>
        </div>
        <div class="row align-items-center" data-anime='{ "el": "childs", "translateY": [0, 0], "opacity": [0,1], "duration": 1200, "delay": 150, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <div class="col-xl-3 col-lg-4 col-md-12 tab-style-05 md-mb-30px sm-mb-20px">
                <ul class="nav nav-tabs justify-content-center border-0 text-left fw-500 fs-18 alt-font">
                    <li class="nav-item"><a data-bs-toggle="tab" href="#tab_four1" class="nav-link d-flex align-items-center active"><i class="feather icon-feather-briefcase icon-extra-medium text-dark-gray"></i><span>Security Services</span></a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab_four2"><i class="feather icon-feather-edit icon-extra-medium text-dark-gray"></i><span>Vehicle Rent Basis</span></a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab_four3"><i class="feather icon-feather-compass icon-extra-medium text-dark-gray"></i><span>Catering Services</span></a></li>
                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#tab_four4"><i class="feather icon-feather-globe icon-extra-medium text-dark-gray"></i><span>Housekeeping & Manpower</span></a></li>
                </ul>
            </div>
            <div class="col-xl-9 col-lg-8 col-md-12">
                <div class="tab-content">
                    <div class="tab-pane fade in active show" id="tab_four1">
                        <div class="row align-items-center">
                            <div class="col-md-6 offset-xl-1 sm-mb-30px">
                                <img src="{{ asset('images/homepage3.png') }}" alt="" class="border-radius-6px w-100" />
                            </div>
                            <div class="col-xl-4 col-md-6 offset-xl-1 text-center text-md-start">
                                <span class="fs-18 fw-600 text-base-color mb-25px d-flex align-items-center justify-content-center justify-content-md-start"><span class="text-center w-60px h-60px d-flex justify-content-center align-items-center rounded-circle bg-white box-shadow-medium-bottom align-middle me-15px flex-shrink-0"><i class="feather icon-feather-briefcase fs-22"></i></span>Grow and succeed</span>
                                <h5 class="alt-font text-dark-gray mb-20px fw-500 ls-minus-1px"><span class="fw-600">Work together</span> to make experience</h5>
                                <p>We always want our client grow with the product we have delivered and maintaining strong long-term good relationship.</p>
                                <a href="{{ route('frontend.services.security') }}" class="btn btn-large btn-box-shadow btn-rounded btn-base-color mt-10px">Explore now</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_four2">
                        <div class="row align-items-center">
                            <div class="col-md-6 offset-xl-1 sm-mb-30px">
                                <img src="{{ asset('images/vehicle.png') }}" alt="" class="border-radius-6px w-100" />
                            </div>
                            <div class="col-xl-4 col-md-6 offset-xl-1 text-center text-md-start">
                                <span class="fs-18 fw-600 text-base-color mb-25px d-flex align-items-center justify-content-center justify-content-md-start"><span class="text-center w-60px h-60px d-flex justify-content-center align-items-center rounded-circle bg-white box-shadow-medium-bottom align-middle me-15px flex-shrink-0"><i class="feather icon-feather-edit fs-22"></i></span>Identity strategy</span>
                                <h5 class="alt-font text-dark-gray mb-20px fw-500 ls-minus-1px"><span class="fw-600">Help our clients</span> succeed by brand</h5>
                                <p>We always want our client grow with the product we have delivered and maintaining strong long-term good relationship.</p>
                                <a href="{{ route('frontend.services.vehicle') }}" class="btn btn-large btn-box-shadow btn-rounded btn-base-color mt-10px">Explore now</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_four3">
                        <div class="row align-items-center">
                            <div class="col-md-6 offset-xl-1 sm-mb-30px">
                                <img src="{{ asset('images/catering.png') }}" alt="" class="border-radius-6px w-100" />
                            </div>
                            <div class="col-xl-4 col-md-6 offset-xl-1 text-center text-md-start">
                                <span class="fs-18 fw-600 text-base-color mb-25px d-flex align-items-center justify-content-center justify-content-md-start"><span class="text-center w-60px h-60px d-flex justify-content-center align-items-center rounded-circle bg-white box-shadow-medium-bottom align-middle me-15px flex-shrink-0"><i class="feather icon-feather-compass fs-22"></i></span>Grow and succeed</span>
                                <h5 class="alt-font text-dark-gray mb-20px fw-500 ls-minus-1px"><span class="fw-600">Work together</span> to make experience.</h5>
                                <p>We always want our client grow with the product we have delivered and maintaining strong long-term good relationship.</p>
                                <a href="{{ route('frontend.services.catering') }}" class="btn btn-large btn-box-shadow btn-rounded btn-base-color mt-10px">Explore now</a>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab_four4">
                        <div class="row align-items-center">
                            <div class="col-md-6 offset-xl-1 sm-mb-30px">
                                <img src="{{ asset('images/housekeeping.png') }}" alt="" class="border-radius-6px w-100" />
                            </div>
                            <div class="col-xl-4 col-md-6 offset-xl-1 text-center text-md-start">
                                <span class="fs-18 fw-600 text-base-color mb-25px d-flex align-items-center justify-content-center justify-content-md-start"><span class="text-center w-60px h-60px d-flex justify-content-center align-items-center rounded-circle bg-white box-shadow-medium-bottom align-middle me-15px flex-shrink-0"><i class="feather icon-feather-globe fs-22"></i></span>Experience strategy</span>
                                <h5 class="alt-font text-dark-gray mb-20px fw-500 ls-minus-1px"><span class="fw-600">Help our clients</span> succeed by brand</h5>
                                <p>We always want our client grow with the product we have delivered and maintaining strong long-term good relationship.</p>
                                <a href="{{ route('frontend.services.housekeeping') }}" class="btn btn-large btn-box-shadow btn-rounded btn-base-color mt-10px">Explore now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- start section -->
<section class="pb-0" id="pricing">
    <div class="container">
        <div class="row align-items-center justify-content-center">                    
            <div class="col-xl-5 col-lg-6 md-mb-50px text-center text-lg-start" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <span class="bg-solitude-blue text-uppercase fs-13 ps-25px pe-25px alt-font fw-600 text-base-color lh-40 sm-lh-55 border-radius-100px d-inline-block mb-25px">Flexible pricing</span>
                <h3 class="alt-font text-dark-gray fw-600 ls-minus-1px">Tailored pricing plans for everyone.</h3>
                <p>We are excited for our work and how it positively impacts clients. With over 12 years of experience we have been constantly providing excellent solutions.</p>
                <a href="{{ route('frontend.contact') }}" class="btn btn-large btn-box-shadow btn-rounded btn-dark-gray mt-10px">Get a quote</a>
            </div>
            <div class="col-xl-5 col-lg-6 offset-xl-2 position-relative">
                <div class="accordion pricing-table-style-04" id="accordion-style-01" data-active-icon="fa-angle-up" data-inactive-icon="fa-angle-down" data-anime='{"el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <div class="accordion-item bg-white active-accordion box-shadow-quadruple-large mb-20px">
                        <div class="accordion-header">
                            <a href="#" data-bs-toggle="collapse" data-bs-target="#accordion-style-01-01" aria-expanded="true" data-bs-parent="#accordion-style-01"> 
                                <div class="accordion-title position-relative d-flex align-items-center pe-20px text-dark-gray fw-500 mb-0 alt-font">Basic plan<span class="icon-round bg-dark-gray text-white w-25px h-25px"><i class="fa-solid fa-angle-up"></i></span></div>
                            </a>
                        </div>
                        <div id="accordion-style-01-01" class="accordion-collapse collapse show" data-bs-parent="#accordion-style-01">
                            <div class="accordion-body last-paragraph-no-margin">
                                <p class="opacity-6 w-90 fw-300">Lorem ipsum dolor sit amet consectetur adipiscing elit sed do eiusmod.</p>
                                <div class="d-flex align-items-end mt-20px">
                                    <h5 class="text-white mb-0 ls-minus-1px"><span class="fs-16">$</span>19.99 <span class="fs-16 opacity-6 fw-300 ls-0px">/ Monthly</span></h5>
                                    <a href="{{ route('frontend.contact') }}" class="btn btn-transparent-white-light btn-rounded btn-small ms-auto fw-500 btn-box-shadow">Get started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- start section -->
<section class="overflow-hidden">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="border-radius-6px h-500px md-h-450px sm-h-350px d-flex align-items-end justify-content-center overflow-hidden cover-background skrollr-zoom pb-9 xs-pb-12" style="background-image: url('{{ asset('images/homepage4.png') }}')" data-bottom-top="transform:scale(1.2, 1.2) translateY(30px);" data-top-bottom="transform:scale(1, 1) translateY(-30px);">
                    <div class="opacity-medium bg-gradient-dark-transparent"></div>
                    <div class="row justify-content-center">
                        <div class="col-11 col-md-7 position-relative z-index-1 text-center text-lg-start md-mb-35px sm-mb-25px">
                            <h4 class="alt-font text-white mb-0 fw-300 fancy-text-style-4">We make the creative solutions for
                                <span class="fw-600" data-fancy-text='{ "effect": "rotate", "string": ["business!", "problems!", "brands!"] }'></span>
                            </h4> 
                        </div>
                        <div class="col-xl-5 col-lg-3 position-relative z-index-1 text-center animation-zoom">
                            <a href="https://www.youtube.com/embed/cfXHhfNy7tU" class="position-relative d-inline-block text-center border border-2 border-color-transparent-white-very-light rounded-circle video-icon-box video-icon-large popup-youtube">
                                <span>
                                    <span class="video-icon">
                                        <i class="bi bi-play-fill text-white"></i>
                                    </span>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- start section -->
<section class="bg-gradient-solitude-blue-transparent pt-0">
    <div class="container">
        <div class="row justify-content-center align-items-center" data-anime='{ "el": "childs", "translateX": [0, 0], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <div class="col-4 col-lg-2 col-sm-3 xs-mb-25px">
                <div class="swiper rounded-circle" data-slider-options='{ "slidesPerView": 1, "loop": true, "autoplay": { "delay": 1000, "disableOnInteraction": false },  "keyboard": { "enabled": true, "onlyInViewport": true }, "effect": "fade" }'>
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ asset('images/customer1.png') }}" alt=""/>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('images/customer2.png') }}" alt=""/>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('images/customer3.png') }}" alt=""/>
                        </div>
                        <div class="swiper-slide">
                            <img src="{{ asset('images/customer4.png') }}" alt=""/>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-xl-4 col-md-6 col-sm-7 text-center text-sm-start">
                <h5 class="alt-font text-dark-gray lh-40 fw-500 ls-minus-1px mb-0 ms-10px lg-ms-0" data-anime='{ "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 500, "staggervalue": 300, "easing": "easeOutQuad" }'>Trusted by <span class="fw-700 text-base-color">25,000+</span> happy customers.</h5>
            </div>
        </div>
    </div>
</section>
@endsection
