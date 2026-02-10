@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">All Applications</h1>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Sr No</th>
                        <th>Job Code</th>
                        <th>Job Title</th>
                        <th>Applicant</th>
                        <th>Email</th>
                        <th>Applied On</th>
                        <th>Status</th>
                        <th>Resume</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applications as $key => $application)
                    <tr>
                        <td>{{ $applications->firstItem() + $key }}</td>
                        <td><strong>{{ $application->jobPost->job_code }}</strong></td>
                        <td>{{ $application->jobPost->title }}</td>
                        <td>{{ $application->user->name }}</td>
                        <td>{{ $application->user->email }}</td>
                        <td>{{ $application->created_at->format('d M Y') }}</td>
                        <td>
                            <span class="badge @if($application->status == 'Applied') bg-warning text-dark 
                                @elseif($application->status == 'Shortlisted') bg-primary 
                                @elseif($application->status == 'Interview Scheduled') bg-info 
                                @else bg-danger @endif">
                                {{ $application->status }}
                            </span>
                        </td>
                        <td>
                            @if($application->user->candidateProfile && $application->user->candidateProfile->resume_path)
                                <div class="btn-group" role="group">
                                    <a href="{{ route('hr.applications.resume.view', $application->id) }}" target="_blank" class="btn btn-sm btn-info text-white" title="View Resume">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('hr.applications.resume.download', $application->id) }}" class="btn btn-sm btn-secondary" title="Download Resume">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateStatusModal{{ $application->id }}">
                                Update Status
                            </button>

                            <!-- Update Status Modal -->
                            <div class="modal fade" id="updateStatusModal{{ $application->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('hr.applications.update', $application->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Update Application Status</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status</label>
                                                    <select name="status" class="form-select" required>
                                                        <option value="Applied" {{ $application->status == 'Applied' ? 'selected' : '' }}>Applied</option>
                                                        <option value="Shortlisted" {{ $application->status == 'Shortlisted' ? 'selected' : '' }}>Shortlisted</option>
                                                        <option value="Interview Scheduled" {{ $application->status == 'Interview Scheduled' ? 'selected' : '' }}>Interview Scheduled</option>
                                                        <option value="Rejected" {{ $application->status == 'Rejected' ? 'selected' : '' }}>Rejected</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="remarks" class="form-label">Remarks</label>
                                                    <textarea name="remarks" class="form-control" rows="3">{{ $application->remarks }}</textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $applications->links() }}
    </div>
</div>
@endsection
