@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage Permissions: {{ $role->name }}</h1>
        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('roles.permissions.update', $role) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    @foreach($permissions as $permission)
                        <div class="col-md-3 mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="perm_{{ $permission->id }}"
                                    {{ $role->permissions->contains($permission->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="perm_{{ $permission->id }}">
                                    {{ $permission->name }} <br>
                                    <small class="text-muted">{{ $permission->slug }}</small>
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">Save Permissions</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
