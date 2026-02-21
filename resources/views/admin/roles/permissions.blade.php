@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800 fw-700">Role Permissions</h1>
            <p class="text-muted small mb-0">Managing Access Control for: <span class="text-base-color fw-700">{{ $role->name }}</span></p>
        </div>
        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary btn-sm shadow-sm border">
            <i class="fas fa-arrow-left me-2"></i> Back to Roles
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 mb-4 overflow-hidden">
        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-base-color"><i class="bi bi-shield-check me-2"></i>Configure Access Matrix</h6>
            <div class="text-muted small fw-600">
                <i class="bi bi-info-circle-fill me-1"></i> Permissions are applied instantly upon saving.
            </div>
        </div>
        <div class="card-body p-4 p-md-5 bg-light-soft">
            <form action="{{ route('roles.permissions.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-4">
                    @php
                        $permissionGroups = $permissions->groupBy(function($item) { 
                            return explode('.', $item->slug)[0]; // Changed name to slug based on controller check
                        });
                    @endphp

                    @foreach($permissionGroups as $group => $items)
                        <div class="col-md-6 col-xl-4">
                            <div class="permission-card border-0 shadow-sm rounded-4 h-100 bg-white overflow-hidden">
                                <div class="bg-soft-secondary px-4 py-3 border-bottom d-flex justify-content-between align-items-center">
                                    <h6 class="mb-0 fw-700 text-dark text-uppercase small letter-spacing-1">
                                        {{ ucfirst($group) }} Control
                                    </h6>
                                    <span class="badge bg-white text-dark-gray border small shadow-sm">{{ $items->count() }} Key(s)</span>
                                </div>
                                <div class="p-4">
                                    @foreach($items as $permission)
                                        <div class="form-check custom-checkbox mb-3 border-bottom pb-2 border-light-soft">
                                            <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                                                id="perm_{{ $permission->id }}" {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                            <label class="form-check-label text-dark fs-14 fw-500 cursor-pointer d-flex justify-content-between" for="perm_{{ $permission->id }}">
                                                <span>{{ ucwords(str_replace(['.', '_'], ' ', str_replace($group . '.', '', $permission->slug))) }}</span>
                                                @if($role->permissions->contains($permission->id))
                                                    <i class="bi bi-check-lg text-success ms-2 fs-12"></i>
                                                @endif
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-5 pt-4 border-top d-flex gap-3">
                    <button type="submit" class="btn btn-base-color px-5 py-2 fw-700 shadow-sm">
                        <i class="bi bi-check2-circle me-2"></i> Update Role Permissions
                    </button>
                    <a href="{{ route('roles.index') }}" class="btn btn-light px-5 py-2 fw-600 border">Cancel</a>
                    
                    @if($role->slug === 'super_admin')
                        <div class="ms-auto pt-2">
                            <span class="text-danger small fw-600"><i class="bi bi-exclamation-triangle-fill me-1"></i> Proceed with caution: This is a system role.</span>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .fw-700 { font-weight: 700; }
    .fw-600 { font-weight: 600; }
    .fw-500 { font-weight: 500; }
    .fs-12 { font-size: 12px; }
    .fs-14 { font-size: 14px; }
    .letter-spacing-1 { letter-spacing: 1px; }
    .text-base-color { color: #ef7f1a !important; }
    .bg-light-soft { background-color: #f9f9fb; }
    .bg-soft-secondary { background-color: #f4f6f9; }
    .border-light-soft { border-color: #f1f3f5 !important; }
    .cursor-pointer { cursor: pointer; }
    
    .permission-card { transition: transform 0.2s, box-shadow 0.2s; border: 1px solid transparent !important; }
    .permission-card:hover { transform: translateY(-3px); box-shadow: 0 .5rem 1rem rgba(0,0,0,.1) !important; border-color: #ef7f1a !important; }
    
    .form-check-input:checked { background-color: #ef7f1a; border-color: #ef7f1a; }
    .form-check-input { width: 1.2em; height: 1.2em; margin-top: 0.2em; }
    .custom-checkbox:hover .form-check-label { color: #ef7f1a !important; }
</style>
@endsection
