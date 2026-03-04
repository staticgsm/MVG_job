@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    {{-- Header --}}
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-700">Candidate Management</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary btn-sm rounded-pill">
                <i class="fas fa-arrow-left me-1"></i> Dashboard
            </a>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row mb-4">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius: 15px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-primary-light rounded-circle p-3 me-3">
                            <i class="bi bi-people fw-bold text-primary fs-4"></i>
                        </div>
                        <div>
                            <div class="text-uppercase fw-700 text-muted small letter-spacing-1">Total Candidates</div>
                            <div class="h3 mb-0 fw-800">{{ number_format($stats['total']) }}</div>
                        </div>
                    </div>
                </div>
                <div class="bg-primary" style="height: 4px; width: 100%;"></div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius: 15px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-success-light rounded-circle p-3 me-3">
                            <i class="bi bi-patch-check fw-bold text-success fs-4"></i>
                        </div>
                        <div>
                            <div class="text-uppercase fw-700 text-muted small letter-spacing-1">Subscribed</div>
                            <div class="h3 mb-0 fw-800">{{ number_format($stats['subscribed']) }}</div>
                        </div>
                    </div>
                </div>
                <div class="bg-success" style="height: 4px; width: 100%;"></div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100 overflow-hidden" style="border-radius: 15px;">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 bg-warning-light rounded-circle p-3 me-3">
                            <i class="bi bi-person-plus fw-bold text-warning fs-4"></i>
                        </div>
                        <div>
                            <div class="text-uppercase fw-700 text-muted small letter-spacing-1">New Today</div>
                            <div class="h3 mb-0 fw-800">{{ number_format($stats['new_today']) }}</div>
                        </div>
                    </div>
                </div>
                <div class="bg-warning" style="height: 4px; width: 100%;"></div>
            </div>
        </div>
    </div>

    {{-- Search & Filters --}}
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
        <div class="card-body py-4">
            <form action="{{ route('admin.candidates.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Search by name, email or mobile..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="subscription" class="form-select" onchange="this.form.submit()">
                        <option value="">All Subscription Status</option>
                        <option value="active" {{ request('subscription') == 'active' ? 'selected' : '' }}>Active Members</option>
                        <option value="inactive" {{ request('subscription') == 'inactive' ? 'selected' : '' }}>Inactive / Free</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="worker_type" class="form-select" onchange="this.form.submit()">
                        <option value="">All Worker Types</option>
                        <option value="Skilled" {{ request('worker_type') == 'Skilled' ? 'selected' : '' }}>Skilled</option>
                        <option value="Unskilled" {{ request('worker_type') == 'Unskilled' ? 'selected' : '' }}>Unskilled</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100 px-4">Search</button>
                    @if(request()->anyFilled(['search', 'subscription', 'worker_type']))
                        <a href="{{ route('admin.candidates.index') }}" class="btn btn-light" title="Clear Filters"><i class="bi bi-x-lg"></i></a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- Main Table --}}
    <div class="card shadow-sm border-0 mb-4" style="border-radius: 15px;">
        <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-dark">
                <i class="bi bi-list-task me-2 text-primary"></i>Registered Candidates
                @if($candidates->total() > 0)
                    <span class="badge bg-light text-dark ms-2">{{ $candidates->total() }} Total</span>
                @endif
            </h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr class="text-secondary small text-uppercase fw-700">
                            <th class="ps-4" style="width: 100px;">ID</th>
                            <th>Candidate Details</th>
                            <th>Status & Completion</th>
                            <th>Worker Type</th>
                            <th>Contact Info</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($candidates as $candidate)
                            @php
                                $profile = $candidate->candidateProfile;
                                $completion = $profile->profile_completion_percentage ?? 0;
                                $barColor = $completion > 70 ? 'bg-success' : ($completion > 30 ? 'bg-warning' : 'bg-danger');
                            @endphp
                            <tr>
                                <td class="ps-4">
                                    <span class="fw-700 text-muted small">#{{ str_pad($candidate->id, 4, '0', STR_PAD_LEFT) }}</span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm rounded-circle text-white d-flex align-items-center justify-content-center fw-800 me-3" 
                                             style="background: linear-gradient(135deg, #ef7f1a, #f5a623); width: 40px; height: 40px; font-size: 14px;">
                                            {{ strtoupper(substr($candidate->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-800 text-dark mb-0 fs-6">{{ $candidate->name }}</div>
                                            <div class="text-muted small"><i class="bi bi-envelope me-1"></i>{{ $candidate->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-1">
                                        @if($candidate->subscription)
                                            <span class="badge bg-success-light text-success rounded-pill px-3 py-1">
                                                <i class="bi bi-star-fill me-1"></i> {{ $candidate->subscription->subscriptionPlan->name }}
                                            </span>
                                        @else
                                            <span class="badge bg-light text-muted rounded-pill px-3 py-1">Free Tier</span>
                                        @endif
                                    </div>
                                    <div class="d-flex align-items-center" style="width: 140px;">
                                        <div class="progress flex-grow-1" style="height: 5px;">
                                            <div class="progress-bar {{ $barColor }}" role="progressbar" style="width: {{ $completion }}%"></div>
                                        </div>
                                        <span class="ms-2 small fw-700 text-muted">{{ $completion }}%</span>
                                    </div>
                                </td>
                                <td>
                                    @if($profile && $profile->worker_type == 'Skilled')
                                        <span class="badge bg-info-light text-info"><i class="bi bi-tools me-1"></i> Skilled</span>
                                    @elseif($profile && $profile->worker_type == 'Unskilled')
                                        <span class="badge bg-secondary-light text-muted"><i class="bi bi-person me-1"></i> Unskilled</span>
                                    @else
                                        <span class="text-muted small">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="small fw-700"><i class="bi bi-phone me-1 text-primary"></i>{{ $candidate->mobile }}</div>
                                    <div class="text-muted small mb-1"><i class="bi bi-calendar-event me-1"></i>{{ $candidate->created_at->format('d M, Y') }}</div>
                                    @if($candidate->last_login_at)
                                        <div class="text-muted small" title="Last Login IP: {{ $candidate->last_login_ip }}">
                                            <i class="bi bi-box-arrow-in-right me-1 text-info"></i>{{ $candidate->last_login_at->diffForHumans() }}
                                        </div>
                                    @endif
                                </td>
                                <td class="pe-4">
                                    <div class="dropdown">
                                        <button class="btn btn-light btn-sm rounded-circle d-flex align-items-center justify-content-center" type="button" data-bs-toggle="dropdown" style="width: 32px; height: 32px;">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-4">
                                            <li><a class="dropdown-item py-2" href="{{ route('admin.candidates.show', $candidate) }}"><i class="bi bi-eye-fill me-2 text-info"></i> View Details</a></li>
                                            <li><a class="dropdown-item py-2" href="{{ route('admin.candidates.edit', $candidate) }}"><i class="bi bi-pencil-square me-2 text-warning"></i> Edit Profile</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.candidates.destroy', $candidate) }}" method="POST" class="d-inline" onsubmit="return confirm('Permanent delete this candidate account?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item py-2 text-danger"><i class="bi bi-trash-fill me-2"></i> Delete Candidate</button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <div class="mb-3"><i class="bi bi-search fs-1"></i></div>
                                    <h5 class="fw-700">No Candidates Found</h5>
                                    <p class="mb-0">Try adjusting your filters or search terms.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($candidates->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $candidates->links() }}
            </div>
        @endif
    </div>
</div>

<style>
    .fw-700 { font-weight: 700; }
    .fw-800 { font-weight: 800; }
    .letter-spacing-1 { letter-spacing: 1px; }
    
    .bg-primary-light { background-color: rgba(13, 110, 253, 0.1); }
    .bg-success-light { background-color: rgba(25, 135, 84, 0.1); }
    .bg-warning-light { background-color: rgba(255, 193, 7, 0.1); }
    .bg-info-light { background-color: rgba(13, 202, 240, 0.1); }
    .bg-secondary-light { background-color: rgba(108, 117, 125, 0.1); }
    
    .table-hover tbody tr:hover {
        background-color: #fbfbfb;
    }
    
    .dropdown-item:active {
        background-color: #ef7f1a;
    }
    .form-select, .form-control {
        border-radius: 10px;
        padding: 0.6rem 1rem;
        border: 1px solid #e0e0e0;
    }
    .form-select:focus, .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(239, 127, 26, 0.1);
        border-color: #ef7f1a;
    }
    .btn-primary {
        background-color: #ef7f1a;
        border-color: #ef7f1a;
        border-radius: 10px;
        font-weight: 700;
    }
    .btn-primary:hover {
        background-color: #d16d14;
        border-color: #d16d14;
    }
</style>
@endsection
