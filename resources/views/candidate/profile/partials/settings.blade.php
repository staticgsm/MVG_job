<div class="p-4">
    <div class="row">
        <div class="col-md-6">
            <div class="settings-card bg-white p-4 rounded-4 shadow-sm border border-light">
                <h5 class="fw-bold mb-4" style="color: #1a202c; font-size: 18px;">
                    <i class="bi bi-shield-lock text-primary me-2"></i> Change Password
                </h5>
                
                <form action="{{ route('candidate.profile.updatePassword') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="form-label">Current Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-key text-muted"></i></span>
                            <input type="password" name="current_password" class="form-control border-start-0" placeholder="Enter current password" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">New Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock text-muted"></i></span>
                            <input type="password" name="password" class="form-control border-start-0" placeholder="Min. 8 characters" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Confirm New Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock-check text-muted"></i></span>
                            <input type="password" name="password_confirmation" class="form-control border-start-0" placeholder="Repeat new password" required>
                        </div>
                    </div>
                    
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-profile-save">
                            Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="bg-light p-4 rounded-4 h-100">
                <h6 class="fw-bold mb-3" style="color: #64748b;">Password Requirements</h6>
                <ul class="list-unstyled mb-0" style="font-size: 13px; color: #718096; line-height: 1.8;">
                    <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> Minimum 8 characters long</li>
                    <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> Must match the confirmation field</li>
                    <li class="mb-2"><i class="bi bi-check2-circle text-success me-2"></i> Use a mix of letters, numbers & symbols</li>
                    <li><i class="bi bi-info-circle text-primary me-2"></i> You will be required to log in again after changing your password for security.</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<style>
    .settings-card {
        transition: transform 0.2s ease;
    }
    .input-group-text {
        border-radius: 10px 0 0 10px;
    }
    .form-control {
        border-radius: 0 10px 10px 0;
    }
</style>
