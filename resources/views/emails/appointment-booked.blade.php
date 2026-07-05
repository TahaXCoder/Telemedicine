<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 10px; overflow: hidden; }
        .header { background: #2563eb; color: white; padding: 30px; text-align: center; }
        .body { padding: 30px; }
        .info-box { background: #eff6ff; border-left: 4px solid #2563eb; padding: 15px; margin: 20px 0; border-radius: 5px; }
        .btn { display: inline-block; background: #2563eb; color: white; padding: 12px 30px; border-radius: 5px; text-decoration: none; margin-top: 20px; }
        .footer { background: #f4f4f4; padding: 15px; text-align: center; color: #888; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏥 Telemedicine</h1>
            <p>Appointment Confirmation</p>
        </div>
        <div class="body">
            @if($recipientType === 'patient')
                <h2>Appointment Booked! 📅</h2>
                <p>Your appointment has been booked successfully.</p>
                <div class="info-box">
                    <p><strong>Doctor:</strong> Dr. {{ $appointment->doctor->name }}</p>
                    <p><strong>Date:</strong> {{ $appointment->date }}</p>
                    <p><strong>Time:</strong> {{ $appointment->time }}</p>
                    <p><strong>Type:</strong> {{ ucfirst($appointment->appointment_type) }}</p>
                    <p><strong>Status:</strong> Pending Confirmation</p>
                </div>
                <p>Please wait for the doctor to confirm your appointment.</p>
                <a href="{{ url('/patient/dashboard') }}" class="btn">View Dashboard</a>
            @else
                <h2>New Appointment Request! 📅</h2>
                <p>You have received a new appointment request.</p>
                <div class="info-box">
                    <p><strong>Patient:</strong> {{ $appointment->patient->name }}</p>
                    <p><strong>Date:</strong> {{ $appointment->date }}</p>
                    <p><strong>Time:</strong> {{ $appointment->time }}</p>
                    <p><strong>Type:</strong> {{ ucfirst($appointment->appointment_type) }}</p>
                    <p><strong>Notes:</strong> {{ $appointment->notes ?? 'No notes' }}</p>
                </div>
                <p>Please login to confirm or cancel this appointment.</p>
                <a href="{{ url('/doctor/dashboard') }}" class="btn">View Dashboard</a>
            @endif
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Telemedicine. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
