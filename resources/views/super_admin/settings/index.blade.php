@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">System Settings</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-3 text-right">
        <form action="{{ route('super_admin.settings.test-email') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-info shadow-sm">
                <i class="fas fa-paper-plane fa-sm text-white-50"></i> Send Test Email
            </button>
        </form>
    </div>

    <form action="{{ route('super_admin.settings.store') }}" method="POST">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Mail Configuration</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail Mailer</label>
                            <input type="text" name="mail_mailer" class="form-control" value="{{ $settings['mail_mailer'] ?? config('mail.default') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail Host</label>
                            <input type="text" name="mail_host" class="form-control" value="{{ $settings['mail_host'] ?? config('mail.mailers.smtp.host') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail Port</label>
                            <input type="text" name="mail_port" class="form-control" value="{{ $settings['mail_port'] ?? config('mail.mailers.smtp.port') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail Username</label>
                            <input type="text" name="mail_username" class="form-control" value="{{ $settings['mail_username'] ?? config('mail.mailers.smtp.username') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail Password</label>
                            <input type="password" name="mail_password" class="form-control" value="{{ $settings['mail_password'] ?? config('mail.mailers.smtp.password') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail Encryption</label>
                            <input type="text" name="mail_encryption" class="form-control" value="{{ $settings['mail_encryption'] ?? config('mail.mailers.smtp.encryption') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Mail From Address</label>
                            <input type="text" name="mail_from_address" class="form-control" value="{{ $settings['mail_from_address'] ?? config('mail.from.address') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Notification Toggles</h6>
            </div>
            <div class="card-body">
                <div class="custom-control custom-switch">
                    <input type="hidden" name="notification_welcome_email" value="0">
                    <input type="checkbox" class="custom-control-input" id="welcomeEmail" name="notification_welcome_email" value="1" {{ ($settings['notification_welcome_email'] ?? '1') == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="welcomeEmail">Enable Welcome Email</label>
                </div>
                <div class="custom-control custom-switch mt-3">
                    <input type="hidden" name="notification_subscription_activated" value="0">
                    <input type="checkbox" class="custom-control-input" id="subActivated" name="notification_subscription_activated" value="1" {{ ($settings['notification_subscription_activated'] ?? '1') == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="subActivated">Enable Subscription Activated Email</label>
                </div>
                <div class="custom-control custom-switch mt-3">
                    <input type="hidden" name="notification_job_application_submitted" value="0">
                    <input type="checkbox" class="custom-control-input" id="jobAppSubmitted" name="notification_job_application_submitted" value="1" {{ ($settings['notification_job_application_submitted'] ?? '1') == '1' ? 'checked' : '' }}>
                    <label class="custom-control-label" for="jobAppSubmitted">Enable Job Application Submitted Email</label>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>
@endsection
