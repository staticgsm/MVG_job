@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Create Subscription Plan</h2>
        <a href="{{ route('admin.subscription-plans.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="card shadow-lg mx-auto" style="max-width: 600px;">
        <div class="card-body p-5">
            <form action="{{ route('admin.subscription-plans.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Plan Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                         <label for="price" class="form-label">Price (INR)</label>
                         <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                         @error('price')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                         <label for="duration_days" class="form-label">Duration (Days)</label>
                         <input type="number" class="form-control @error('duration_days') is-invalid @enderror" id="duration_days" name="duration_days" value="{{ old('duration_days') }}" required>
                         @error('duration_days')
                             <div class="invalid-feedback">{{ $message }}</div>
                         @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active Plan</label>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-lg">Create Plan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
