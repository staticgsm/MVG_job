@extends('layouts.frontend')

@section('title', 'Refund Policy - MVG Company')

@section('content')
<!-- start page title -->
<section class="page-title-big-typography bg-dark-gray ipad-top-space-margin" data-parallax-background-ratio="0.5" style="background-image: url({{ asset('images/aboutbanner.png') }})">
    <div class="opacity-extra-medium bg-dark-slate-blue"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center extra-small-screen">
            <div class="col-12 position-relative text-center page-title-extra-large">
                <h1 class="m-auto text-white text-shadow-double-large fw-500 ls-minus-3px xs-ls-minus-2px" data-anime='{ "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>Refund Policy</h1>
            </div> 
        </div>
    </div>
</section>
<!-- end page title -->

<!-- start section -->
<section>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10" data-anime='{ "el": "childs", "translateY": [50, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <h4 class="fw-600 text-dark-gray mb-20px">1. Refund Eligibility</h4>
                <p>We want you to be satisfied with our services. If you are not satisfied, you may be eligible for a refund depending on the type of service provided and the stage of completion.</p>

                <h4 class="fw-600 text-dark-gray mb-20px">2. Subscription Services</h4>
                <p>For subscription-based services, refunds are generally not provided once the subscription period has started. However, you can cancel your subscription at any time to prevent future billing.</p>

                <h4 class="fw-600 text-dark-gray mb-20px">3. Service Fees</h4>
                <p>Service fees collected from candidates are strictly for optional value-added services such as profile evaluation, documentation assistance, and interview preparation support.</p>

                <p>These fees are not charged for job placement or job guarantees.</p>

                <p>Refunds may be considered if the service has not been initiated or delivered, subject to review.</p>

                <h4 class="fw-600 text-dark-gray mb-20px">4. Refund Process</h4>
                <p>To request a refund, please contact our support team at <a href="mailto:info@mvgcompany.in">info@mvgcompany.in</a> with your transaction details and reason for the request. We will review your request and get back to you within 7-10 business days.</p>

                <h4 class="fw-600 text-dark-gray mb-20px">5. Exceptions</h4>
                <p>Exceptions to this policy may be made on a case-by-case basis at the sole discretion of MVG Company management.</p>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
@endsection
