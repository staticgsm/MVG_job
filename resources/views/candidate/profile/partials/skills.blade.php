<form action="{{ route('candidate.profile.updateSkills') }}" method="POST" id="skillsForm">
    @csrf
    <div id="skills-fields">
        @foreach($skills as $index => $skill)
            <div class="skill-row border p-3 mb-3 rounded position-relative">
                <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-skill" aria-label="Close"></button>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Skill Name</label>
                        <select class="form-select" name="skill_name[]" required>
                            <option value="">Select Skill</option>
                            @foreach($masterSkills as $masterSkill)
                                <option value="{{ $masterSkill->name }}" {{ $skill->skill_name == $masterSkill->name ? 'selected' : '' }}>{{ $masterSkill->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Skill Level</label>
                        <select class="form-select" name="skill_level[]" required>
                            <option value="">Select Level</option>
                            @foreach(['Beginner', 'Intermediate', 'Advanced'] as $level)
                                <option value="{{ $level }}" {{ $skill->skill_level == $level ? 'selected' : '' }}>{{ $level }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Years of Experience</label>
                        <input type="text" class="form-control" name="years_of_experience[]" value="{{ $skill->years_of_experience }}" required>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <button type="button" class="btn btn-secondary mb-3" id="addSkill">Add Skill</button>
    <button type="submit" class="btn btn-primary mb-3">Save Skills</button>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('skills-fields');
    const addButton = document.getElementById('addSkill');
    const masterSkills = @json($masterSkills);

    function createRow() {
        // Build options for skill select
        let skillOptions = '<option value="">Select Skill</option>';
        masterSkills.forEach(skill => {
            skillOptions += `<option value="${skill.name}">${skill.name}</option>`;
        });

        const div = document.createElement('div');
        div.className = 'skill-row border p-3 mb-3 rounded position-relative';
        div.innerHTML = `
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2 remove-skill" aria-label="Close"></button>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Skill Name</label>
                    <select class="form-select" name="skill_name[]" required>
                        ${skillOptions}
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Skill Level</label>
                    <select class="form-select" name="skill_level[]" required>
                        <option value="">Select Level</option>
                        <option value="Beginner">Beginner</option>
                        <option value="Intermediate">Intermediate</option>
                        <option value="Advanced">Advanced</option>
                    </select>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Years of Experience</label>
                    <input type="text" class="form-control" name="years_of_experience[]" required>
                </div>
            </div>
        `;
        container.appendChild(div);
    }

    addButton.addEventListener('click', createRow);

    container.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-skill')) {
            e.target.closest('.skill-row').remove();
        }
    });

    if (container.children.length === 0) {
        createRow();
    }
});
</script>
