<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 10px; overflow: hidden; }
        .header { background: #2563eb; color: white; padding: 30px; text-align: center; }
        .body { padding: 30px; }
        .btn { display: inline-block; background: #2563eb; color: white; padding: 12px 30px; border-radius: 5px; text-decoration: none; margin-top: 20px; }
        .footer { background: #f4f4f4; padding: 15px; text-align: center; color: #888; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏥 Telemedicine</h1>
            <p>Welcome to Pakistan's trusted online healthcare platform</p>
        </div>
        <div class="body">
            <h2>Welcome, {{ $user->name }}! 👋</h2>
            <p>Thank you for joining Telemedicine. Your account has been created successfully.</p>
            <p>You can now:</p>
            <ul>
                <li>🔍 Search and find verified doctors</li>
                <li>📅 Book appointments online</li>
                <li>💊 Receive digital prescriptions</li>
                <li>🏥 Choose physical or online consultations</li>
            </ul>
            <a href="{{ url('/patient/dashboard') }}" class="btn">Go to Dashboard</a>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Telemedicine. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
