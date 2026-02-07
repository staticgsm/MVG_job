<form action="{{ route('candidate.profile.updateEducation') }}" method="POST" id="educationForm">
    @csrf
    <div id="education-fields">
        @foreach($educations as $index => $education)
            <div class="education-row border p-3 mb-3 rounded position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-education" aria-label="Close"></button>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Education Level</label>
                        <select class="form-select" name="education_level[]" required>
                            <option value="">Select Level</option>
                            @foreach(['X', 'XII', 'Diploma', 'Graduation', 'Post Graduation', 'Other'] as $level)
                                <option value="{{ $level }}" {{ $education->education_level == $level ? 'selected' : '' }}>{{ $level }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Course Name</label>
                        <input type="text" class="form-control" name="course_name[]" value="{{ $education->course_name }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Institute Name</label>
                        <input type="text" class="form-control" name="institute_name[]" value="{{ $education->institute_name }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">University / Board</label>
                        <input type="text" class="form-control" name="university_board[]" value="{{ $education->university_board }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Marks (%)</label>
                        <input type="text" class="form-control" name="marks_percentage[]" value="{{ $education->marks_percentage }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Passing Year</label>
                        <input type="text" class="form-control" name="passing_year[]" value="{{ $education->passing_year }}" required>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <button type="button" class="btn btn-secondary mb-3" id="addEducation">Add Education</button>
    <button type="submit" class="btn btn-primary mb-3">Save Education Details</button>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('education-fields');
    const addButton = document.getElementById('addEducation');

    function createRow() {
        const div = document.createElement('div');
        div.className = 'education-row border p-3 mb-3 rounded position-relative';
        div.innerHTML = `
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-education" aria-label="Close"></button>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Education Level</label>
                    <select class="form-select" name="education_level[]" required>
                        <option value="">Select Level</option>
                        <option value="X">X</option>
                        <option value="XII">XII</option>
                        <option value="Diploma">Diploma</option>
                        <option value="Graduation">Graduation</option>
                        <option value="Post Graduation">Post Graduation</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Course Name</label>
                    <input type="text" class="form-control" name="course_name[]" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Institute Name</label>
                    <input type="text" class="form-control" name="institute_name[]" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">University / Board</label>
                    <input type="text" class="form-control" name="university_board[]" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Marks (%)</label>
                    <input type="text" class="form-control" name="marks_percentage[]" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Passing Year</label>
                    <input type="text" class="form-control" name="passing_year[]" required>
                </div>
            </div>
        `;
        container.appendChild(div);
    }

    addButton.addEventListener('click', createRow);

    container.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-education')) {
            e.target.closest('.education-row').remove();
        }
    });

    if (container.children.length === 0) {
        createRow();
    }
});
</script>
