<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 10px; overflow: hidden; }
        .header { background: #16a34a; color: white; padding: 30px; text-align: center; }
        .body { padding: 30px; }
        .info-box { background: #f0fdf4; border-left: 4px solid #16a34a; padding: 15px; margin: 20px 0; border-radius: 5px; }
        .btn { display: inline-block; background: #16a34a; color: white; padding: 12px 30px; border-radius: 5px; text-decoration: none; margin-top: 20px; }
        .footer { background: #f4f4f4; padding: 15px; text-align: center; color: #888; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏥 Telemedicine</h1>
            <p>Appointment Confirmed ✅</p>
        </div>
        <div class="body">
            <h2>Great news, {{ $appointment->patient->name }}! 🎉</h2>
            <p>Your appointment has been <strong>confirmed</strong> by the doctor.</p>
            <div class="info-box">
                <p><strong>Doctor:</strong> Dr. {{ $appointment->doctor->name }}</p>
                <p><strong>Date:</strong> {{ $appointment->date }}</p>
                <p><strong>Time:</strong> {{ $appointment->time }}</p>
                <p><strong>Type:</strong> {{ ucfirst($appointment->appointment_type) }}</p>
                @if($appointment->appointment_type === 'online' && $appointment->meeting_link)
                    <p><strong>Meeting Link:</strong>
                        <a href="{{ $appointment->meeting_link }}">Join Meeting</a>
                    </p>
                @endif
            </div>
            <a href="{{ url('/patient/dashboard') }}" class="btn">View Dashboard</a>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Telemedicine. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
