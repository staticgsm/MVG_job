<form action="{{ route('candidate.profile.uploadResume') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label for="resume" class="form-label">Upload Resume (PDF, DOC, DOCX - Max 2MB)</label>
        <input type="file" class="form-control" name="resume" accept=".pdf,.doc,.docx" required>
    </div>
    
    @if($profile->resume_path)
        <div class="alert alert-info">
            <strong>Current Resume:</strong> 
            <a href="{{ Storage::url($profile->resume_path) }}" target="_blank">View Resume</a>
        </div>
    @endif

    <button type="submit" class="btn btn-primary">Upload Resume</button>
</form>
