<form action="{{ route('candidate.profile.updatePersonal') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="mb-4">
        <label class="form-label">Photo (Passport Size)</label>
        <input type="file" class="form-control" name="photo" accept="image/*">
        @if($profile->photo_path)
            <div class="mt-2">
                <img src="{{ Storage::url($profile->photo_path) }}" alt="Profile Photo" class="img-thumbnail" style="width: 150px;">
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $profile->first_name ?? '') }}" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="middle_name" class="form-label">Middle Name</label>
            <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name', $profile->middle_name ?? '') }}">
        </div>
        <div class="col-md-4 mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $profile->last_name ?? '') }}" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="dob" class="form-label">Date of Birth</label>
            <input type="date" class="form-control" name="dob" value="{{ old('dob', $profile->dob ? $profile->dob->format('Y-m-d') : '') }}" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male" {{ old('gender', $profile->gender ?? '') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender', $profile->gender ?? '') == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ old('gender', $profile->gender ?? '') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label for="category" class="form-label">Category</label>
            <select class="form-select" name="category" required>
                <option value="">Select Category</option>
                @foreach(['SC', 'ST', 'OBC', 'NT', 'VJNT', 'OPEN'] as $cat)
                    <option value="{{ $cat }}" {{ old('category', $profile->category ?? '') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="phone" class="form-label">Phone Number</label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="aadhaar_no" class="form-label">Aadhaar Number</label>
            <input type="text" class="form-control" name="aadhaar_no" value="{{ old('aadhaar_no', $profile->aadhaar_no ?? '') }}" required>
        </div>
    </div>

    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" name="address" rows="3" required>{{ old('address', $profile->address ?? '') }}</textarea>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label for="district" class="form-label">District</label>
            <select class="form-select" name="district" required>
                <option value="">Select District</option>
                @foreach(['Ahilyanagar', 'Akola', 'Amravati', 'Beed', 'Bhandara', 'Buldana', 'Chandrapur', 'Chhatrapati Sambhajinagar', 'Dharashiv', 'Dhule', 'Gadchiroli', 'Gondiya', 'Hingoli', 'Jalgaon', 'Jalna', 'Kolhapur', 'Latur', 'Mumbai City', 'Mumbai Suburban', 'Nagpur', 'Nanded', 'Nandurbar', 'Nashik', 'Parbhani', 'Pune', 'Raigad', 'Ratnagiri', 'Sangli', 'Satara', 'Sindhudurg', 'Solapur', 'Thane', 'Wardha', 'Washim', 'Yavatmal'] as $dist)
                     <option value="{{ $dist }}" {{ old('district', $profile->district ?? '') == $dist ? 'selected' : '' }}>{{ $dist }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 mb-3">
            <label for="taluka" class="form-label">Taluka</label>
            <input type="text" class="form-control" name="taluka" value="{{ old('taluka', $profile->taluka ?? '') }}" required>
        </div>
        <div class="col-md-4 mb-3">
            <label for="city" class="form-label">City/Village</label>
            <input type="text" class="form-control" name="city" value="{{ old('city', $profile->city ?? '') }}" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="state" class="form-label">State</label>
            <input type="text" class="form-control" name="state" value="{{ old('state', $profile->state ?? 'Maharashtra') }}" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="country" class="form-label">Country</label>
            <input type="text" class="form-control" name="country" value="{{ old('country', $profile->country ?? 'India') }}" required>
        </div>
    </div>

    <button type="submit" class="btn btn-profile-save w-100 mt-4">Save Personal Details & Continue</button>
</form>
