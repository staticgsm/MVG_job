<form action="{{ route('candidate.profile.updatePersonal') }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $profile->first_name ?? '') }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $profile->last_name ?? '') }}" required>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" name="dob" value="{{ old('dob', $profile->dob ?? '') }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male" {{ old('gender', $profile->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender', $profile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ old('gender', $profile->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="text" class="form-control" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" required>
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" name="address" rows="3" required>{{ old('address', $profile->address ?? '') }}</textarea>
    </div>
    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="city" class="form-label">City</label>
            <input type="text" class="form-control" name="city" value="{{ old('city', $profile->city ?? '') }}" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="state" class="form-label">State</label>
            <input type="text" class="form-control" name="state" value="{{ old('state', $profile->state ?? '') }}" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="country" class="form-label">Country</label>
            <input type="text" class="form-control" name="country" value="{{ old('country', $profile->country ?? '') }}" required>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Save Personal Details</button>
</form>
