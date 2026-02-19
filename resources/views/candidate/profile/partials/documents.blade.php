<form action="{{ route('candidate.profile.updateDocuments') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="alert alert-info small">
        <strong>Note:</strong> Allowed formats: PDF. Max size: 2MB per file.
    </div>

    <div class="row">
        <div class="col-md-6 mb-4">
            <h6 class="fw-bold">Aadhaar Card</h6>
            <input type="file" class="form-control mb-2" name="aadhaar_doc" accept=".pdf">
            @if($profile->aadhaar_doc_path)
                <div class="d-flex align-items-center">
                    <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                    <a href="{{ Storage::url($profile->aadhaar_doc_path) }}" target="_blank" class="text-decoration-none">View Uploaded Aadhaar</a>
                </div>
            @else
                <small class="text-muted">Not uploaded yet</small>
            @endif
        </div>

        <div class="col-md-6 mb-4">
            <h6 class="fw-bold">Educational Certificate (Degree/Marksheet)</h6>
            <input type="file" class="form-control mb-2" name="education_doc" accept=".pdf">
            @if($profile->education_doc_path)
                <div class="d-flex align-items-center">
                    <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                    <a href="{{ Storage::url($profile->education_doc_path) }}" target="_blank" class="text-decoration-none">View Uploaded Certificate</a>
                </div>
            @else
                <small class="text-muted">Not uploaded yet</small>
            @endif
        </div>

        <div class="col-md-6 mb-4">
            <h6 class="fw-bold">Bank Passbook / Cheque</h6>
            <input type="file" class="form-control mb-2" name="bank_doc" accept=".pdf">
            @if($profile->bank_doc_path)
                <div class="d-flex align-items-center">
                    <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                    <a href="{{ Storage::url($profile->bank_doc_path) }}" target="_blank" class="text-decoration-none">View Uploaded Passbook</a>
                </div>
            @else
                <small class="text-muted">Not uploaded yet</small>
            @endif
        </div>

        <div class="col-md-6 mb-4">
            <h6 class="fw-bold">Resume / CV</h6>
            <input type="file" class="form-control mb-2" name="resume" accept=".pdf">
            @if($profile->resume_path)
                <div class="d-flex align-items-center">
                    <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                    <a href="{{ Storage::url($profile->resume_path) }}" target="_blank" class="text-decoration-none">View Uploaded Resume</a>
                </div>
            @else
                <small class="text-muted">Not uploaded yet</small>
            @endif
        </div>
    </div>

    <hr>
    <button type="submit" class="btn btn-primary">Save & Upload Documents</button>
</form>
