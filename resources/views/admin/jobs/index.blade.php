@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Job Management</h1>
        @if(auth()->user()->hasPermission('job.create'))
            <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary">Post New Job</a>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Department</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Posted On</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                        <tr>
                            <td>{{ $job->title }}</td>
                            <td>{{ $job->department }}</td>
                            <td>{{ $job->location }}</td>
                            <td>
                                @if($job->status == 'Open')
                                    <span class="badge bg-success">Open</span>
                                @else
                                    <span class="badge bg-danger">Closed</span>
                                @endif
                            </td>
                            <td>{{ $job->created_at->format('d M Y') }}</td>
                            <td>
                                @if(auth()->user()->hasPermission('job.edit'))
                                    <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $jobs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
