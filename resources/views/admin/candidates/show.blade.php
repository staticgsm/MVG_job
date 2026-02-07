@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>{{ $candidate->name }} - Profile</h2>
        <a href="{{ route('admin.candidates.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    <div class="row">
        <!-- Personal Info & Subscription -->
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white">
                    Personal Details
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> {{ $candidate->email }}</p>
                    <p><strong>Mobile:</strong> {{ $candidate->mobile }}</p>
                    <p><strong>Registered:</strong> {{ $candidate->created_at->format('d M, Y') }}</p>
                    <hr>
                    @if($candidate->candidateProfile)
                        <p><strong>DOB:</strong> {{ $candidate->candidateProfile->dob ? $candidate->candidateProfile->dob->format('d M, Y') : 'N/A' }}</p>
                        <p><strong>Gender:</strong> {{ $candidate->candidateProfile->gender ?? 'N/A' }}</p>
                        <p><strong>Location:</strong> {{ $candidate->candidateProfile->city }}, {{ $candidate->candidateProfile->state }}</p>
                        <p><strong>Resume:</strong> 
                            @if($candidate->candidateProfile->resume_path)
                                <a href="{{ Storage::url($candidate->candidateProfile->resume_path) }}" target="_blank">Download</a>
                            @else
                                <span class="text-muted">Not uploaded</span>
                            @endif
                        </p>
                    @else
                        <p class="text-muted">Profile incomplete.</p>
                    @endif
                </div>
            </div>

            <div class="card shadow mb-4">
                 <div class="card-header bg-success text-white">
                     Subscription Status
                 </div>
                 <div class="card-body">
                     @if($candidate->subscription)
                         <h5 class="text-success">{{ $candidate->subscription->subscriptionPlan->name }}</h5>
                         <p><strong>Active Since:</strong> {{ $candidate->subscription->start_date->format('d M, Y') }}</p>
                         <p><strong>Expires On:</strong> {{ $candidate->subscription->end_date->format('d M, Y') }}</p>
                         <span class="badge bg-success">Active</span>
                     @else
                         <p class="text-danger">No Active Subscription</p>
                     @endif
                 </div>
            </div>
        </div>

        <!-- Details Tabs -->
        <div class="col-md-8">
            <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="education-tab" data-toggle="tab" href="#education" role="tab">Education</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="experience-tab" data-toggle="tab" href="#experience" role="tab">Experience</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="skills-tab" data-toggle="tab" href="#skills" role="tab">Skills</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" id="applications-tab" data-toggle="tab" href="#applications" role="tab">Applications</a>
                </li>
            </ul>
            <div class="tab-content border border-top-0 p-3 bg-white shadow-sm" id="profileTabsContent">
                
                <!-- Education -->
                <div class="tab-pane fade show active" id="education" role="tabpanel">
                    @forelse($candidate->candidateEducations as $edu)
                        <div class="mb-3 border-bottom pb-2">
                            <h5>{{ $edu->course_name }} <small class="text-muted">({{ $edu->passing_year }})</small></h5>
                            <p class="mb-0">{{ $edu->institute_name }} - {{ $edu->university_board }}</p>
                            <small>Marks: {{ $edu->marks_percentage }}%</small>
                        </div>
                    @empty
                        <p class="text-muted">No education details found.</p>
                    @endforelse
                </div>

                <!-- Experience -->
                <div class="tab-pane fade" id="experience" role="tabpanel">
                    @forelse($candidate->candidateExperiences as $exp)
                        <div class="mb-3 border-bottom pb-2">
                            <h5>{{ $exp->designation }} at {{ $exp->company_name }}</h5>
                            <p class="mb-0 text-muted">{{ $exp->start_date->format('M Y') }} - {{ $exp->end_date ? $exp->end_date->format('M Y') : 'Present' }}</p>
                            <p class="small">{{ $exp->job_description }}</p>
                        </div>
                    @empty
                        <p class="text-muted">No experience details found.</p>
                    @endforelse
                </div>

                <!-- Skills -->
                <div class="tab-pane fade" id="skills" role="tabpanel">
                    <div class="d-flex flex-wrap">
                        @forelse($candidate->candidateSkills as $skill)
                            <span class="badge bg-secondary m-1 p-2">{{ $skill->skill_name }} ({{ $skill->skill_level }})</span>
                        @empty
                            <p class="text-muted">No skills listed.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Applications -->
                <div class="tab-pane fade" id="applications" role="tabpanel">
                     <table class="table table-sm">
                         <thead>
                             <tr>
                                 <th>Job Title</th>
                                 <th>Company</th>
                                 <th>Applied On</th>
                                 <th>Status</th>
                             </tr>
                         </thead>
                         <tbody>
                             @forelse($candidate->jobApplications as $app)
                                 <tr>
                                     <td>{{ $app->jobPost->title }}</td>
                                     <td>{{ $app->jobPost->company_name }}</td>
                                     <td>{{ $app->created_at->format('d M, Y') }}</td>
                                     <td><span class="badge bg-info text-dark">{{ ucfirst($app->status) }}</span></td>
                                 </tr>
                             @empty
                                 <tr><td colspan="4">No job applications found.</td></tr>
                             @endforelse
                         </tbody>
                     </table>
                </div>

            </div>
        </div>
    </div>
</div>

{{-- Bootstrap Tabs Script if not already loaded --}}
<script>
    var triggerTabList = [].slice.call(document.querySelectorAll('#profileTabs a'))
    triggerTabList.forEach(function (triggerEl) {
      var tabTrigger = new bootstrap.Tab(triggerEl)
  
      triggerEl.addEventListener('click', function (event) {
        event.preventDefault()
        tabTrigger.show()
      })
    })
</script>
@endsection
