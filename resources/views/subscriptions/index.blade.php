@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center mb-5">
        <h1 class="display-4">Choose Your Plan</h1>
        <p class="lead text-muted">Unlock premium features and boost your career.</p>
    </div>

    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <div class="row justify-content-center">
        @foreach($plans as $plan)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-header bg-white py-4 text-center border-0">
                        <h4 class="my-0 font-weight-normal">{{ $plan->name }}</h4>
                    </div>
                    <div class="card-body text-center">
                        <h1 class="card-title pricing-card-title">₹{{ number_format($plan->price, 0) }} <small class="text-muted">/ {{ $plan->duration_days }} days</small></h1>
                        <p class="mt-3 text-muted">{{ $plan->description }}</p>
                        <form action="{{ route('candidate.subscriptions.initiate', $plan) }}" method="POST">
                            @csrf
                            @if($currentSubscription && $currentSubscription->subscription_plan_id == $plan->id)
                                <button type="button" class="btn btn-lg btn-block btn-success w-100 mt-4" disabled>Current Plan</button>
                                <p class="small text-muted mt-2">Expires on {{ $currentSubscription->end_date->format('d M, Y') }}</p>
                            @elseif($currentSubscription)
                                <button type="submit" class="btn btn-lg btn-block btn-outline-primary w-100 mt-4">Upgrade Plan</button>
                            @else
                                <button type="submit" class="btn btn-lg btn-block btn-primary w-100 mt-4">Get Started</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
