<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value', 'key');
        return view('super_admin.settings.index', compact('settings'));
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }

    public function sendTestEmail(Request $request)
    {
        try {
            // 1. Load settings from DB
            $settings = Setting::all()->pluck('value', 'key');
            
            // 2. Set Config at runtime
            $mailer = strtolower(trim($settings['mail_mailer'] ?? 'smtp'));
            
            config([
                'mail.default' => $mailer,
                'mail.mailers.smtp.transport' => 'smtp',
                'mail.mailers.smtp.host' => $settings['mail_host'] ?? config('mail.mailers.smtp.host'),
                'mail.mailers.smtp.port' => $settings['mail_port'] ?? config('mail.mailers.smtp.port'),
                'mail.mailers.smtp.username' => $settings['mail_username'] ?? config('mail.mailers.smtp.username'),
                'mail.mailers.smtp.password' => $settings['mail_password'] ?? config('mail.mailers.smtp.password'),
                'mail.mailers.smtp.encryption' => strtolower($settings['mail_encryption'] ?? config('mail.mailers.smtp.encryption')),
                'mail.from.address' => $settings['mail_from_address'] ?? config('mail.from.address'),
            ]);

            // 3. Purge existing Mailer instance to force re-resolution with new config
            if (app()->bound('mail.manager')) {
                app()->forgetInstance('mail.manager');
            }
            if (app()->bound('mailer')) {
                app()->forgetInstance('mailer');
            }
            \Illuminate\Support\Facades\Mail::clearResolvedInstances();

            // 4. Debug Log
            \Log::info('Attempting to send test email.', [
                'resolved_mailer' => config('mail.default'),
                'transport_config' => config('mail.mailers.smtp.transport'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'username' => config('mail.mailers.smtp.username'),
                'encryption' => config('mail.mailers.smtp.encryption'),
                'from' => config('mail.from.address'),
            ]);

            \Mail::raw('This is a test email from your Laravel application.', function ($message) {
                $message->to(auth()->user()->email)
                        ->subject('Test Email from System Settings');
            });

            return redirect()->back()->with('success', 'Test email sent successfully to ' . auth()->user()->email . '. Check your spam folder!');
        } catch (\Exception $e) {
            \Log::error('Test Email Failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send test email: ' . $e->getMessage());
        }
    }
}
