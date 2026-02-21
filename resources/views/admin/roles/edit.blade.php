@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-700">Edit System Role</h1>
        <a href="{{ route('roles.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Back to Listing
        </a>
    </div>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white py-3">
            <h6 class="m-0 font-weight-bold text-base-color"><i class="bi bi-pencil-square me-2"></i>Role: {{ $role->name }}</h6>
        </div>
        <div class="card-body p-4 p-md-5">
            <form action="{{ route('roles.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $role->name) }}" placeholder="e.g. Manager, Support" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6 mb-4">
                        <label for="slug" class="form-label">Slug (System ID) <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $role->slug) }}" placeholder="e.g. manager" required {{ $role->slug === 'super_admin' ? 'readonly' : '' }}>
                        @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
                
                <div class="mt-4 pt-4 border-top">
                    <button type="submit" class="btn btn-base-color px-5 py-2">
                        <i class="bi bi-save me-2"></i> Save Changes
                    </button>
                    <a href="{{ route('roles.index') }}" class="btn btn-light px-5 py-2 ms-2">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
