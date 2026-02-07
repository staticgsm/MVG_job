@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Super Admin Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in as Super Admin!') }}
                    
                    <div class="mt-3">
                        <h5>System Overview</h5>
                        <p>Manage all users and system settings here.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
