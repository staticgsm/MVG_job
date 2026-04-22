@extends('layouts.frontend')

@section('title', 'Manual Payment - MVG Company')

@section('content')
<section class="bg-light pt-5 pb-5">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-0 py-4 text-center">
                        <h4 class="fw-bold mb-1">Complete Your Payment</h4>
                        <p class="text-muted mb-0">Follow the instructions below to activate your <strong>{{ $payment->subscriptionPlan->name }}</strong> plan</p>
                    </div>
                    
                    <div class="card-body p-4 p-md-5">
                        <div class="row g-4 mb-5">
                            <div class="col-md-6 text-center border-end">
                                <h6 class="fw-bold text-uppercase small text-muted mb-3">Option 1: Scan QR Code</h6>
                                <div class="bg-white p-3 d-inline-block rounded-3 border mb-3">
                                    {{-- Placeholder for QR Code --}}
                                    <div style="width: 180px; height: 180px; background: #f0f0f0; display: flex; align-items: center; justify-content: center; border: 2px dashed #ccc;">
                                        <div class="text-center">
                                            <i class="bi bi-qr-code" style="font-size: 50px; color: #999;"></i>
                                            <p class="small mb-0">Upload QR Image in Settings</p>
                                        </div>
                                    </div>
                                </div>
                                <p class="small text-muted">Scan with GPay, PhonePe, or any UPI app</p>
                            </div>
                            <div class="col-md-6 ps-md-4">
                                <h6 class="fw-bold text-uppercase small text-muted mb-3">Option 2: Bank Transfer</h6>
                                <div class="bg-solitude-blue p-4 rounded-3" style="background-color: #f0f7ff;">
                                    <p class="mb-2"><strong>Bank Name:</strong> MVG Bank India</p>
                                    <p class="mb-2"><strong>Account Name:</strong> MVG Services Pvt Ltd</p>
                                    <p class="mb-2"><strong>Account No:</strong> 123456789012</p>
                                    <p class="mb-2"><strong>IFSC Code:</strong> MVGB0001234</p>
                                    <p class="mb-0"><strong>Amount:</strong> <span class="text-primary fs-4 fw-bold">₹{{ number_format($payment->amount, 2) }}</span></p>
                                </div>
                            </div>
                        </div>

                        <div class="upload-section border-top pt-5">
                            <div class="text-center mb-4">
                                <h5 class="fw-bold">Upload Payment Screenshot</h5>
                                <p class="text-muted">Once you have made the payment, please upload the screenshot here for verification.</p>
                            </div>

                            <form action="{{ route('candidate.subscriptions.submitScreenshot', $payment) }}" method="POST" enctype="multipart/form-data" class="max-w-400 mx-auto">
                                @csrf
                                <div class="mb-4">
                                    <div class="file-drop-area border rounded-4 bg-white p-5 text-center position-relative" id="dropArea">
                                        <i class="bi bi-cloud-arrow-up fs-1 text-primary mb-3"></i>
                                        <p class="mb-2 fw-semibold">Click to upload or drag and drop</p>
                                        <p class="small text-muted mb-3">PNG, JPG or PDF (Max. 2MB)</p>
                                        <input type="file" name="screenshot" class="position-absolute translate-middle start-50 top-50 w-100 h-100 opacity-0" style="cursor: pointer;" required id="screenshotInput">
                                        <div id="fileInfo" class="mt-2 d-none">
                                            <span class="badge bg-success py-2 px-3"><i class="bi bi-check-circle me-1"></i> <span id="fileName">File selected</span></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-grid mt-5">
                                    <button type="submit" class="btn btn-primary btn-lg rounded-3 fw-bold py-3 shadow-sm" style="background: #ef7f1a; border: none;">
                                        Submit for Verification
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-light border-0 py-3 text-center">
                        <p class="small mb-0 text-muted"><i class="bi bi-info-circle me-1"></i> Admin will verify your payment within 24-48 hours. You will receive a notification once activated.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@section('extra_js')
<script>
    const input = document.getElementById('screenshotInput');
    const info = document.getElementById('fileInfo');
    const name = document.getElementById('fileName');
    const dropArea = document.getElementById('dropArea');

    input.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            info.classList.remove('d-none');
            name.textContent = e.target.files[0].name;
            dropArea.style.borderColor = '#ef7f1a';
            dropArea.style.backgroundColor = '#fffaf5';
        }
    });
</script>
@endsection
@endsection
