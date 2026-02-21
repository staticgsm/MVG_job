@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-700">System Settings</h1>
            <p class="text-muted small mb-0">Manage global mail configurations and system notifications.</p>
        </div>
        <form action="{{ route('super_admin.settings.test-email') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-outline-info btn-sm shadow-sm">
                <i class="fas fa-paper-plane me-2 text-info"></i> Send Test Email
            </button>
        </form>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <form action="{{ route('super_admin.settings.store') }}" method="POST">
        @csrf
        <div class="row">
            <!-- Mail Configuration -->
            <div class="col-xl-8">
                <div class="card shadow-sm border-0 mb-4 h-100">
                    <div class="card-header bg-white py-3">
                        <h6 class="m-0 font-weight-bold text-base-color"><i class="fas fa-envelope-open-text me-2"></i>SMTP Mail Configuration</h6>
                    </div>
                    <div class="card-body p-4 p-md-5">
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-600 text-dark">Mail Mailer</label>
                                <input type="text" name="mail_mailer" class="form-control" value="{{ $settings['mail_mailer'] ?? config('mail.default') }}" placeholder="e.g. smtp">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-600 text-dark">Mail Host</label>
                                <input type="text" name="mail_host" class="form-control" value="{{ $settings['mail_host'] ?? config('mail.mailers.smtp.host') }}" placeholder="e.g. smtp.gmail.com">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-600 text-dark">Mail Port</label>
                                <input type="text" name="mail_port" class="form-control" value="{{ $settings['mail_port'] ?? config('mail.mailers.smtp.port') }}" placeholder="e.g. 587">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-600 text-dark">Mail Encryption</label>
                                <input type="text" name="mail_encryption" class="form-control" value="{{ $settings['mail_encryption'] ?? config('mail.mailers.smtp.encryption') }}" placeholder="e.g. tls">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-600 text-dark">Mail Username</label>
                                <input type="text" name="mail_username" class="form-control" value="{{ $settings['mail_username'] ?? config('mail.mailers.smtp.username') }}" placeholder="e.g. yourname@example.com">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-600 text-dark">Mail Password</label>
                                <input type="password" name="mail_password" class="form-control" value="{{ $settings['mail_password'] ?? config('mail.mailers.smtp.password') }}" placeholder="Leave blank to keep current">
                            </div>
                            <div class="col-12 mb-0">
                                <label class="form-label fw-600 text-dark">Mail From Address</label>
                                <input type="text" name="mail_from_address" class="form-control" value="{{ $settings['mail_from_address'] ?? config('mail.from.address') }}" placeholder="noreply@mgvc.com">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notifications Toggles -->
            <div class="col-xl-4">
                <div class="card shadow-sm border-0 mb-4 h-100">
                    <div class="card-header bg-white py-3 text-start">
                        <h6 class="m-0 font-weight-bold text-base-color"><i class="fas fa-bell me-2"></i>Email Notifications</h6>
                    </div>
                    <div class="card-body p-4">
                        <div class="notification-item p-3 rounded-3 mb-3 border bg-light-soft">
                            <div class="form-check form-switch ps-0 d-flex justify-content-between align-items-center">
                                <div>
                                    <label class="form-label fw-700 text-dark mb-0 d-block" for="welcomeEmail">Welcome Email</label>
                                    <span class="text-muted small">Sent when a new user joins the platform</span>
                                </div>
                                <input type="hidden" name="notification_welcome_email" value="0">
                                <input type="checkbox" class="form-check-input ms-0" id="welcomeEmail" name="notification_welcome_email" value="1" {{ ($settings['notification_welcome_email'] ?? '1') == '1' ? 'checked' : '' }} style="width: 2.5em; height: 1.25em;">
                            </div>
                        </div>

                        <div class="notification-item p-3 rounded-3 mb-3 border bg-light-soft">
                            <div class="form-check form-switch ps-0 d-flex justify-content-between align-items-center">
                                <div>
                                    <label class="form-label fw-700 text-dark mb-0 d-block" for="subActivated">Subscription Alerts</label>
                                    <span class="text-muted small">Notifies user when payment is successful</span>
                                </div>
                                <input type="hidden" name="notification_subscription_activated" value="0">
                                <input type="checkbox" class="form-check-input ms-0" id="subActivated" name="notification_subscription_activated" value="1" {{ ($settings['notification_subscription_activated'] ?? '1') == '1' ? 'checked' : '' }} style="width: 2.5em; height: 1.25em;">
                            </div>
                        </div>

                        <div class="notification-item p-3 rounded-3 border bg-light-soft">
                            <div class="form-check form-switch ps-0 d-flex justify-content-between align-items-center">
                                <div>
                                    <label class="form-label fw-700 text-dark mb-0 d-block" for="jobAppSubmitted">Job Applications</label>
                                    <span class="text-muted small">Sent after a candidate applies to a job</span>
                                </div>
                                <input type="hidden" name="notification_job_application_submitted" value="0">
                                <input type="checkbox" class="form-check-input ms-0" id="jobAppSubmitted" name="notification_job_application_submitted" value="1" {{ ($settings['notification_job_application_submitted'] ?? '1') == '1' ? 'checked' : '' }} style="width: 2.5em; height: 1.25em;">
                            </div>
                        </div>

                        <div class="mt-4 pt-3 text-muted small">
                            <i class="fas fa-info-circle text-info me-1"></i> Changes here affect site-wide communication.
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 text-start">
            <button type="submit" class="btn btn-base-color px-5 py-2 fw-600 shadow-sm">
                <i class="fas fa-save me-2"></i> Commit Configuration
            </button>
        </div>
    </form>
</div>

<style>
    .fw-700 { font-weight: 700; }
    .fw-600 { font-weight: 600; }
    .text-base-color { color: #ef7f1a !important; }
    .bg-light-soft { background-color: #fcfcfc; }
    .form-control:focus, .form-select:focus { border-color: #ef7f1a; box-shadow: 0 0 0 0.25rem rgba(239, 127, 26, 0.1); }
    .form-check-input:checked { background-color: #ef7f1a; border-color: #ef7f1a; }
    .notification-item { transition: border-color 0.2s; }
    .notification-item:hover { border-color: #ef7f1a !important; }
</style>
@endsection
