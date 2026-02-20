@extends('layouts.frontend')

@section('title', 'About Us - MVGC')

@section('content')
<!-- start page title -->
<section class="page-title-big-typography bg-dark-gray ipad-top-space-margin" data-parallax-background-ratio="0.5" style="background-image: url({{ asset('images/aboutbanner.png') }})">
    <div class="opacity-extra-medium bg-dark-slate-blue"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center extra-small-screen">
            <div class="col-12 position-relative text-center page-title-extra-large">
                <h1 class="m-auto text-white text-shadow-double-large fw-500 ls-minus-3px xs-ls-minus-2px" data-anime='{ "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>About - MVGC</h1>
            </div> 
            <div class="down-section text-center" data-anime='{ "translateY": [-15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <a href="#down-section" aria-label="scroll down" class="section-link">
                    <div class="d-flex justify-content-center align-items-center mx-auto rounded-circle fs-30 text-white">
                        <i class="feather icon-feather-chevron-down"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>
<!-- end page title -->
<!-- start section -->
<section id="down-section">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-5 col-md-10 position-relative z-index-1 md-mb-40px">
                <div class="atropos" data-atropos>
                    <div class="atropos-scale" data-anime='{ "translate": [0, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                        <div class="atropos-rotate">
                            <div class="atropos-inner">
                                <div data-atropos-offset="3">
                                    <img src="{{ asset('images/aboutteam.png') }}" class="border-radius-6px w-100" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="absolute-middle-right md-absolute-middle-center right-minus-45px md-right-auto d-inline-block text-center z-index-9">
                    <a href="https://www.youtube.com/embed/cfXHhfNy7tU" class="bg-white box-shadow-extra-large rounded-circle video-icon-box video-icon-extra-large popup-youtube d-inline-block" data-anime='{ "translate": [0, 0], "scale": [0,1], "duration": 1000, "delay": 300, "staggervalue": 300, "easing": "easeOutBack" }'>
                        <span>
                            <span class="video-icon bg-white">
                                <i class="fa-solid fa-play text-base-color"></i>
                                <span class="video-icon-sonar">
                                    <span class="video-icon-sonar-bfr bg-base-color opacity-9"></span>
                                </span>
                            </span>
                        </span>
                    </a>
                </div> -->
            </div>
            <div class="col-xl-5 col-lg-6 offset-lg-1 col-md-9 ps-6 text-center text-lg-start lg-ps-15px" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <span class="bg-solitude-blue text-uppercase fs-13 ps-25px pe-25px alt-font fw-600 text-base-color lh-40 sm-lh-55 border-radius-100px d-inline-block mb-25px">About company</span>
                <h3 class="fw-600 text-dark-gray ls-minus-2px alt-font sm-w-80 xs-w-100 mx-auto sm-mb-20px">Providing Reliable & Advanced Facility Management Solutions</h3>
                <p>MVGC Services Private Limited is a leading Facility Management and Manpower Service Provider established in 2018.</p> 
                <p>With a strong team of trained professionals and supervisors, we maintain the highest standards of safety, hygiene, and service excellence.</p>
                <a href="{{ route('frontend.services') }}" class="btn btn-large btn-dark-gray btn-box-shadow btn-rounded mt-15px sm-mt-10px">Our services<i class="fa-solid fa-arrow-right"></i></a>
            </div> 
        </div> 
    </div>
</section>
<!-- end section -->
@endsection
