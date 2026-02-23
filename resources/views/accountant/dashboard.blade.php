@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-700">Financial Overview</h1>
            <p class="text-muted small mb-0">Track revenue, manage subscriptions, and audit payments.</p>
        </div>
        <div class="d-flex gap-2">
            @can('payment.view')
            <a href="{{ route('admin.payments.export') }}" class="btn btn-base-color btn-sm px-3 shadow-sm">
                <i class="fas fa-file-export me-2"></i>Export Revenue Data
            </a>
            @endcan
        </div>
    </div>

    <div class="row">
        <!-- Revenue Card -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card stat-card h-100 border-0 shadow-sm overflow-hidden bg-gradient-primary text-white">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-white-50 small text-uppercase fw-600 mb-1">Total Platform Revenue</div>
                            <div class="h2 mb-0 fw-700">₹{{ number_format($stats['total_revenue'], 2) }}</div>
                        </div>
                        <div class="stat-icon-wrapper-light bg-white-10">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                    <div class="mt-4 small text-white-50">
                        <span class="text-white fw-600 me-1"><i class="fas fa-chart-line me-1"></i>Combined</span> revenue from all plans
                    </div>
                </div>
                <div class="stat-card-progress bg-white-20"></div>
            </div>
        </div>

        <!-- Placeholder for other financial stats -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card h-100 border-0 shadow-sm border-start border-4 border-info">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="rounded-circle bg-soft-info p-3 me-3">
                        <i class="fas fa-receipt text-info fa-lg"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-600">Active Subscriptions</div>
                        <div class="h4 mb-0 fw-700 text-dark">Monitoring Mode</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Payments Table -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between border-bottom">
            <h6 class="m-0 font-weight-bold text-base-color"><i class="fas fa-history me-2"></i>Recent Successful Transactions</h6>
            <span class="badge bg-light text-dark border small fw-600 py-2 px-3">Latest 5 Records</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small text-uppercase fw-600">
                        <tr>
                            <th class="ps-4">Transaction Details</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Date & Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stats['recent_payments'] as $payment)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center">
                                    <div class="icon-sm bg-soft-success text-success rounded me-3 d-flex align-items-center justify-content-center">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div>
                                        <div class="fw-700 text-dark mb-0 fs-14">{{ $payment->txnid }}</div>
                                        <div class="text-muted small">Subscription Payment</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="fw-600 text-dark">{{ $payment->user->name ?? 'N/A' }}</div>
                                <div class="text-muted small">{{ $payment->user->email ?? '-' }}</div>
                            </td>
                            <td>
                                <div class="fw-700 text-dark">₹{{ number_format($payment->amount, 2) }}</div>
                            </td>
                            <td>
                                <span class="badge bg-success-soft text-success border-success-soft fs-11">
                                    <i class="fas fa-check me-1"></i>Success
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <span class="text-muted small">{{ $payment->created_at->format('d M Y') }}</span><br>
                                <span class="text-dark-gray small fw-600">{{ $payment->created_at->format('h:i A') }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted italic">No recent transactions found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer bg-white border-0 py-3 text-center">
            <p class="text-muted small mb-0">Financial data is updated in real-time as payments are processed.</p>
        </div>
    </div>
</div>

<style>
    .fw-700 { font-weight: 700; }
    .fw-600 { font-weight: 600; }
    .fs-14 { font-size: 14px; }
    .fs-11 { font-size: 11px; }
    .text-base-color { color: #ef7f1a !important; }
    .bg-gradient-primary { background: linear-gradient(135deg, #ef7f1a 0%, #f7a048 100%); }
    .bg-white-10 { background: rgba(255,255,255,0.1); }
    .bg-white-20 { background: rgba(255,255,255,0.2); }
    
    .stat-card { transition: transform 0.2s ease; position: relative; }
    .stat-card:hover { transform: translateY(-3px); }
    
    .stat-icon-wrapper-light {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .bg-soft-info { background-color: rgba(13, 202, 240, 0.1); }
    .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); }
    
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1) !important; }
    .border-success-soft { border: 1px solid rgba(25, 135, 84, 0.2); }
    
    .stat-card-progress { height: 4px; width: 100%; position: absolute; bottom: 0; left: 0; }
    
    .icon-sm { width: 32px; height: 32px; }
    .text-dark-gray { color: #444; }
</style>
@endsection
