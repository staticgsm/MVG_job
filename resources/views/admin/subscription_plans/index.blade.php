@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-700">Subscription Plans</h1>
        <a href="{{ route('admin.subscription-plans.create') }}" class="btn btn-base-color">
            <i class="fas fa-plus me-2"></i> Create New Plan
        </a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-base-color">Management of Pricing Plans</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Plan ID</th>
                            <th>Name & Details</th>
                            <th>Pricing</th>
                            <th>Duration</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($plans as $plan)
                            <tr>
                                <td><span class="fw-700 text-dark">#PLN-{{ str_pad($plan->id, 3, '0', STR_PAD_LEFT) }}</span></td>
                                <td>
                                    <div class="fw-700 text-dark">{{ $plan->name }}</div>
                                    <div class="text-muted small">{{ Str::limit($plan->description, 60) }}</div>
                                </td>
                                <td>
                                    <div class="fw-700 text-success">₹{{ number_format($plan->price, 2) }}</div>
                                </td>
                                <td><i class="bi bi-clock me-1 text-muted"></i> {{ $plan->duration_days }} Days</td>
                                <td>
                                    @if($plan->is_active)
                                        <span class="badge bg-success"><i class="bi bi-check-circle-fill me-1"></i> Active</span>
                                    @else
                                        <span class="badge bg-danger"><i class="bi bi-x-circle-fill me-1"></i> Inactive</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="btn-group shadow-sm border-0 rounded">
                                        <a href="{{ route('admin.subscription-plans.edit', $plan) }}" class="btn btn-white btn-sm" title="Edit Plan">
                                            <i class="bi bi-pencil-square text-primary"></i>
                                        </a>
                                        <form action="{{ route('admin.subscription-plans.destroy', $plan) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this plan?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-white btn-sm" title="Delete Plan">
                                                <i class="bi bi-trash-fill text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">No subscription plans found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-white { background: #fff; border: 1px solid #eee; }
    .btn-white:hover { background: #f8f9fa; }
</style>
@endsection
