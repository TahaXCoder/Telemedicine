<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 10px; overflow: hidden; }
        .header { background: #0f766e; color: white; padding: 30px; text-align: center; }
        .body { padding: 30px; }
        .footer { background: #f4f4f4; padding: 15px; text-align: center; color: #888; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Telemedicine</h1>
            <p>Doctor Profile Submission</p>
        </div>
        <div class="body">
            <h2>Hello Dr. {{ $user->name }},</h2>
            <p>Your doctor profile has been received and is now pending admin review.</p>
            <p>We will notify you once your profile is approved or if any changes are needed.</p>
            <p>Thanks for joining Telemedicine.</p>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Telemedicine. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
