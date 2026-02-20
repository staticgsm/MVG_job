@extends('layouts.frontend')

@section('title', 'Skilled, Unskilled & Semi-Skilled Manpower - MVG Jobs')

@section('content')
<!-- start page title -->
<section class="page-title-big-typography bg-dark-gray ipad-top-space-margin" data-parallax-background-ratio="0.5" style="background-image: url({{ asset('images/manpower.png') }})">
    <div class="opacity-extra-medium bg-dark-slate-blue"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center extra-small-screen">
            <div class="col-12 position-relative text-center page-title-extra-large">
                <h1 class="m-auto text-white text-shadow-double-large fw-500 ls-minus-3px xs-ls-minus-2px" data-anime='{ "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    Skilled, Unskilled &amp; Semi-Skilled Manpower</h1>
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
            <div class="col-lg-6 md-mb-40px">
                <figure class="position-relative m-0">
                    <img src="{{ asset('images/manpower.png') }}" alt="Skilled Manpower Services" class="w-100 border-radius-5px">
                    <figcaption class="w-190px sm-w-180px xs-w-140px bg-white p-30px xs-p-15px border-radius-6px position-absolute bottom-30px left-30px xs-bottom-20px xs-left-15px overflow-hidden box-shadow-medium animation-float text-center">
                        <span class="alt-font fs-90 xs-fs-80 fw-700 text-white d-block position-relative z-index-1">15</span>
                        <div class="alt-font fw-500 fs-20 xs-fs-18 d-block text-dark-gray lh-24 xs-lh-22 ls-minus-05px xs-mb-5px">Years of experience</div>
                        <div class="h-160px w-160px border-radius-100 bg-base-color position-absolute left-minus-5px xs-left-minus-25px top-minus-60px sm-top-minus-80px xs-top-minus-100px z-index-0"></div>
                    </figcaption>
                </figure>
            </div>
            <div class="col-xl-5 offset-xl-1 col-lg-6 col-md-10 text-center text-lg-start">
                <span class="bg-solitude-blue text-uppercase fs-13 ps-25px pe-25px alt-font fw-600 text-base-color lh-40 sm-lh-55 border-radius-100px d-inline-block mb-25px">Staffing &amp; Manpower</span>
                <h3 class="fw-600 text-dark-gray mb-20px ls-minus-2px alt-font">Reliable manpower for every industry need.</h3>
                <p class="w-95 md-w-100 mb-35px">We provide skilled, unskilled, and semi-skilled manpower across Manufacturing, Construction, Logistics, Hospitality, and Service sectors in Maharashtra. Our workforce is trained, verified, and deployed with speed and precision to meet your operational demands.</p>
                <div class="pt-20px pb-20px ps-30px pe-30px xs-p-15px border border-color-extra-medium-gray border-radius-6px mb-15px icon-with-text-style-08 w-90 lg-w-100">
                    <div class="feature-box feature-box-left-icon-middle d-inline-flex align-middle">
                        <div class="feature-box-icon me-10px">
                            <i class="bi bi-people icon-medium text-base-color"></i>
                        </div>
                        <div class="feature-box-content">
                            <span class="alt-font fw-600 text-dark-gray d-block lh-26">5,000+ workers deployed across Maharashtra.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->

<!-- start section -->
<section class="bg-solitude-blue">
    <div class="container">
        <div class="row row-cols-1 row-cols-lg-4 row-cols-sm-2 justify-content-center">
            <div class="col icon-with-text-style-04 transition-inner-all md-mb-30px">
                <div class="feature-box hover-box transition dark-hover bg-white border-radius-6px pt-17 pb-17 ps-14 pe-14 last-paragraph-no-margin box-shadow-quadruple-large box-shadow-hover overflow-hidden">
                    <div class="feature-box-icon">
                        <i class="ti-briefcase text-base-color icon-extra-large text-light-opacity mb-20px"></i>
                    </div>
                    <div class="feature-box-content">
                        <span class="d-inline-block alt-font text-dark-gray fw-500 fs-18 mb-5px">Skilled Workers</span>
                        <p class="text-light-opacity">Trained technicians and tradespeople for specialized roles.</p>
                    </div>
                    <div class="feature-box-overlay bg-base-color"></div>
                </div>
            </div>
            <div class="col icon-with-text-style-04 transition-inner-all md-mb-30px">
                <div class="feature-box hover-box transition dark-hover bg-white border-radius-6px pt-17 pb-17 ps-14 pe-14 last-paragraph-no-margin box-shadow-quadruple-large box-shadow-hover overflow-hidden">
                    <div class="feature-box-icon"><i class="bi bi-person text-base-color icon-extra-large text-light-opacity mb-20px"></i></div>
                    <div class="feature-box-content">
                        <span class="d-inline-block alt-font text-dark-gray fw-500 fs-18 mb-5px">Unskilled Labour</span>
                        <p class="text-light-opacity">General labour for warehouses, factories and construction.</p>
                    </div>
                    <div class="feature-box-overlay bg-base-color"></div>
                </div>
            </div>
            <div class="col icon-with-text-style-04 transition-inner-all xs-mb-30px">
                <div class="feature-box hover-box transition dark-hover bg-white border-radius-6px pt-17 pb-17 ps-14 pe-14 last-paragraph-no-margin box-shadow-quadruple-large box-shadow-hover overflow-hidden">
                    <div class="feature-box-icon"><i class="bi bi-gear text-base-color icon-extra-large text-light-opacity mb-20px"></i></div>
                    <div class="feature-box-content">
                        <span class="d-inline-block alt-font text-dark-gray fw-500 fs-18 mb-5px">Semi-Skilled</span>
                        <p class="text-light-opacity">Operators, helpers, and machine attendants for industry.</p>
                    </div>
                    <div class="feature-box-overlay bg-base-color"></div>
                </div>
            </div>
            <div class="col icon-with-text-style-04 transition-inner-all">
                <div class="feature-box hover-box transition dark-hover bg-white border-radius-6px pt-17 pb-17 ps-14 pe-14 last-paragraph-no-margin box-shadow-quadruple-large box-shadow-hover overflow-hidden">
                    <div class="feature-box-icon"><i class="bi bi-check-circle text-base-color icon-extra-large text-light-opacity mb-20px"></i></div>
                    <div class="feature-box-content">
                        <span class="d-inline-block alt-font text-dark-gray fw-500 fs-18 mb-5px">Compliant Hiring</span>
                        <p class="text-light-opacity">PF, ESIC, and labour law compliant workforce deployment.</p>
                    </div>
                    <div class="feature-box-overlay bg-base-color"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
@endsection
