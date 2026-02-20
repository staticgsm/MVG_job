@extends('layouts.frontend')

@section('title', 'Our Services - MVGC')

@section('content')
<!-- start page title -->
<section class="page-title-big-typography bg-dark-gray ipad-top-space-margin" data-parallax-background-ratio="0.5" style="background-image: url({{ asset('images/servicebanner.png') }})">
    <div class="opacity-extra-medium bg-dark-slate-blue"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center extra-small-screen">
            <div class="col-12 position-relative text-center page-title-extra-large">
                <h1 class="m-auto text-white text-shadow-double-large fw-500 ls-minus-3px xs-ls-minus-2px" data-anime='{ "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>Our Services</h1>
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
        <div class="row row-cols-1 row-cols-lg-3 row-cols-md-2 justify-content-center" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
            <!-- 1 -->
            <div class="col">
                <div class="box-shadow-quadruple-large services-box-style-01 hover-box mb-30px border-radius-5px overflow-hidden">
                    <div class="position-relative box-image">
                        <img src="{{ asset('images/manpower.png') }}" alt="Manpower">
                        <div class="box-overlay bg-dark-gray"></div>
                        <a href="{{ route('frontend.services.manpower') }}" class="d-flex justify-content-center align-items-center mx-auto icon-box absolute-middle-center z-index-1 w-60px h-60px rounded-circle box-shadow-quadruple-large border border-2 border-color-white">
                            <i class="feather icon-feather-arrow-right text-white icon-extra-medium"></i>
                        </a>
                    </div>
                    <div class="p-10 bg-white text-center">
                        <a href="{{ route('frontend.services.manpower') }}" class="d-inline-block fs-18 alt-font fw-500 text-dark-gray mb-5px">Skilled, Unskilled & Semi-Skilled Manpower</a>
                        <p>Trained manpower solutions for diverse industry needs.</p>
                    </div>
                </div>
            </div>

            <!-- 2 -->
            <div class="col">
                <div class="box-shadow-quadruple-large services-box-style-01 hover-box mb-30px border-radius-5px overflow-hidden">
                    <div class="position-relative box-image">
                        <img src="{{ asset('images/security.png') }}" alt="Security">
                        <div class="box-overlay bg-dark-gray"></div>
                        <a href="{{ route('frontend.services.security') }}" class="d-flex justify-content-center align-items-center mx-auto icon-box absolute-middle-center z-index-1 w-60px h-60px rounded-circle box-shadow-quadruple-large border border-2 border-color-white">
                            <i class="feather icon-feather-arrow-right text-white icon-extra-medium"></i>
                        </a>
                    </div>
                    <div class="p-10 bg-white text-center">
                        <a href="{{ route('frontend.services.security') }}" class="d-inline-block fs-18 alt-font fw-500 text-dark-gray mb-5px">Security Services</a>
                        <p>Delivering professional security services to ensure safety.</p>
                    </div>
                </div>
            </div>

            <!-- 3 -->
            <div class="col">
                <div class="box-shadow-quadruple-large services-box-style-01 hover-box mb-30px border-radius-5px overflow-hidden">
                    <div class="position-relative box-image">
                        <img src="{{ asset('images/vehicle.png') }}" alt="Vehicle">
                        <div class="box-overlay bg-dark-gray"></div>
                        <a href="{{ route('frontend.services.vehicle') }}" class="d-flex justify-content-center align-items-center mx-auto icon-box absolute-middle-center z-index-1 w-60px h-60px rounded-circle box-shadow-quadruple-large border border-2 border-color-white">
                            <i class="feather icon-feather-arrow-right text-white icon-extra-medium"></i>
                        </a>
                    </div>
                    <div class="p-10 bg-white text-center">
                        <a href="{{ route('frontend.services.vehicle') }}" class="d-inline-block fs-18 alt-font fw-500 text-dark-gray mb-5px">Vehicle Rental Services</a>
                        <p>Offering well-maintained vehicles for corporate transportation.</p>
                    </div>
                </div>
            </div>

            <!-- 4 -->
            <div class="col">
                <div class="box-shadow-quadruple-large services-box-style-01 hover-box mb-30px border-radius-5px overflow-hidden">
                    <div class="position-relative box-image">
                        <img src="{{ asset('images/catering.png') }}" alt="Catering">
                        <div class="box-overlay bg-dark-gray"></div>
                        <a href="{{ route('frontend.services.catering') }}" class="d-flex justify-content-center align-items-center mx-auto icon-box absolute-middle-center z-index-1 w-60px h-60px rounded-circle box-shadow-quadruple-large border border-2 border-color-white">
                            <i class="feather icon-feather-arrow-right text-white icon-extra-medium"></i>
                        </a>
                    </div>
                    <div class="p-10 bg-white text-center">
                        <a href="{{ route('frontend.services.catering') }}" class="d-inline-block fs-18 alt-font fw-500 text-dark-gray mb-5px">Catering Services</a>
                        <p>Providing hygienic and quality catering services.</p>
                    </div>
                </div>
            </div>

            <!-- 5 -->
            <div class="col">
                <div class="box-shadow-quadruple-large services-box-style-01 hover-box mb-30px border-radius-5px overflow-hidden">
                    <div class="position-relative box-image">
                        <img src="{{ asset('images/garden.png') }}" alt="Garden">
                        <div class="box-overlay bg-dark-gray"></div>
                        <a href="{{ route('frontend.services.garden') }}" class="d-flex justify-content-center align-items-center mx-auto icon-box absolute-middle-center z-index-1 w-60px h-60px rounded-circle box-shadow-quadruple-large border border-2 border-color-white">
                            <i class="feather icon-feather-arrow-right text-white icon-extra-medium"></i>
                        </a>
                    </div>
                    <div class="p-10 bg-white text-center">
                        <a href="{{ route('frontend.services.garden') }}" class="d-inline-block fs-18 alt-font fw-500 text-dark-gray mb-5px">Garden Maintenance</a>
                        <p>Maintaining clean and green landscapes through professional care.</p>
                    </div>
                </div>
            </div>

            <!-- 6 -->
            <div class="col">
                <div class="box-shadow-quadruple-large services-box-style-01 hover-box mb-30px border-radius-5px overflow-hidden">
                    <div class="position-relative box-image">
                        <img src="{{ asset('images/cleaning.png') }}" alt="Cleaning">
                        <div class="box-overlay bg-dark-gray"></div>
                        <a href="{{ route('frontend.services.cleaning') }}" class="d-flex justify-content-center align-items-center mx-auto icon-box absolute-middle-center z-index-1 w-60px h-60px rounded-circle box-shadow-quadruple-large border border-2 border-color-white">
                            <i class="feather icon-feather-arrow-right text-white icon-extra-medium"></i>
                        </a>
                    </div>
                    <div class="p-10 bg-white text-center">
                        <a href="{{ route('frontend.services.cleaning') }}" class="d-inline-block fs-18 alt-font fw-500 text-dark-gray mb-5px">Deep Cleaning Services</a>
                        <p>Ensuring high hygiene standards with advanced cleaning solutions.</p>
                    </div>
                </div>
            </div>

            <!-- 7 -->
            <div class="col">
                <div class="box-shadow-quadruple-large services-box-style-01 hover-box mb-30px border-radius-5px overflow-hidden">
                    <div class="position-relative box-image">
                        <img src="{{ asset('images/data.png') }}" alt="Data Entry">
                        <div class="box-overlay bg-dark-gray"></div>
                        <a href="{{ route('frontend.services.data') }}" class="d-flex justify-content-center align-items-center mx-auto icon-box absolute-middle-center z-index-1 w-60px h-60px rounded-circle box-shadow-quadruple-large border border-2 border-color-white">
                            <i class="feather icon-feather-arrow-right text-white icon-extra-medium"></i>
                        </a>
                    </div>
                    <div class="p-10 bg-white text-center">
                        <a href="{{ route('frontend.services.data') }}" class="d-inline-block fs-18 alt-font fw-500 text-dark-gray mb-5px">Data Entry Services</a>
                        <p>Providing skilled data entry professionals for accurate support.</p>
                    </div>
                </div>
            </div>

            <!-- 8 -->
            <div class="col">
                <div class="box-shadow-quadruple-large services-box-style-01 hover-box mb-30px border-radius-5px overflow-hidden">
                    <div class="position-relative box-image">
                        <img src="{{ asset('images/hospital.png') }}" alt="Hospital">
                        <div class="box-overlay bg-dark-gray"></div>
                        <a href="{{ route('frontend.services.hospital') }}" class="d-flex justify-content-center align-items-center mx-auto icon-box absolute-middle-center z-index-1 w-60px h-60px rounded-circle box-shadow-quadruple-large border border-2 border-color-white">
                            <i class="feather icon-feather-arrow-right text-white icon-extra-medium"></i>
                        </a>
                    </div>
                    <div class="p-10 bg-white text-center">
                        <a href="{{ route('frontend.services.hospital') }}" class="d-inline-block fs-18 alt-font fw-500 text-dark-gray mb-5px">Hospital Specialized Staff</a>
                        <p>Supplying trained healthcare support staff for hospitals.</p>
                    </div>
                </div>
            </div>

            <!-- 9 -->
            <div class="col">
                <div class="box-shadow-quadruple-large services-box-style-01 hover-box mb-30px border-radius-5px overflow-hidden">
                    <div class="position-relative box-image">
                        <img src="{{ asset('images/civil.png') }}" alt="Civil Engineering">
                        <div class="box-overlay bg-dark-gray"></div>
                        <a href="{{ route('frontend.services.civil') }}" class="d-flex justify-content-center align-items-center mx-auto icon-box absolute-middle-center z-index-1 w-60px h-60px rounded-circle box-shadow-quadruple-large border border-2 border-color-white">
                            <i class="feather icon-feather-arrow-right text-white icon-extra-medium"></i>
                        </a>
                    </div>
                    <div class="p-10 bg-white text-center">
                        <a href="{{ route('frontend.services.civil') }}" class="d-inline-block fs-18 alt-font fw-500 text-dark-gray mb-5px">Civil Engineering Manpower</a>
                        <p>Providing qualified civil engineering professionals.</p>
                    </div>
                </div>
            </div>

            <!-- 10 -->
            <div class="col">
                <div class="box-shadow-quadruple-large services-box-style-01 hover-box mb-30px border-radius-5px overflow-hidden">
                    <div class="position-relative box-image">
                        <img src="{{ asset('images/housekeeping.png') }}" alt="Housekeeping">
                        <div class="box-overlay bg-dark-gray"></div>
                        <a href="{{ route('frontend.services.housekeeping') }}" class="d-flex justify-content-center align-items-center mx-auto icon-box absolute-middle-center z-index-1 w-60px h-60px rounded-circle box-shadow-quadruple-large border border-2 border-color-white">
                            <i class="feather icon-feather-arrow-right text-white icon-extra-medium"></i>
                        </a>
                    </div>
                    <div class="p-10 bg-white text-center">
                        <a href="{{ route('frontend.services.housekeeping') }}" class="d-inline-block fs-18 alt-font fw-500 text-dark-gray mb-5px">Housekeeping Services</a>
                        <p>Maintaining housekeeping solutions using modern equipment.</p>
                    </div>
                </div>
            </div>

            <!-- 11 -->
            <div class="col">
                <div class="box-shadow-quadruple-large services-box-style-01 hover-box mb-30px border-radius-5px overflow-hidden">
                    <div class="position-relative box-image">
                        <img src="{{ asset('images/civilwork.png') }}" alt="Civil Works">
                        <div class="box-overlay bg-dark-gray"></div>
                        <a href="{{ route('frontend.services.civilwork') }}" class="d-flex justify-content-center align-items-center mx-auto icon-box absolute-middle-center z-index-1 w-60px h-60px rounded-circle box-shadow-quadruple-large border border-2 border-color-white">
                            <i class="feather icon-feather-arrow-right text-white icon-extra-medium"></i>
                        </a>
                    </div>
                    <div class="p-10 bg-white text-center">
                        <a href="{{ route('frontend.services.civilwork') }}" class="d-inline-block fs-18 alt-font fw-500 text-dark-gray mb-5px">Civil Works</a>
                        <p>Executing reliable civil construction, repair, and maintenance.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
@endsection
