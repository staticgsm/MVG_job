@extends('layouts.frontend')

@section('title', 'Contact Us - MVGC')

@section('content')
<!-- start page title -->
<section class="page-title-big-typography bg-dark-gray ipad-top-space-margin" data-parallax-background-ratio="0.5" style="background-image: url({{ asset('images/contactbanner.png') }})">
    <div class="opacity-extra-medium bg-dark-slate-blue"></div>
    <div class="container">
        <div class="row align-items-center justify-content-center extra-small-screen">
            <div class="col-12 position-relative text-center page-title-extra-large">
                <h1 class="m-auto text-white text-shadow-double-large fw-500 ls-minus-3px xs-ls-minus-2px" data-anime='{ "translateY": [15, 0], "opacity": [0,1], "duration": 600, "delay": 0, "staggervalue": 300, "easing": "easeOutQuad" }'>Contact Us</h1>
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
<section id="down-section" class="overflow-hidden">
    <div class="container"> 
        <div class="row g-0 justify-content-center">
            <div class="col-lg-3 col-md-6" data-anime='{ "translateX": [-15, 0], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <div class="h-100 sm-h-500px xs-h-400px cover-background" style="background-image: url({{ asset('images/contactdesk.png') }})"></div>
            </div>
            <div class="col-lg-4 col-md-6" data-anime='{ "translateX": [15, 0], "opacity": [0,1], "duration": 600, "delay": 100, "staggervalue": 300, "easing": "easeOutQuad" }'>
                <div class="bg-base-color p-18 lg-p-15 h-100"> 
                    <span class="text-white text-decoration-line-bottom mb-10px d-inline-block">Keep in touch?</span>
                    <p class="text-white opacity-5">MVG Empire", 3rd floor, Sea-Wood Tower, Near Khatib Dairy, Old Gangapur Naka, Gangapur Road Nashik-422013</p>
                    <span class="text-white text-decoration-line-bottom mb-10px d-inline-block">Toll free customer care?</span>
                    <p><a href="tel:+917720007466" class="text-white opacity-5">+91 7720007466</a><br></p>
                    <span class="text-white text-decoration-line-bottom mb-10px d-inline-block">Need live support?</span>
                    <a href="mailto:mvgcservicespvtltd@gmail.com" class="text-white opacity-5 d-block">mvgcservicespvtltd@gmail.com</a>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1">  
                <div class="pt-5 md-pt-45px contact-form-style-01" data-anime='{ "translateX": [0, 0], "opacity": [0,1], "duration": 600, "delay": 300, "staggervalue": 300, "easing": "easeOutQuad" }'>
                    <h4 class="d-inline-block alt-font fw-600 text-dark-gray ls-minus-1px mb-30px">Feel free to reach via contact us form.</h4>
                    <!-- start contact form -->
                    <form action="#" method="post">
                        @csrf
                        <div class="position-relative form-group mb-20px">
                            <span class="form-icon"><i class="bi bi-emoji-smile"></i></span>
                            <input type="text" name="name" class="form-control required" placeholder="Your name*">
                        </div> 
                        <div class="position-relative form-group mb-20px">
                            <span class="form-icon"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control required" placeholder="Your email address*">
                        </div> 
                        <div class="position-relative form-group form-textarea">
                            <span class="form-icon"><i class="bi bi-chat-square-dots"></i></span>
                            <textarea placeholder="Your message" name="comment" class="form-control" rows="3"></textarea>
                            <input type="hidden" name="redirect" value="">
                            <button class="btn btn-small btn-round-edge btn-dark-gray btn-box-shadow mt-20px m-auto submit" type="submit">Send message</button>
                            <div class="form-results mt-20px d-none"></div>
                        </div>
                    </form>
                    <!-- end contact form -->
                </div>
            </div>  
        </div>
    </div>
</section>
<!-- end section --> 
<!-- start section -->
<section class="p-0" id="location">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 p-0">
                <div id="map" class="map">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d119962.23311070395!2d73.711007!3d20.016077!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bddeb002cd5030f%3A0x6c6e99fdcff5daa9!2sMVG%20Company!5e0!3m2!1sen!2sin!4v1771243467377!5m2!1sen!2sin"
                        width="100%"
                        height="600"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end section -->
@endsection
