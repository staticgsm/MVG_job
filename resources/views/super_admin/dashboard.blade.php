@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-700">Super Admin Dashboard</h1>
            <p class="text-muted small mb-0">Overview of system-wide performance and management.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('super_admin.settings.index') }}" class="btn btn-white btn-sm shadow-sm border">
                <i class="fas fa-cog me-1"></i> System Settings
            </a>
            <a href="{{ route('payments.export') }}" class="btn btn-base-color btn-sm shadow-sm">
                <i class="fas fa-download me-1"></i> Export Revenue
            </a>
        </div>
    </div>

    <!-- Stats Cards Row -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 border-0 shadow-sm overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-muted small text-uppercase fw-600 mb-1">Total Platform Users</div>
                            <div class="h3 mb-0 fw-700 text-dark">{{ number_format($stats['users_count']) }}</div>
                        </div>
                        <div class="stat-icon-wrapper bg-soft-primary">
                            <i class="fas fa-users-cog text-primary"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-muted">
                        <span class="text-success fw-600 me-1"><i class="fas fa-user-tie me-1"></i>{{ $stats['admin_count'] }}</span> Admins & 
                        <span class="text-info fw-600 ms-1"><i class="fas fa-user-md me-1"></i>{{ $stats['hr_count'] }}</span> HR Staff
                    </div>
                </div>
                <div class="stat-card-progress bg-primary"></div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 border-0 shadow-sm overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-muted small text-uppercase fw-600 mb-1">Job Opportunities</div>
                            <div class="h3 mb-0 fw-700 text-dark">{{ number_format($stats['jobs_count']) }}</div>
                        </div>
                        <div class="stat-icon-wrapper bg-soft-success">
                            <i class="fas fa-briefcase text-success"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-muted">
                        <span class="text-success fw-600 me-2"><i class="fas fa-check-circle me-1"></i>Active Listings</span>
                    </div>
                </div>
                <div class="stat-card-progress bg-success"></div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 border-0 shadow-sm overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-muted small text-uppercase fw-600 mb-1">Total Submissions</div>
                            <div class="h3 mb-0 fw-700 text-dark">{{ number_format($stats['applications_count']) }}</div>
                        </div>
                        <div class="stat-icon-wrapper bg-soft-info">
                            <i class="fas fa-file-invoice text-info"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-muted">
                        <span class="text-info fw-600 me-2"><i class="fas fa-clock me-1"></i>Candidate Applications</span>
                    </div>
                </div>
                <div class="stat-card-progress bg-info"></div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 border-0 shadow-sm overflow-hidden">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div class="text-muted small text-uppercase fw-600 mb-1">Subscription Revenue</div>
                            <div class="h3 mb-0 fw-700 text-dark">₹{{ number_format($stats['total_revenue'], 2) }}</div>
                        </div>
                        <div class="stat-icon-wrapper bg-soft-warning">
                            <i class="fas fa-coins text-warning"></i>
                        </div>
                    </div>
                    <div class="mt-3 small text-muted">
                        <span class="text-warning fw-600 me-2"><i class="fas fa-receipt me-1"></i>Successful Plan Earnings</span>
                    </div>
                </div>
                <div class="stat-card-progress bg-warning"></div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Users Table -->
        <div class="col-xl-8 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-base-color"><i class="fas fa-user-clock me-2"></i>Recently Registered Users</h6>
                    <a href="{{ route('users.index') }}" class="btn btn-link btn-sm text-decoration-none">View All Users</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light text-muted small text-uppercase">
                                <tr>
                                    <th class="ps-4">User</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Joined Date</th>
                                    <th class="text-end pe-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentUsers as $user)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-soft-secondary text-secondary rounded-circle me-3 d-flex align-items-center justify-content-center fw-700 border">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-700 text-dark mb-0 fs-14">{{ $user->name }}</div>
                                                <div class="text-muted small">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-soft-info text-info border-soft-info fs-11">
                                            {{ $user->role->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($user->status)
                                            <span class="badge bg-success-soft text-success fs-11"><i class="fas fa-check-circle me-1"></i>Active</span>
                                        @else
                                            <span class="badge bg-danger-soft text-danger fs-11"><i class="fas fa-times-circle me-1"></i>Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-muted fs-13">{{ $user->created_at ? $user->created_at->format('d M, Y') : 'N/A' }}</td>
                                    <td class="text-end pe-4">
                                        <a href="{{ route('users.edit', $user) }}" class="btn btn-white btn-sm px-2 border"><i class="fas fa-edit text-primary"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Access Sidebar -->
        <div class="col-xl-4 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white py-3">
                    <h6 class="m-0 font-weight-bold text-base-color"><i class="fas fa-bolt me-2"></i>System Management</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('users.create') }}" class="management-link p-3 rounded-3 border d-flex align-items-center text-decoration-none transition-base shadow-sm-hover">
                            <div class="icon-circle bg-soft-primary text-primary me-3"><i class="fas fa-user-plus"></i></div>
                            <div>
                                <div class="fw-700 text-dark mb-0">Onboard New User</div>
                                <div class="text-muted small">Create staff or admin accounts</div>
                            </div>
                        </a>
                        <a href="{{ route('roles.index') }}" class="management-link p-3 rounded-3 border d-flex align-items-center text-decoration-none transition-base shadow-sm-hover">
                            <div class="icon-circle bg-soft-info text-info me-3"><i class="fas fa-shield-alt"></i></div>
                            <div>
                                <div class="fw-700 text-dark mb-0">Role Permissions</div>
                                <div class="text-muted small">Manage access control levels</div>
                            </div>
                        </a>
                        <a href="{{ route('super_admin.settings.index') }}" class="management-link p-3 rounded-3 border d-flex align-items-center text-decoration-none transition-base shadow-sm-hover">
                            <div class="icon-circle bg-soft-warning text-warning me-3"><i class="fas fa-tools"></i></div>
                            <div>
                                <div class="fw-700 text-dark mb-0">System Settings</div>
                                <div class="text-muted small">Config Mail, Notifications & Global Params</div>
                            </div>
                        </a>
                        <a href="{{ route('permissions.index') }}" class="management-link p-3 rounded-3 border d-flex align-items-center text-decoration-none transition-base shadow-sm-hover">
                            <div class="icon-circle bg-soft-danger text-danger me-3"><i class="fas fa-key"></i></div>
                            <div>
                                <div class="fw-700 text-dark mb-0">Permission Master</div>
                                <div class="text-muted small">Define system-level operation keys</div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="mt-4 pt-3 border-top">
                        <div class="alert bg-soft-info border-0 mb-0">
                            <div class="d-flex">
                                <i class="fas fa-info-circle text-info mt-1 me-2"></i>
                                <span class="fs-13 text-dark">Recent activities are logged for auditing and security purposes.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-700 { font-weight: 700; }
    .fw-600 { font-weight: 600; }
    .fs-11 { font-size: 11px; }
    .fs-13 { font-size: 13px; }
    .fs-14 { font-size: 14px; }
    .text-base-color { color: #ef7f1a !important; }
    .bg-soft-primary { background-color: rgba(13, 110, 253, 0.1); }
    .bg-soft-success { background-color: rgba(25, 135, 84, 0.1); }
    .bg-soft-info { background-color: rgba(13, 202, 240, 0.1); }
    .bg-soft-warning { background-color: rgba(255, 193, 7, 0.1); }
    .bg-soft-danger { background-color: rgba(220, 53, 69, 0.1); }
    .bg-soft-secondary { background-color: rgba(108, 117, 125, 0.1); }
    
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .bg-danger-soft { background-color: rgba(220, 53, 69, 0.1); }
    
    .stat-card { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); position: relative; }
    .stat-card:hover { transform: translateY(-5px); box-shadow: 0 1rem 3rem rgba(0,0,0,.1) !important; }
    
    .stat-icon-wrapper { width: 48px; height: 48px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; }
    .stat-card-progress { position: absolute; bottom: 0; left: 0; height: 4px; width: 0; transition: width 1s ease-in-out; }
    .stat-card:hover .stat-card-progress { width: 100%; }
    
    .avatar-sm { width: 36px; height: 36px; }
    .icon-circle { width: 40px; height: 40px; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
    
    .management-link { border-color: #f1f3f5 !important; background-color: #fff; color: inherit; }
    .management-link:hover { background-color: #f8f9fa; border-color: #dee2e6 !important; transform: translateX(5px); }
    .transition-base { transition: all 0.2s ease-in-out; }
    .shadow-sm-hover:hover { box-shadow: 0 .125rem .25rem rgba(0,0,0,.075) !important; }
</style>
@endsection
