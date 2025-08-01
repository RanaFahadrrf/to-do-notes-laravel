@extends('layout')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%;">
        <h4 class="text-center mb-4">Enter OTP</h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/admin/verify-otp" id="otpForm">
            @csrf

            <div class="mb-3">
                <label for="otp_code" class="form-label">6-Digit OTP</label>

                <div class="input-group">
                    <input name="otp_code" id="otp_code" type="password" maxlength="6"
                           class="form-control text-center fw-bold fs-5" required autofocus>

                    <button type="button" class="btn btn-outline-secondary" id="toggleOtp">
                        Show
                    </button>
                </div>

                <div class="text-muted mt-2 text-center">
                    OTP expires in <span id="timer" class="fw-semibold">05:00</span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary w-100 mt-2" id="submitBtn">Verify OTP</button>
        </form>
    </div>
</div>

<script>
    // Toggle password visibility
    document.getElementById('toggleOtp').addEventListener('click', function () {
        const otpInput = document.getElementById('otp_code');
        const type = otpInput.getAttribute('type');

        if (type === 'password') {
            otpInput.setAttribute('type', 'text');
            this.textContent = 'Hide';
        } else {
            otpInput.setAttribute('type', 'password');
            this.textContent = 'Show';
        }
    });

    // Timer logic (5 minutes = 300 seconds)
    let duration = 300;
    const timerDisplay = document.getElementById('timer');
    const submitBtn = document.getElementById('submitBtn');

    const countdown = setInterval(() => {
        let minutes = Math.floor(duration / 60);
        let seconds = duration % 60;

        timerDisplay.textContent =
            `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

        if (duration <= 0) {
            clearInterval(countdown);
            timerDisplay.textContent = 'Expired';
            // Optionally disable form
            // submitBtn.disabled = true;
            // submitBtn.textContent = 'Expired';
        }

        duration--;
    }, 1000);
</script>
@endsection
