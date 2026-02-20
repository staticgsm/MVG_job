<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function services()
    {
        return view('frontend.services');
    }

    public function manpower()
    {
        return view('frontend.services.manpower');
    }

    public function security()
    {
        return view('frontend.services.security');
    }

    public function vehicle()
    {
        return view('frontend.services.vehicle');
    }

    public function catering()
    {
        return view('frontend.services.catering');
    }

    public function garden()
    {
        return view('frontend.services.garden');
    }

    public function cleaning()
    {
        return view('frontend.services.cleaning');
    }

    public function dataEntry()
    {
        return view('frontend.services.data');
    }

    public function hospital()
    {
        return view('frontend.services.hospital');
    }

    public function civil()
    {
        return view('frontend.services.civil');
    }

    public function housekeeping()
    {
        return view('frontend.services.housekeeping');
    }

    public function civilWork()
    {
        return view('frontend.services.civilwork');
    }
}
