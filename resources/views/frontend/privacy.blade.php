@extends('layouts.frontend')

@section('title', 'Privacy Policy - MVG Company')

@section('content')
<!-- start page title -->
<section class="page-title-big-typography bg-dark-gray ipad-top-space-margin" data-parallax-background-ratio="0.5" style="background-image: url({{ asset('images/aboutbanner.png') }})">
    <div class="opacity-extra-medium bg-dark-slate-blue"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center extra-small-screen">
            <div class="col-12 position-relative text-center page-title-extra-large">
                <h1 class="m-auto text-white text-shadow-double-large fw-500 ls-minus-3px xs-ls-minus-2px" data-anime='{ "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>Privacy Policy</h1>
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
                <h4 class="fw-600 text-dark-gray mb-20px">1. Information Collection</h4>
                <p>We collect information from you when you register on our site, place an order, subscribe to our newsletter, or fill out a form. This information may include your name, email address, phone number, and other relevant details.</p>

                <h4 class="fw-600 text-dark-gray mb-20px">2. Information Usage</h4>
                <p>Any of the information we collect from you may be used in one of the following ways:</p>
                <ul>
                    <li>To personalize your experience</li>
                    <li>To improve our website</li>
                    <li>To improve customer service</li>
                    <li>To process transactions</li>
                    <li>To send periodic emails</li>
                </ul>

                <h4 class="fw-600 text-dark-gray mb-20px">3. Information Protection</h4>
                <p>We implement a variety of security measures to maintain the safety of your personal information. Your personal information is contained behind secured networks and is only accessible by a limited number of persons who have special access rights to such systems.</p>

                <h4 class="fw-600 text-dark-gray mb-20px">4. Cookies</h4>
                <p>We use cookies to help us remember and process the items in your shopping cart, understand and save your preferences for future visits, and compile aggregate data about site traffic and site interaction so that we can offer better site experiences and tools in the future.</p>

                <h4 class="fw-600 text-dark-gray mb-20px">5. Third-Party Disclosure</h4>
                <p>We do not sell, trade, or otherwise transfer to outside parties your personally identifiable information. This does not include trusted third parties who assist us in operating our website, conducting our business, or servicing you, so long as those parties agree to keep this information confidential.</p>

                <h4 class="fw-600 text-dark-gray mb-20px">6. Consent</h4>
                <p>By using our site, you consent to our privacy policy.</p>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
@endsection
