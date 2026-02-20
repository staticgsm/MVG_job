@extends('layouts.frontend')

@section('title', 'Deep Cleaning Services - MVG Jobs')

@section('content')
<!-- start page title -->
<section class="page-title-big-typography bg-dark-gray ipad-top-space-margin" data-parallax-background-ratio="0.5" style="background-image: url({{ asset('images/cleaning.png') }})">
    <div class="opacity-extra-medium bg-dark-slate-blue"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center extra-small-screen">
            <div class="col-12 position-relative text-center page-title-extra-large">
                <h1 class="m-auto text-white text-shadow-double-large fw-500 ls-minus-3px xs-ls-minus-2px" data-anime='{ "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    Deep Cleaning Services</h1>
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
                    <img src="{{ asset('images/cleaning.png') }}" alt="Deep Cleaning Services" class="w-100 border-radius-5px">
                    <figcaption class="w-190px sm-w-180px xs-w-140px bg-white p-30px xs-p-15px border-radius-6px position-absolute bottom-30px left-30px xs-bottom-20px xs-left-15px overflow-hidden box-shadow-medium animation-float text-center">
                        <span class="alt-font fs-90 xs-fs-80 fw-700 text-white d-block position-relative z-index-1">15</span>
                        <div class="alt-font fw-500 fs-20 xs-fs-18 d-block text-dark-gray lh-24 xs-lh-22 ls-minus-05px">Years of experience</div>
                        <div class="h-160px w-160px border-radius-100 bg-base-color position-absolute left-minus-5px xs-left-minus-25px top-minus-60px sm-top-minus-80px xs-top-minus-100px z-index-0"></div>
                    </figcaption>
                </figure>
            </div>
            <div class="col-xl-5 offset-xl-1 col-lg-6 col-md-10 text-center text-lg-start">
                <span class="bg-solitude-blue text-uppercase fs-13 ps-25px pe-25px alt-font fw-600 text-base-color lh-40 sm-lh-55 border-radius-100px d-inline-block mb-25px">Sanitation & Hygiene</span>
                <h3 class="fw-600 text-dark-gray mb-20px ls-minus-2px alt-font">Advanced deep cleaning for superior hygiene standards.</h3>
                <p class="w-95 md-w-100 mb-35px">We deliver advanced mechanized deep cleaning solutions for corporate offices, hospitals, factories, and residential complexes. Our trained cleaning staff use eco-friendly chemicals and modern equipment to ensure the highest hygiene standards.</p>
                <div class="pt-20px pb-20px ps-30px pe-30px xs-p-15px border border-color-extra-medium-gray border-radius-6px mb-15px icon-with-text-style-08 w-90 lg-w-100">
                    <div class="feature-box feature-box-left-icon-middle d-inline-flex align-middle">
                        <div class="feature-box-icon me-10px">
                            <i class="bi bi-droplet icon-medium text-base-color"></i>
                        </div>
                        <div class="feature-box-content">
                            <span class="alt-font fw-600 text-dark-gray d-block lh-26">Floor-to-ceiling deep cleaning.</span>
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
                        <i class="ti-spray text-base-color icon-extra-large text-light-opacity mb-20px"></i>
                    </div>
                    <div class="feature-box-content">
                        <span class="d-inline-block alt-font text-dark-gray fw-500 fs-18 mb-5px">Disinfection</span>
                        <p class="text-light-opacity">Hospital-grade disinfection.</p>
                    </div>
                    <div class="feature-box-overlay bg-base-color"></div>
                </div>
            </div>
            <div class="col icon-with-text-style-04 transition-inner-all md-mb-30px">
                <div class="feature-box hover-box transition dark-hover bg-white border-radius-6px pt-17 pb-17 ps-14 pe-14 last-paragraph-no-margin box-shadow-quadruple-large box-shadow-hover overflow-hidden">
                    <div class="feature-box-icon">
                        <i class="ti-time text-base-color icon-extra-large text-light-opacity mb-20px"></i>
                    </div>
                    <div class="feature-box-content">
                        <span class="d-inline-block alt-font text-dark-gray fw-500 fs-18 mb-5px">Flexible Hours</span>
                        <p class="text-light-opacity">Off-hours cleaning available.</p>
                    </div>
                    <div class="feature-box-overlay bg-base-color"></div>
                </div>
            </div>
            <div class="col icon-with-text-style-04 transition-inner-all xs-mb-30px">
                <div class="feature-box hover-box transition dark-hover bg-white border-radius-6px pt-17 pb-17 ps-14 pe-14 last-paragraph-no-margin box-shadow-quadruple-large box-shadow-hover overflow-hidden">
                    <div class="feature-box-icon">
                        <i class="ti-check-box text-base-color icon-extra-large text-light-opacity mb-20px"></i>
                    </div>
                    <div class="feature-box-content">
                        <span class="d-inline-block alt-font text-dark-gray fw-500 fs-18 mb-5px">Modern Equipment</span>
                        <p class="text-light-opacity">Mechanized scrubbing and jets.</p>
                    </div>
                    <div class="feature-box-overlay bg-base-color"></div>
                </div>
            </div>
            <div class="col icon-with-text-style-04 transition-inner-all">
                <div class="feature-box hover-box transition dark-hover bg-white border-radius-6px pt-17 pb-17 ps-14 pe-14 last-paragraph-no-margin box-shadow-quadruple-large box-shadow-hover overflow-hidden">
                    <div class="feature-box-icon">
                        <i class="ti-shield text-base-color icon-extra-large text-light-opacity mb-20px"></i>
                    </div>
                    <div class="feature-box-content">
                        <span class="d-inline-block alt-font text-dark-gray fw-500 fs-18 mb-5px">Safe & Green</span>
                        <p class="text-light-opacity">Eco-friendly cleaning agents.</p>
                    </div>
                    <div class="feature-box-overlay bg-base-color"></div>
                </div>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-lg-3 row-cols-sm-2 align-items-center justify-content-center mt-6 xs-mt-8">
            <div class="col border-end xs-border-end-0 border-color-transparent-dark-very-light md-mb-35px">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="flex-shrink-0 me-25px sm-me-15px">
                        <h2 class="mb-0 text-dark-gray fw-700 ls-minus-2px">4.98</h2>
                    </div>
                    <div class="text-dark-gray">
                        <div class="fs-14 lh-28">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <span class="fs-17 lh-26 d-block fw-500">Client rating</span>
                    </div>
                </div>
            </div>
            <div class="col border-end md-border-end-0 border-color-transparent-dark-very-light md-mb-35px">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="flex-shrink-0 me-25px sm-me-15px">
                        <h2 class="mb-0 text-dark-gray fw-700 ls-minus-2px">99<sup class="fs-30">%</sup></h2>
                    </div>
                    <div class="text-dark-gray">
                        <span class="fs-17 lh-26 d-block fw-500">Client satisfaction <br />rate achieved.</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex align-items-center justify-content-center">
                    <div class="flex-shrink-0 me-25px sm-me-15px">
                        <h2 class="mb-0 text-dark-gray fw-700 ls-minus-2px">500<sup class="fs-30">+</sup></h2>
                    </div>
                    <div class="text-dark-gray">
                        <span class="fs-17 lh-26 d-block fw-500">Deep cleaning projects completed.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->

