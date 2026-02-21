@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-700">Role Management</h1>
        <a href="{{ route('roles.create') }}" class="btn btn-base-color">
            <i class="fas fa-plus-circle me-2"></i> Create New Role
        </a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-base-color">System Access Roles</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Role ID</th>
                            <th>Role Name</th>
                            <th>User Count</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($roles as $role)
                        <tr>
                            <td><span class="fw-700 text-dark">#ROL-{{ $role->id }}</span></td>
                            <td>
                                <div class="fw-700 text-dark text-uppercase small letter-spacing-1">{{ $role->name }}</div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $role->users_count ?? 0 }} Users</span>
                            </td>
                            <td class="text-end">
                                <div class="btn-group shadow-sm border-0 rounded">
                                    <a href="{{ route('roles.edit', $role) }}" class="btn btn-white btn-sm" title="Edit Role">
                                        <i class="bi bi-pencil-square text-primary"></i>
                                    </a>
                                    <form action="{{ route('roles.destroy', $role) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this role?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-white btn-sm" title="Delete Role">
                                            <i class="bi bi-trash-fill text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-white { background: #fff; border: 1px solid #eee; }
    .btn-white:hover { background: #f8f9fa; }
    .letter-spacing-1 { letter-spacing: 1px; }
</style>
@endsection
