<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 10px; overflow: hidden; }
        .header { background: #dc2626; color: white; padding: 30px; text-align: center; }
        .body { padding: 30px; }
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
            <h2>Dear Dr. {{ $user->name }}</h2>
            <p>We regret to inform you that your doctor profile has been <strong>rejected</strong> by our admin team.</p>
            <p>This may be due to:</p>
            <ul>
                <li>❌ Incomplete or incorrect information</li>
                <li>❌ Invalid qualifications</li>
                <li>❌ Missing required credentials</li>
            </ul>
            <p>Please contact our admin team for more information and to resubmit your profile.</p>
            <p>Email: admin@telemedicine.com</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Telemedicine. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