<!-- start section -->
<section>
    <div class="container">
        <div class="row align-items-center justify-content-center mb-7 sm-mb-40px">
            <div class="col-xl-5 col-lg-6 col-md-10 md-mb-50px">
                <span class="bg-solitude-blue text-uppercase fs-13 ps-25px pe-25px alt-font fw-600 text-base-color lh-40 sm-lh-55 border-radius-100px d-inline-block mb-25px">Services benefits</span>
                <h3 class="fw-600 text-dark-gray ls-minus-2px alt-font">Benefits of our Deep Cleaning Services.</h3>
                <div class="icon-with-text-style-08 mb-10px">
                    <div class="feature-box feature-box-left-icon-middle overflow-hidden">
                        <div class="feature-box-icon feature-box-icon-rounded w-35px h-35px bg-solitude-blue rounded-circle me-10px">
                            <i class="fa-solid fa-check fs-14 text-base-color"></i>
                        </div>
                        <div class="feature-box-content">
                            <span class="text-dark-gray">500+ deep cleaning projects completed across Maharashtra.</span>
                        </div>
                    </div>
                </div>
                <div class="icon-with-text-style-08 mb-10px">
                    <div class="feature-box feature-box-left-icon-middle overflow-hidden">
                        <div class="feature-box-icon feature-box-icon-rounded w-35px h-35px bg-solitude-blue rounded-circle me-10px">
                            <i class="fa-solid fa-check fs-14 text-base-color"></i>
                        </div>
                        <div class="feature-box-content">
                            <span class="text-dark-gray">Mechanized cleaning using advanced equipment.</span>
                        </div>
                    </div>
                </div>
                <div class="icon-with-text-style-08">
                    <div class="feature-box feature-box-left-icon-middle overflow-hidden">
                        <div class="feature-box-icon feature-box-icon-rounded w-35px h-35px bg-solitude-blue rounded-circle me-10px">
                            <i class="fa-solid fa-check fs-14 text-base-color"></i>
                        </div>
                        <div class="feature-box-content">
                            <span class="text-dark-gray">Eco-friendly, non-toxic cleaning chemicals used.</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 offset-xl-1 position-relative z-index-1">
                <div class="atropos" data-atropos data-atropos-perspective="2450">
                    <div class="atropos-scale">
                        <div class="atropos-rotate">
                            <div class="atropos-inner">
                                <img src="{{ asset('images/cleaning.png') }}" alt="Deep Cleaning Services" class="border-radius-6px" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center mt-8 sm-mt-40px">
            <div class="col-12">
                <div class="bg-solitude-blue p-9 md-p-6 xs-p-9 border-radius-6px overflow-hidden position-relative">
                    <div class="bg-base-color d-inline-block mb-20px fw-600 text-white text-uppercase border-radius-30px ps-20px pe-20px fs-12">Basic information</div>
                    <h3 class="alt-font fw-600 text-dark-gray ls-minus-1px">Frequently asked questions</h3>
                    <div class="accordion accordion-style-02" id="accordion-cleaning" data-active-icon="icon-feather-minus" data-inactive-icon="icon-feather-plus">
                        <div class="accordion-item active-accordion">
                            <div class="accordion-header border-bottom border-color-transparent-dark-very-light">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#acc-cleaning-01" aria-expanded="true" data-bs-parent="#accordion-cleaning" aria-label="accordion">
                                    <div class="accordion-title mb-0 position-relative text-dark-gray pe-30px">
                                        <i class="feather icon-feather-minus fs-20"></i><span class="fw-500">What areas do you cover for deep cleaning?</span>
                                    </div>
                                </a>
                            </div>
                            <div id="acc-cleaning-01" class="accordion-collapse collapse show" data-bs-parent="#accordion-cleaning">
                                <div class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent-dark-very-light">
                                    <p class="w-90 sm-w-95 xs-w-100">We provide deep cleaning for offices, factories, hospitals, hotels, warehouses, residential apartments, and construction sites covering all surfaces, floors, glass, and HVAC systems.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header border-bottom border-color-transparent-dark-very-light">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#acc-cleaning-02" aria-expanded="false" data-bs-parent="#accordion-cleaning" aria-label="accordion">
                                    <div class="accordion-title mb-0 position-relative text-dark-gray pe-30px">
                                        <i class="feather icon-feather-plus fs-20"></i><span class="fw-500">What chemicals and equipment do you use?</span>
                                    </div>
                                </a>
                            </div>
                            <div id="acc-cleaning-02" class="accordion-collapse collapse" data-bs-parent="#accordion-cleaning">
                                <div class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent-dark-very-light">
                                    <p class="w-90 sm-w-95 xs-w-100">We use FSSAI and BIS-approved, eco-friendly cleaning agents along with industrial-grade mechanized scrubbers, high-pressure jets, steam cleaners, and HEPA vacuums.</p>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <div class="accordion-header border-bottom border-color-transparent">
                                <a href="#" data-bs-toggle="collapse" data-bs-target="#acc-cleaning-03" aria-expanded="false" data-bs-parent="#accordion-cleaning" aria-label="accordion">
                                    <div class="accordion-title mb-0 position-relative text-dark-gray pe-30px">
                                        <i class="feather icon-feather-plus fs-20"></i><span class="fw-500">How long does a deep cleaning session take?</span>
                                    </div>
                                </a>
                            </div>
                            <div id="acc-cleaning-03" class="accordion-collapse collapse" data-bs-parent="#accordion-cleaning">
                                <div class="accordion-body last-paragraph-no-margin border-bottom border-color-transparent">
                                    <p class="w-90 sm-w-95 xs-w-100">Duration depends on the area size and condition. Typically, a 5,000 sq ft office takes 6-8 hours. We provide an estimate after a free site inspection.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->

