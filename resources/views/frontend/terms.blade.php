@extends('layouts.frontend')

@section('title', 'Terms and Conditions - MVG Company')

@section('content')
<!-- start page title -->
<section class="page-title-big-typography bg-dark-gray ipad-top-space-margin" data-parallax-background-ratio="0.5" style="background-image: url({{ asset('images/aboutbanner.png') }})">
    <div class="opacity-extra-medium bg-dark-slate-blue"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center extra-small-screen">
            <div class="col-12 position-relative text-center page-title-extra-large">
                <h1 class="m-auto text-white text-shadow-double-large fw-500 ls-minus-3px xs-ls-minus-2px" data-anime='{ "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>Terms and Conditions</h1>
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
                <h4 class="fw-600 text-dark-gray mb-20px">1. Acceptance of Terms</h4>
                <p>Welcome to MVG Company. By accessing and using this website, you agree to comply with and be bound by the following terms and conditions of use. If you disagree with any part of these terms, please do not use our website.</p>

                <h4 class="fw-600 text-dark-gray mb-20px">2. Use of the Site</h4>
                <p>The content of the pages of this website is for your general information and use only. It is subject to change without notice. Unauthorized use of this website may give rise to a claim for damages and/or be a criminal offense.</p>

                <h4 class="fw-600 text-dark-gray mb-20px">3. Intellectual Property</h4>
                <p>This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance, and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.</p>

                <h4 class="fw-600 text-dark-gray mb-20px">4. User Accounts</h4>
                <p>If you create an account on our website, you are responsible for maintaining the confidentiality of your account and password and for restricting access to your computer. You agree to accept responsibility for all activities that occur under your account or password.</p>

                <h4 class="fw-600 text-dark-gray mb-20px">5. Limitation of Liability</h4>
                <p>MVG Company shall not be liable for any special or consequential damages that result from the use of, or the inability to use, the materials on this site or the performance of the products, even if MVG Company has been advised of the possibility of such damages.</p>

                <h4 class="fw-600 text-dark-gray mb-20px">6. Governing Law</h4>
                <p>Your use of this website and any dispute arising out of such use of the website is subject to the laws of India and specifically the jurisdiction of courts in Nashik, Maharashtra.</p>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
@endsection
