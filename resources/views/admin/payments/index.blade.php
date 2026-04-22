@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-700">Verify Payments</h1>
        <p class="text-muted small">Verify manual payment screenshots and activate candidate subscriptions.</p>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Candidate</th>
                            <th>Plan</th>
                            <th>Amount</th>
                            <th>Screenshot</th>
                            <th>Date Uploaded</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($payments as $payment)
                            <tr>
                                <td>
                                    <div class="fw-bold">{{ $payment->user->name }}</div>
                                    <div class="text-muted small">{{ $payment->user->email }}</div>
                                </td>
                                <td>{{ $payment->subscriptionPlan->name }}</td>
                                <td><span class="fw-bold">₹{{ number_format($payment->amount, 2) }}</span></td>
                                <td>
                                    <a href="{{ Storage::url($payment->screenshot_path) }}" target="_blank" class="d-inline-block border p-1 rounded bg-light">
                                        <img src="{{ Storage::url($payment->screenshot_path) }}" alt="Screenshot" style="width: 50px; height: 50px; object-fit: cover;">
                                    </a>
                                </td>
                                <td>{{ $payment->updated_at->format('d M Y, h:i A') }}</td>
                                <td>
                                    @if($payment->status === 'pending')
                                        <span class="badge bg-warning">Pending Verification</span>
                                    @elseif($payment->status === 'success')
                                        <span class="badge bg-success">Approved</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    @if($payment->status === 'pending')
                                        <div class="d-flex gap-2">
                                            <form action="{{ route('admin.payments.approve', $payment) }}" method="POST" onsubmit="return confirm('Confirm activation for this candidate?')">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success px-3">
                                                    <i class="bi bi-check-circle me-1"></i> Approve
                                                </button>
                                            </form>
                                            
                                            <button type="button" class="btn btn-sm btn-outline-danger px-3" data-bs-toggle="modal" data-bs-target="#rejectModal{{ $payment->id }}">
                                                <i class="bi bi-x-circle me-1"></i> Reject
                                            </button>
                                        </div>

                                        {{-- Reject Modal --}}
                                        <div class="modal fade" id="rejectModal{{ $payment->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('admin.payments.reject', $payment) }}" method="POST">
                                                    @csrf
                                                    <div class="modal-content border-0 shadow">
                                                        <div class="modal-header bg-danger text-white border-0">
                                                            <h5 class="modal-title">Reject Payment</h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body p-4">
                                                            <div class="mb-3">
                                                                <label class="form-label">Reason for Rejection (Optional)</label>
                                                                <textarea name="notes" class="form-control" rows="3" placeholder="e.g. Screenshot blurry, amount mismatch..."></textarea>
                                                            </div>
                                                            <p class="small text-muted">The candidate will see this reason on their dashboard.</p>
                                                        </div>
                                                        <div class="modal-footer border-0">
                                                            <button type="button" class="btn btn-light" data-bs-modal="dismiss">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">Confirm Rejection</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                        <span class="text-muted small">No actions available</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                        No pending payments found.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($payments->hasPages())
            <div class="card-footer bg-white border-0 py-3">
                {{ $payments->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
