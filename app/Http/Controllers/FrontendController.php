<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactUserMail;
use App\Mail\ContactAdminMail;

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

    public function submitContact(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string',
        ]);

        try {
            // Send email to Admin
            Mail::to('info@mvgcompany.in')->send(new ContactAdminMail($validatedData));

            // Send email to User
            Mail::to($validatedData['email'])->send(new ContactUserMail($validatedData));

            if ($request->ajax()) {
                return json_encode([
                    'alert' => 'alert-success',
                    'message' => 'Thank you for contacting us. We will get back to you soon!'
                ]);
            }

            return back()->with('success', 'Thank you for contacting us. We will get back to you soon!');
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return json_encode([
                    'alert' => 'alert-danger',
                    'message' => 'Something went wrong. Please try again later.'
                ]);
            }
            return back()->with('error', 'Something went wrong. Please try again later. Error: ' . $e->getMessage());
        }
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
