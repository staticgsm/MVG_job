<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Define Gates for Permissions
        \Illuminate\Support\Facades\Gate::before(function ($user, $ability) {
            if ($user->hasRole('super_admin')) {
                return true;
            }
            // Check if ability matches a permission slug
            if ($user->hasPermission($ability)) {
                return true;
            }
        });

        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $settings = \App\Models\Setting::all()->pluck('value', 'key');

                if ($settings->isNotEmpty()) {
                    config([
                        'mail.default' => $settings['mail_mailer'] ?? config('mail.default'),
                        'mail.mailers.smtp.host' => $settings['mail_host'] ?? config('mail.mailers.smtp.host'),
                        'mail.mailers.smtp.port' => $settings['mail_port'] ?? config('mail.mailers.smtp.port'),
                        'mail.mailers.smtp.username' => $settings['mail_username'] ?? config('mail.mailers.smtp.username'),
                        'mail.mailers.smtp.password' => $settings['mail_password'] ?? config('mail.mailers.smtp.password'),
                        'mail.mailers.smtp.encryption' => $settings['mail_encryption'] ?? config('mail.mailers.smtp.encryption'),
                        'mail.from.address' => $settings['mail_from_address'] ?? config('mail.from.address'),
                    ]);
                }
            }
        } catch (\Throwable $e) {
            // Settings table not ready or DB connection issue.
            // We fallback to default config.
        }
    }
}
