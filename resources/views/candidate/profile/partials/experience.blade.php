<form action="{{ route('candidate.profile.updateExperience') }}" method="POST" id="experienceForm">
    @csrf
    <div id="experience-fields">
        @foreach($experiences as $index => $experience)
            <div class="experience-row border p-3 mb-3 rounded position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-experience" aria-label="Close"></button>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Company Name</label>
                        <input type="text" class="form-control" name="company_name[]" value="{{ $experience->company_name }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Designation</label>
                        <input type="text" class="form-control" name="designation[]" value="{{ $experience->designation }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Employment Type</label>
                        <select class="form-select" name="employment_type[]" required>
                            <option value="">Select Type</option>
                            @foreach(['Full-time', 'Part-time', 'Internship', 'Contract'] as $type)
                                <option value="{{ $type }}" {{ $experience->employment_type == $type ? 'selected' : '' }}>{{ $type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" class="form-control" name="start_date[]" value="{{ $experience->start_date }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">End Date (Leave empty if Current)</label>
                        <input type="date" class="form-control" name="end_date[]" value="{{ $experience->end_date }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Job Description</label>
                    <textarea class="form-control" name="job_description[]" rows="2">{{ $experience->job_description }}</textarea>
                </div>
            </div>
        @endforeach
    </div>
    
    <button type="button" class="btn btn-secondary mb-3" id="addExperience">Add Experience</button>
    <button type="submit" class="btn btn-primary mb-3">Save Experience Details</button>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('experience-fields');
    const addButton = document.getElementById('addExperience');

    function createRow() {
        const div = document.createElement('div');
        div.className = 'experience-row border p-3 mb-3 rounded position-relative';
        div.innerHTML = `
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-experience" aria-label="Close"></button>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Company Name</label>
                    <input type="text" class="form-control" name="company_name[]" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Designation</label>
                    <input type="text" class="form-control" name="designation[]" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Employment Type</label>
                    <select class="form-select" name="employment_type[]" required>
                        <option value="">Select Type</option>
                        <option value="Full-time">Full-time</option>
                        <option value="Part-time">Part-time</option>
                        <option value="Internship">Internship</option>
                        <option value="Contract">Contract</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" class="form-control" name="start_date[]" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">End Date (Leave empty if Current)</label>
                    <input type="date" class="form-control" name="end_date[]">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Job Description</label>
                <textarea class="form-control" name="job_description[]" rows="2"></textarea>
            </div>
        `;
        container.appendChild(div);
    }

    addButton.addEventListener('click', createRow);

    container.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-experience')) {
            e.target.closest('.experience-row').remove();
        }
    });

    if (container.children.length === 0) {
        createRow();
    }
});
</script>
