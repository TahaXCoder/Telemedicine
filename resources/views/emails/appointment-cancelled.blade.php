<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 10px; overflow: hidden; }
        .header { background: #dc2626; color: white; padding: 30px; text-align: center; }
        .body { padding: 30px; }
        .info-box { background: #fef2f2; border-left: 4px solid #dc2626; padding: 15px; margin: 20px 0; border-radius: 5px; }
        .btn { display: inline-block; background: #2563eb; color: white; padding: 12px 30px; border-radius: 5px; text-decoration: none; margin-top: 20px; }
        .footer { background: #f4f4f4; padding: 15px; text-align: center; color: #888; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏥 Telemedicine</h1>
            <p>Appointment Cancelled</p>
        </div>
        <div class="body">
            <h2>Dear {{ $appointment->patient->name }}</h2>
            <p>We are sorry to inform you that your appointment has been <strong>cancelled</strong>.</p>
            <div class="info-box">
                <p><strong>Doctor:</strong> Dr. {{ $appointment->doctor->name }}</p>
                <p><strong>Date:</strong> {{ $appointment->date }}</p>
                <p><strong>Time:</strong> {{ $appointment->time }}</p>
            </div>
            <p>You can book a new appointment with another available doctor.</p>
            <a href="{{ url('/patient/doctors') }}" class="btn">Find Another Doctor</a>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Telemedicine. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
