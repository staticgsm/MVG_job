@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    {{-- Breadcrumb & Header --}}
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.candidates.index') }}">Candidate Management</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile View</li>
        </ol>
    </nav>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div class="d-flex align-items-center">
            <div class="avatar-lg rounded-circle text-white d-flex align-items-center justify-content-center fw-800 me-3 shadow-sm" 
                 style="background: linear-gradient(135deg, #ef7f1a, #f5a623); width: 60px; height: 60px; font-size: 24px;">
                {{ strtoupper(substr($candidate->name, 0, 1)) }}
            </div>
            <div>
                <h1 class="h3 mb-0 text-gray-800 fw-800">{{ $candidate->name }}</h1>
                <div class="text-muted small">Candidate ID: #{{ str_pad($candidate->id, 4, '0', STR_PAD_LEFT) }}</div>
            </div>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.candidates.edit', $candidate) }}" class="btn btn-warning px-4 rounded-pill fw-700 shadow-sm">
                <i class="bi bi-pencil-square me-1"></i> Edit Profile
            </a>
            <a href="{{ route('admin.candidates.index') }}" class="btn btn-outline-secondary px-4 rounded-pill fw-700 shadow-sm">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Sidebar Info -->
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="fw-800 mb-0">Personal Details</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="user-info-list mt-3">
                        <div class="info-item mb-3 d-flex align-items-center p-3 rounded-3 bg-light">
                            <div class="info-icon me-3 bg-white text-primary rounded-circle shadow-sm" style="width: 35px; height: 35px; line-height: 35px; text-align: center;">
                                <i class="bi bi-envelope-fill"></i>
                            </div>
                            <div>
                                <div class="text-muted small fw-600">Email Address</div>
                                <div class="fw-700 text-dark">{{ $candidate->email }}</div>
                            </div>
                        </div>

                        <div class="info-item mb-3 d-flex align-items-center p-3 rounded-3 bg-light">
                            <div class="info-icon me-3 bg-white text-info rounded-circle shadow-sm" style="width: 35px; height: 35px; line-height: 35px; text-align: center;">
                                <i class="bi bi-phone-fill"></i>
                            </div>
                            <div>
                                <div class="text-muted small fw-600">Contact Number</div>
                                <div class="fw-700 text-dark">{{ $candidate->mobile }}</div>
                            </div>
                        </div>

                        @if($candidate->candidateProfile)
                            <div class="info-item mb-3 d-flex align-items-center p-3 rounded-3 bg-light">
                                <div class="info-icon me-3 bg-white text-success rounded-circle shadow-sm" style="width: 35px; height: 35px; line-height: 35px; text-align: center;">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div>
                                    <div class="text-muted small fw-600">Location</div>
                                    <div class="fw-700 text-dark">{{ $candidate->candidateProfile->city }}, {{ $candidate->candidateProfile->state }}</div>
                                </div>
                            </div>

                            <div class="info-item mb-3 d-flex align-items-center p-3 rounded-3 bg-light">
                                <div class="info-icon me-3 bg-white text-warning rounded-circle shadow-sm" style="width: 35px; height: 35px; line-height: 35px; text-align: center;">
                                    <i class="bi bi-calendar-event-fill"></i>
                                </div>
                                <div>
                                    <div class="text-muted small fw-600">Date of Birth</div>
                                    <div class="fw-700 text-dark">{{ $candidate->candidateProfile->dob ? $candidate->candidateProfile->dob->format('d M, Y') : 'N/A' }}</div>
                                </div>
                            </div>

                            <div class="info-item mb-3 d-flex align-items-center p-3 rounded-3 bg-light">
                                <div class="info-icon me-3 bg-white text-secondary rounded-circle shadow-sm" style="width: 35px; height: 35px; line-height: 35px; text-align: center;">
                                    <i class="bi bi-card-text"></i>
                                </div>
                                <div>
                                    <div class="text-muted small fw-600">Aadhaar Number</div>
                                    <div class="fw-700 text-dark">{{ $candidate->candidateProfile->aadhaar_no ?? 'N/A' }}</div>
                                </div>
                            </div>

                            <div class="info-item mb-3 d-flex align-items-center p-3 rounded-3 bg-light">
                                <div class="info-icon me-3 bg-white text-secondary rounded-circle shadow-sm" style="width: 35px; height: 35px; line-height: 35px; text-align: center;">
                                    <i class="bi bi-credit-card-2-front"></i>
                                </div>
                                <div>
                                    <div class="text-muted small fw-600">PAN Number</div>
                                    <div class="fw-700 text-dark">{{ $candidate->candidateProfile->pan_no ?? 'N/A' }}</div>
                                </div>
                            </div>

                            <div class="d-grid gap-2 mb-3">
                                @if($candidate->candidateProfile->resume_path)
                                    <a href="{{ Storage::url($candidate->candidateProfile->resume_path) }}" target="_blank" class="btn btn-primary-light py-2 rounded-3 fw-700 text-primary border-0">
                                        <i class="bi bi-file-earmark-pdf-fill me-2"></i>Resume
                                    </a>
                                @endif

                                @if($candidate->candidateProfile->aadhaar_doc_path)
                                    <a href="{{ Storage::url($candidate->candidateProfile->aadhaar_doc_path) }}" target="_blank" class="btn btn-info-light py-2 rounded-3 fw-700 text-info border-0">
                                        <i class="bi bi-file-earmark-pdf-fill me-2"></i>Aadhaar Card
                                    </a>
                                @endif

                                @if($candidate->candidateProfile->pan_card_path)
                                    <a href="{{ Storage::url($candidate->candidateProfile->pan_card_path) }}" target="_blank" class="btn btn-danger-light py-2 rounded-3 fw-700 text-danger border-0">
                                        <i class="bi bi-file-earmark-pdf-fill me-2"></i>PAN Card
                                    </a>
                                @endif
                            </div>

                            @if(!$candidate->candidateProfile->resume_path && !$candidate->candidateProfile->aadhaar_doc_path && !$candidate->candidateProfile->pan_card_path)
                                <div class="alert alert-warning border-0 small py-3" style="border-radius: 10px;">
                                    <i class="bi bi-exclamation-triangle-fill me-2"></i>No documents uploaded yet.
                                </div>
                            @endif
                        @else
                            <div class="alert alert-danger border-0" style="border-radius: 10px;">
                                <i class="bi bi-person-x-fill me-2"></i>Profile details are incomplete.
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-4 overflow-hidden" style="border-radius: 15px;">
                <div class="card-header border-0 py-3 {{ $candidate->subscription ? 'bg-success text-white' : 'bg-light' }}">
                    <h5 class="fw-800 mb-0">Subscription Info</h5>
                </div>
                <div class="card-body">
                    @if($candidate->subscription)
                        <div class="text-center mb-3">
                            <span class="badge bg-success-light text-success fw-800 p-2 px-3 rounded-pill fs-6">
                                <i class="bi bi-patch-check-fill me-1"></i> {{ $candidate->subscription->subscriptionPlan->name }}
                            </span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted fw-600">Started On:</span>
                            <span class="fw-700">{{ $candidate->subscription->start_date->format('d M, Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted fw-600">Expires On:</span>
                            <span class="fw-700 text-danger">{{ $candidate->subscription->end_date->format('d M, Y') }}</span>
                        </div>
                    @else
                        <div class="text-center py-2">
                            <div class="text-muted mb-2">No active subscription found.</div>
                            <span class="badge bg-light text-muted p-2 px-3 rounded-pill fw-700">Free Tier</span>
                        </div>
                    @endif
                </div>
            </div>

            @if(auth()->user()->hasRole('super_admin'))
                <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
                    <div class="card-header bg-white border-0 py-3 pb-0">
                        <h5 class="fw-800 mb-0">Manage Subscription</h5>
                    </div>
                    <div class="card-body">
                        <p class="text-muted small mb-3">Manually activate a subscription plan for this candidate (Offline Payment).</p>
                        <form action="{{ route('admin.candidates.subscribe', $candidate) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-700 small mb-1">Select Plan</label>
                                <select name="subscription_plan_id" class="form-select rounded-3" required>
                                    <option value="">Choose a plan...</option>
                                    @foreach($subscriptionPlans as $plan)
                                        <option value="{{ $plan->id }}">{{ $plan->name }} - ₹{{ $plan->price }} ({{ $plan->duration_days }} Days)</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 rounded-3 fw-700 py-2" onclick="return confirm('Are you sure you want to manually activate this subscription?')">
                                <i class="bi bi-lightning-fill me-1"></i> Activate Now
                            </button>
                        </form>
                    </div>
                </div>
            @endif
        </div>

        <!-- Main Content (Tabs) -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px; overflow: hidden;">
                <div class="bg-white px-2 pt-2 border-bottom">
                    <ul class="nav nav-pills custom-pills" id="profileTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active fw-700" id="education-tab" data-toggle="tab" href="#education" role="tab">Education</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-700" id="experience-tab" data-toggle="tab" href="#experience" role="tab">Work History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-700" id="skills-tab" data-toggle="tab" href="#skills" role="tab">Expertise</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-700" id="applications-tab" data-toggle="tab" href="#applications" role="tab">Job Apps</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-700" id="payments-tab" data-toggle="tab" href="#payments" role="tab">Billing</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    <div class="tab-content" id="profileTabsContent">
                        <!-- Education -->
                        <div class="tab-pane fade show active" id="education" role="tabpanel">
                            @forelse($candidate->candidateEducations as $edu)
                                <div class="d-flex mb-4 p-3 rounded-3 border border-light bg-light-hover">
                                    <div class="edu-icon me-3">
                                        <div class="bg-white p-2 rounded-circle shadow-sm text-primary" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-mortarboard-fill fs-5"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <h5 class="fw-800 mb-1">{{ $edu->course_name }}</h5>
                                        <div class="text-muted small fw-600">{{ $edu->institute_name }} | {{ $edu->university_board }}</div>
                                        <div class="mt-2">
                                            <span class="badge bg-primary px-3 rounded-pill">Year: {{ $edu->passing_year }}</span>
                                            <span class="badge bg-white text-dark border ms-1 px-3 rounded-pill">Marks: {{ $edu->marks_percentage }}%</span>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <i class="bi bi-book text-muted fs-1 opacity-25"></i>
                                    <p class="text-muted mt-2 fw-700">No education details available.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Experience -->
                        <div class="tab-pane fade" id="experience" role="tabpanel">
                            @forelse($candidate->candidateExperiences as $exp)
                                <div class="d-flex mb-4 p-3 rounded-3 border border-light bg-light-hover position-relative">
                                    <div class="exp-icon me-3">
                                        <div class="bg-white p-2 rounded-circle shadow-sm text-success" style="width: 45px; height: 45px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-briefcase-fill fs-5"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <h5 class="fw-800 mb-1 text-dark">{{ $exp->designation }}</h5>
                                            <span class="text-muted small fw-600">{{ $exp->start_date->format('M Y') }} - {{ $exp->end_date ? $exp->end_date->format('M Y') : 'Present' }}</span>
                                        </div>
                                        <div class="text-muted small fw-600 mb-2">{{ $exp->company_name }}</div>
                                        <p class="text-muted small mb-0">{{ $exp->job_description }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5">
                                    <i class="bi bi-building text-muted fs-1 opacity-25"></i>
                                    <p class="text-muted mt-2 fw-700">No work experience found.</p>
                                </div>
                            @endforelse
                        </div>

                        <!-- Skills -->
                        <div class="tab-pane fade" id="skills" role="tabpanel">
                            <div class="row g-3">
                                @forelse($candidate->candidateSkills as $skill)
                                    <div class="col-md-6">
                                        <div class="p-3 rounded-3 bg-light border border-white shadow-xs">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <h6 class="fw-800 mb-0">{{ $skill->skill_name }}</h6>
                                                <span class="badge p-2 px-3 rounded-pill {{ $skill->skill_level == 'Expert' ? 'bg-success' : ($skill->skill_level == 'Intermediate' ? 'bg-info' : 'bg-primary') }}">
                                                    {{ $skill->skill_level }}
                                                </span>
                                            </div>
                                            <div class="small text-muted fw-600">{{ $skill->years_of_experience }} Years experience</div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-5">
                                        <i class="bi bi-stars text-muted fs-1 opacity-25"></i>
                                        <p class="text-muted mt-2 fw-700">No skills listed yet.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Job Applications -->
                        <div class="tab-pane fade" id="applications" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr class="small text-uppercase fw-700 text-muted">
                                            <th>Job Info</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($candidate->jobApplications as $app)
                                            <tr>
                                                <td>
                                                    <div class="fw-800 text-dark">{{ $app->jobPost->title ?? 'Deleted Job' }}</div>
                                                    <div class="text-muted small">{{ $app->jobPost->company_name ?? 'N/A' }} | #{{ $app->jobPost->job_code ?? 'N/A' }}</div>
                                                </td>
                                                <td class="small fw-600 text-muted">{{ $app->created_at->format('d M, Y') }}</td>
                                                <td>
                                                    <span class="badge bg-info-light text-info fw-700 rounded-pill px-3">{{ ucfirst($app->status) }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="3" class="text-center py-4 text-muted">No applications found.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Payment History -->
                        <div class="tab-pane fade" id="payments" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="bg-light">
                                        <tr class="small text-uppercase fw-700 text-muted">
                                            <th>Transaction</th>
                                            <th>Plan</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($candidate->payments as $payment)
                                            <tr>
                                                <td class="small fw-700 text-dark">
                                                    {{ $payment->txnid }}<br>
                                                    <span class="text-muted small fw-normal">{{ $payment->created_at->format('d M, Y H:i') }}</span>
                                                </td>
                                                <td class="fw-600">{{ $payment->subscriptionPlan->name ?? 'Deleted Plan' }}</td>
                                                <td class="fw-800">₹{{ number_format($payment->amount, 2) }}</td>
                                                <td>
                                                    @php
                                                        $pColor = $payment->status == 'success' ? 'success' : ($payment->status == 'pending' ? 'warning' : 'danger');
                                                    @endphp
                                                    <span class="badge bg-{{ $pColor }}-light text-{{ $pColor }} rounded-pill px-3 fw-700">
                                                        {{ strtoupper($payment->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr><td colspan="4" class="text-center py-4 text-muted">No billing records.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-600 { font-weight: 600; }
    .fw-700 { font-weight: 700; }
    .fw-800 { font-weight: 800; }
    
    .bg-primary-light { background-color: rgba(13, 110, 253, 0.1); }
    .bg-success-light { background-color: rgba(25, 135, 84, 0.1); }
    .bg-warning-light { background-color: rgba(255, 193, 7, 0.1); }
    .bg-info-light { background-color: rgba(13, 202, 240, 0.1); }
    .bg-danger-light { background-color: rgba(220, 53, 69, 0.1); }

    .custom-pills .nav-link {
        color: #6c757d;
        border-radius: 10px;
        padding: 10px 20px;
        margin-right: 5px;
        margin-bottom: 10px;
    }
    .custom-pills .nav-link.active {
        background-color: #ef7f1a;
        color: white;
    }
    .custom-pills .nav-link:hover:not(.active) {
        background-color: #f8f9fa;
        color: #ef7f1a;
    }

    .bg-light-hover:hover {
        background-color: #f0f2f5 !important;
        transition: all 0.2s ease;
    }
    
    .shadow-xs { box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.05); }

    .breadcrumb-item + .breadcrumb-item::before {
        content: "\F285";
        font-family: "bootstrap-icons";
        font-size: 10px;
        color: #adb5bd;
    }
    .breadcrumb a {
        text-decoration: none;
        color: #ef7f1a;
        font-weight: 700;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var triggerTabList = [].slice.call(document.querySelectorAll('#profileTabs a'))
        triggerTabList.forEach(function (triggerEl) {
            var tabTrigger = new bootstrap.Tab(triggerEl)
            triggerEl.addEventListener('click', function (event) {
                event.preventDefault()
                tabTrigger.show()
            })
        })
    });
</script>
@endsection
