@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-700">Candidate Management</h1>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Dashboard
        </a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-base-color">Registered Candidates</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Candidate ID</th>
                            <th>Personal Info</th>
                            <th>Contact</th>
                            <th>Subscription</th>
                            <th>Registered At</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($candidates as $candidate)
                            <tr>
                                <td><span class="fw-700 text-dark">#C{{ str_pad($candidate->id, 4, '0', STR_PAD_LEFT) }}</span></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm bg-base-color-light text-base-color rounded-circle me-3 d-flex align-items-center justify-content-center fw-700">
                                            {{ strtoupper(substr($candidate->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-700 text-dark">{{ $candidate->name }}</div>
                                            <div class="text-muted small">{{ $candidate->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div><i class="bi bi-phone me-1 text-muted"></i> {{ $candidate->mobile }}</div>
                                </td>
                                <td>
                                    @if($candidate->subscription)
                                        <span class="badge bg-success">
                                            <i class="bi bi-patch-check-fill me-1"></i> {{ $candidate->subscription->subscriptionPlan->name }}
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="bi bi-x-circle-fill me-1"></i> Inactive
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $candidate->created_at ? $candidate->created_at->format('d M, Y') : 'N/A' }}</td>
                                <td class="text-end">
                                    <div class="btn-group shadow-sm border-0 rounded">
                                        <a href="{{ route('admin.candidates.show', $candidate) }}" class="btn btn-white btn-sm" title="View Profile">
                                            <i class="bi bi-eye-fill text-info"></i>
                                        </a>
                                        <form action="{{ route('admin.candidates.destroy', $candidate) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this candidate account?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-white btn-sm" title="Delete Candidate">
                                                <i class="bi bi-trash-fill text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">No candidates found in the system.</td>
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
    .btn-white { background: #fff; border: 1px solid #eee; }
    .btn-white:hover { background: #f8f9fa; }
    .bg-base-color-light { background-color: rgba(239, 127, 26, 0.1); }
    .avatar-sm { width: 35px; height: 35px; }
</style>
@endsection
