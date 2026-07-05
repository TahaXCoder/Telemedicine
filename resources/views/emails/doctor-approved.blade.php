<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 10px; overflow: hidden; }
        .header { background: #16a34a; color: white; padding: 30px; text-align: center; }
        .body { padding: 30px; }
        .btn { display: inline-block; background: #16a34a; color: white; padding: 12px 30px; border-radius: 5px; text-decoration: none; margin-top: 20px; }
        .footer { background: #f4f4f4; padding: 15px; text-align: center; color: #888; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏥 Telemedicine</h1>
            <p>Doctor Verification Status</p>
        </div>
        <div class="body">
            <h2>Congratulations Dr. {{ $user->name }}! 🎉</h2>
            <p>Your doctor profile has been <strong>approved</strong> by our admin team.</p>
            <p>You are now visible to patients and can start receiving appointments.</p>
            <p>What you can do now:</p>
            <ul>
                <li>✅ Receive appointment bookings from patients</li>
                <li>✅ Confirm or cancel appointments</li>
                <li>✅ Write digital prescriptions</li>
                <li>✅ Send meeting links for online consultations</li>
            </ul>
            <a href="{{ url('/doctor/dashboard') }}" class="btn">Go to Dashboard</a>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Telemedicine. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
