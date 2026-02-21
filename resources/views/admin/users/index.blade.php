@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-700">User Management</h1>
        <a href="{{ route('users.create') }}" class="btn btn-base-color">
            <i class="fas fa-user-plus me-2"></i> Add New User
        </a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-base-color">Registered System Users</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>User Details</th>
                            <th>Role</th>
                            <th>Email Address</th>
                            <th>Created at</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm bg-light text-dark rounded-circle me-3 d-flex align-items-center justify-content-center fw-700 border">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="fw-700 text-dark">{{ $user->name }}</div>
                                </div>
                            </td>
                            <td>
                                @if($user->role)
                                    <span class="badge bg-light text-primary border"><i class="bi bi-shield-lock me-1"></i> {{ $user->role->name }}</span>
                                @else
                                    <span class="badge bg-light text-muted border">No Role</span>
                                @endif
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at ? $user->created_at->format('d M, Y') : 'N/A' }}</td>
                            <td class="text-end">
                                <div class="btn-group shadow-sm border-0 rounded">
                                    <a href="{{ route('users.edit', $user) }}" class="btn btn-white btn-sm" title="Edit User">
                                        <i class="bi bi-pencil-square text-primary"></i>
                                    </a>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this user account?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-white btn-sm" title="Delete User">
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
    .avatar-sm { width: 32px; height: 32px; font-size: 12px; }
</style>
@endsection
