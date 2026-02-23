@extends('layouts.frontend')

@section('title', 'Choose Your Plan - MVGC Services Private Limited')

@section('extra_css')
<style>
    .bg-solitude-blue { background-color: #f0f4fd; }
    .pt-150px { padding-top: 150px; }
    .pb-100px { padding-bottom: 100px; }
    
    .pricing-card {
        background: #fff;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 2px solid transparent;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        height: 100%;
        position: relative;
        overflow: hidden;
    }
    
    .pricing-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border-color: #ef7f1a;
    }
    
    .pricing-card.featured {
        border-color: #ef7f1a;
        background: #fff;
    }
    
    .pricing-card.featured::before {
        content: 'MOST POPULAR';
        position: absolute;
        top: 20px;
        right: -35px;
        background: #ef7f1a;
        color: #fff;
        padding: 8px 40px;
        font-size: 10px;
        font-weight: 700;
        transform: rotate(45deg);
        letter-spacing: 1px;
    }
    
    .price-value {
        font-size: 48px;
        font-weight: 800;
        color: #2b313c;
        margin-bottom: 5px;
    }
    
    .price-duration {
        color: #717580;
        font-size: 16px;
        font-weight: 500;
    }
    
    .plan-feature-list {
        list-style: none;
        padding: 0;
        margin: 30px 0;
        text-align: left;
    }
    
    .plan-feature-list li {
        padding: 10px 0;
        color: #717580;
        display: flex;
        align-items: center;
        font-size: 15px;
    }
    
    .plan-feature-list li i {
        color: #16a34a;
        margin-right: 12px;
        font-size: 18px;
    }
    
    .btn-pricing {
        padding: 15px 30px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        border-radius: 50px;
    }
</style>
@endsection

@section('content')
<section class="bg-solitude-blue pt-150px pb-100px">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-7 text-center">
                <span class="fs-15 text-base-color fw-700 text-uppercase mb-10px d-block">Investment in your career</span>
                <h2 class="alt-font text-dark-gray fw-700 ls-minus-1px">Choose the perfect plan for your career growth</h2>
                <p class="w-80 mx-auto sm-w-100">Unlock premium job listings, direct connections with HR, and priority application status with our professional plans.</p>
            </div>
        </div>

        @if(session('error'))
            <div class="row justify-content-center mb-4">
                <div class="col-lg-8">
                    <div class="alert alert-danger border-radius-10px text-center shadow-sm">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center align-items-stretch">
            @foreach($plans as $plan)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="pricing-card {{ $loop->index == 1 ? 'featured' : '' }} text-center">
                        <h5 class="alt-font fw-700 text-dark-gray mb-10px">{{ $plan->name }}</h5>
                        <div class="price-value">₹{{ number_format($plan->price, 0) }}</div>
                        <div class="price-duration">For {{ $plan->duration_days }} Days</div>
                        
                        <ul class="plan-feature-list">
                            <li><i class="bi bi-check-circle-fill"></i> View Premium Job Posts</li>
                            <li><i class="bi bi-check-circle-fill"></i> Unlimited Job Applications</li>
                            <li><i class="bi bi-check-circle-fill"></i> Direct HR Contact Access</li>
                            <li><i class="bi bi-check-circle-fill"></i> Profile Visibility Boost</li>
                            @if($plan->price > 0)
                                <li><i class="bi bi-check-circle-fill"></i> Priority Support</li>
                                <li><i class="bi bi-check-circle-fill"></i> Resume Optimization Tips</li>
                            @endif
                        </ul>

                        <form action="{{ route('candidate.subscriptions.initiate', $plan) }}" method="POST">
                            @csrf
                            @if($currentSubscription && $currentSubscription->subscription_plan_id == $plan->id)
                                <button type="button" class="btn btn-medium btn-green btn-rounded w-100 fw-700" disabled>
                                    <i class="bi bi-patch-check-fill me-2"></i> ACTIVE PLAN
                                </button>
                                <p class="fs-12 text-medium-gray mt-3">Valid until {{ $currentSubscription->end_date->format('d M, Y') }}</p>
                            @elseif($currentSubscription)
                                <button type="submit" class="btn btn-medium btn-base-color btn-rounded w-100 fw-700 btn-box-shadow">UPGRADE NOW</button>
                            @else
                                <button type="submit" class="btn btn-medium btn-base-color btn-rounded w-100 fw-700 btn-box-shadow">GET STARTED</button>
                            @endif
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-5">
            <div class="col-12 text-center">
                <p class="text-medium-gray fs-14">Need help choosing a plan? <a href="{{ route('frontend.contact') }}" class="text-dark-gray fw-600 text-decoration-line-bottom">Contact our support team</a></p>
            </div>
        </div>
    </div>
</section>
@endsection