<!-- start section -->
<section class="py-0">
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-xl-7 col-lg-9 col-md-10 text-center">
                <h3 class="alt-font text-dark-gray fw-600 ls-minus-1px">Other business services</h3>
            </div>
        </div>
        <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 justify-content-center">
            <div class="col">
                <div class="box-shadow-quadruple-large services-box-style-01 hover-box md-mb-30px border-radius-5px overflow-hidden">
                    <div class="position-relative box-image">
                        <img src="{{ asset('images/security.png') }}" alt="Security Services">
                        <div class="box-overlay bg-dark-gray"></div>
                        <a href="{{ route('frontend.services.security') }}" class="d-flex justify-content-center align-items-center mx-auto icon-box absolute-middle-center z-index-1 w-60px h-60px rounded-circle box-shadow-quadruple-large border border-2 border-color-white"><i class="feather icon-feather-arrow-right text-white icon-extra-medium"></i></a>
                    </div>
                    <div class="p-10 bg-white last-paragraph-no-margin text-center">
                        <a href="{{ route('frontend.services.security') }}" class="d-inline-block fs-18 alt-font fw-500 text-dark-gray mb-5px">Security Services</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="box-shadow-quadruple-large services-box-style-01 hover-box md-mb-30px border-radius-5px overflow-hidden">
                    <div class="position-relative box-image">
                        <img src="{{ asset('images/garden.png') }}" alt="Garden Maintenance">
                        <div class="box-overlay bg-dark-gray"></div>
                        <a href="{{ route('frontend.services.garden') }}" class="d-flex justify-content-center align-items-center mx-auto icon-box absolute-middle-center z-index-1 w-60px h-60px rounded-circle box-shadow-quadruple-large border border-2 border-color-white"><i class="feather icon-feather-arrow-right text-white icon-extra-medium"></i></a>
                    </div>
                    <div class="p-10 bg-white last-paragraph-no-margin text-center">
                        <a href="{{ route('frontend.services.garden') }}" class="d-inline-block fs-18 alt-font fw-500 text-dark-gray mb-5px">Garden Maintenance</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="box-shadow-quadruple-large services-box-style-01 hover-box border-radius-5px overflow-hidden">
                    <div class="position-relative box-image">
                        <img src="{{ asset('images/housekeeping.png') }}" alt="Housekeeping Services">
                        <div class="box-overlay bg-dark-gray"></div>
                        <a href="{{ route('frontend.services.housekeeping') }}" class="d-flex justify-content-center align-items-center mx-auto icon-box absolute-middle-center z-index-1 w-60px h-60px rounded-circle box-shadow-quadruple-large border border-2 border-color-white"><i class="feather icon-feather-arrow-right text-white icon-extra-medium"></i></a>
                    </div>
                    <div class="p-10 bg-white last-paragraph-no-margin text-center">
                        <a href="{{ route('frontend.services.housekeeping') }}" class="d-inline-block fs-18 alt-font fw-500 text-dark-gray mb-5px">Housekeeping Services</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->

<!-- start section -->
<section class="half-section">
    <div class="container">
        <div class="row align-items-center text-center text-md-start">
            <div class="col sm-mb-20px">
                <h4 class="alt-font text-dark-gray fw-600 ls-minus-2px m-0">Get a free consultation for Deep Cleaning Services?</h4>
            </div>
            <div class="col-12 col-md-auto">
                <a href="{{ route('frontend.contact') }}" class="btn btn-large btn-dark-gray btn-box-shadow btn-rounded left-icon"><i class="feather icon-feather-mail"></i>Free consultation</a>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
@endsection
