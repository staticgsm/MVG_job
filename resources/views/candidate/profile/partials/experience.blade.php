<form action="{{ route('candidate.profile.updateExperience') }}" method="POST" id="experienceForm">
    @csrf

    <div class="mb-4 p-3 bg-light border rounded">
        <div class="mb-3">
            <label for="experience" class="form-label fw-bold">Experience Summary</label>
            <textarea class="form-control" name="experience" rows="3" placeholder="Briefly describe your overall experience (e.g. 2 years in teaching)...">{{ old('experience', $profile->experience ?? '') }}</textarea>
        </div>
        
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="has_no_experience" id="has_no_experience" value="1" {{ old('has_no_experience', $profile->has_no_experience ?? false) ? 'checked' : '' }}>
            <label class="form-check-label" for="has_no_experience">
                I do not have any work experience (Fresher)
            </label>
        </div>
    </div>

    <div id="experience-section">
        <h5 class="mb-3">Work History</h5>
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
    </div> <!-- End experience-section -->
    
    <button type="button" class="btn btn-secondary mb-3" id="addExperience">Add Experience</button>
    <button type="submit" class="btn btn-profile-save w-100 mt-3">Save Experience Details & Continue</button>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('experience-fields');
    const addButton = document.getElementById('addExperience');
    const noExpCheckbox = document.getElementById('has_no_experience');
    const experienceSection = document.getElementById('experience-section');
    const saveButton = document.querySelector('#experienceForm button[type="submit"]'); // Adjust selector if needed

    function toggleExperienceFields() {
        if (noExpCheckbox.checked) {
            experienceSection.style.display = 'none';
            addButton.style.display = 'none';
        } else {
            experienceSection.style.display = 'block';
            addButton.style.display = 'inline-block';
        }
    }

    noExpCheckbox.addEventListener('change', toggleExperienceFields);
    
    // Initial State checks
    toggleExperienceFields();

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
