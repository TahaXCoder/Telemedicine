<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: white; border-radius: 10px; overflow: hidden; }
        .header { background: #7c3aed; color: white; padding: 30px; text-align: center; }
        .body { padding: 30px; }
        .info-box { background: #faf5ff; border-left: 4px solid #7c3aed; padding: 15px; margin: 20px 0; border-radius: 5px; }
        .btn { display: inline-block; background: #7c3aed; color: white; padding: 12px 30px; border-radius: 5px; text-decoration: none; margin-top: 20px; }
        .footer { background: #f4f4f4; padding: 15px; text-align: center; color: #888; font-size: 12px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🏥 Telemedicine</h1>
            <p>Your Prescription is Ready 💊</p>
        </div>
        <div class="body">
            <h2>Dear {{ $prescription->patient->name }}</h2>
            <p>Your prescription has been written by your doctor and is ready to view.</p>
            <div class="info-box">
                <p><strong>Doctor:</strong> Dr. {{ $prescription->doctor->name }}</p>
                <p><strong>Date:</strong> {{ $prescription->created_at->format('d M Y') }}</p>
                <p><strong>Medicines:</strong> {{ Str::limit($prescription->medicines, 100) }}</p>
            </div>
            <p>Login to view and print your full prescription.</p>
            <a href="{{ url('/patient/prescriptions') }}" class="btn">View Prescription</a>
        </div>
        <div class="footer">
            <p>© {{ date('Y') }} Telemedicine. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
