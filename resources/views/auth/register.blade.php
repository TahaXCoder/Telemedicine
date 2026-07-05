<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Telemedicine</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-600 to-blue-400 min-h-screen flex items-center justify-center py-10">

    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-6">
            <span class="text-5xl">🏥</span>
            <h1 class="text-2xl font-bold text-blue-600 mt-2">Telemedicine</h1>
            <p class="text-gray-500 text-sm">Create your account</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your full name">
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your email">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Role Selection --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Register As</label>
                <div class="grid grid-cols-2 gap-4">
                    <label id="patient-card"
                        class="border-2 border-blue-500 bg-blue-50 rounded-lg p-4 text-center cursor-pointer transition">
                        <input type="radio" name="role" value="patient" class="hidden" checked>
                        <div class="text-3xl mb-1">🧑‍💼</div>
                        <div class="font-semibold text-blue-600">Patient</div>
                        <div class="text-xs text-gray-500">Book appointments</div>
                    </label>
                    <label id="doctor-card"
                        class="border-2 border-gray-200 rounded-lg p-4 text-center cursor-pointer transition">
                        <input type="radio" name="role" value="doctor" class="hidden">
                        <div class="text-3xl mb-1">👨‍⚕️</div>
                        <div class="font-semibold text-gray-600">Doctor</div>
                        <div class="text-xs text-gray-500">Manage patients</div>
                    </label>
                </div>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Create a password">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Confirm your password">
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition">
                Create Account
            </button>

        </form>

        <p class="text-center text-gray-500 text-sm mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Login here</a>
        </p>

        <p class="text-center mt-4">
            <a href="{{ url('/') }}" class="text-gray-400 text-sm hover:underline">← Back to Home</a>
        </p>

    </div>

    {{-- Role Card Selection Script --}}
    <script>
        const patientCard = document.getElementById('patient-card');
        const doctorCard = document.getElementById('doctor-card');
        const patientRadio = patientCard.querySelector('input');
        const doctorRadio = doctorCard.querySelector('input');

        patientCard.addEventListener('click', function () {
            patientRadio.checked = true;
            patientCard.classList.add('border-blue-500', 'bg-blue-50');
            patientCard.querySelector('div:nth-child(2)').classList.replace('text-gray-600', 'text-blue-600');
            doctorCard.classList.remove('border-blue-500', 'bg-blue-50');
            doctorCard.classList.add('border-gray-200');
            doctorCard.querySelector('div:nth-child(2)').classList.replace('text-blue-600', 'text-gray-600');
        });

        doctorCard.addEventListener('click', function () {
            doctorRadio.checked = true;
            doctorCard.classList.add('border-blue-500', 'bg-blue-50');
            doctorCard.querySelector('div:nth-child(2)').classList.replace('text-gray-600', 'text-blue-600');
            patientCard.classList.remove('border-blue-500', 'bg-blue-50');
            patientCard.classList.add('border-gray-200');
            patientCard.querySelector('div:nth-child(2)').classList.replace('text-blue-600', 'text-gray-600');
        });
    </script>

</body>
</html>