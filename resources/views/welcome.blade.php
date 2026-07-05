<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Telemedicine - Online Doctor Consultation</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="bg-gray-50">

    {{-- Navbar --}}
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <span class="text-3xl">🏥</span>
                <span class="text-xl font-bold text-blue-600">Telemedicine</span>
            </div>
            <div class="flex gap-4">
                @auth
                    @if(auth()->user()->role === 'patient')
                        <a href="{{ route('patient.dashboard') }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Dashboard
                        </a>
                    @elseif(auth()->user()->role === 'doctor')
                        <a href="{{ route('doctor.dashboard') }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('admin.dashboard') }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                            Dashboard
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                       class="text-blue-600 font-semibold hover:underline px-4 py-2">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                        Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Hero Section --}}
    <section class="bg-gradient-to-r from-blue-600 to-blue-400 text-white py-20">
        <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center gap-10">
            <div class="flex-1">
                <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
                    Your Health, <br>Our Priority 🏥
                </h1>
                <p class="text-lg text-blue-100 mb-8">
                    Connect with verified doctors online. Book appointments, get prescriptions,
                    and manage your health — all from the comfort of your home.
                </p>
                <div class="flex gap-4">
                    <a href="{{ route('register') }}"
                       class="bg-white text-blue-600 font-bold px-6 py-3 rounded-md hover:bg-blue-50">
                        Get Started
                    </a>
                    <a href="{{ route('login') }}"
                       class="border-2 border-white text-white font-bold px-6 py-3 rounded-md hover:bg-blue-500">
                        Login
                    </a>
                </div>
            </div>
            <div class="flex-1 text-center">
                <span class="text-9xl">👨‍⚕️</span>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    <section class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                <div class="p-6">
                    <p class="text-4xl font-bold text-blue-600">100+</p>
                    <p class="text-gray-500 mt-2">Verified Doctors</p>
                </div>
                <div class="p-6">
                    <p class="text-4xl font-bold text-green-600">500+</p>
                    <p class="text-gray-500 mt-2">Happy Patients</p>
                </div>
                <div class="p-6">
                    <p class="text-4xl font-bold text-purple-600">1000+</p>
                    <p class="text-gray-500 mt-2">Appointments Booked</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Features Section --}}
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">
                Why Choose Telemedicine?
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-xl shadow p-6 text-center hover:shadow-lg transition">
                    <div class="text-5xl mb-4">🔍</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Find Doctors</h3>
                    <p class="text-gray-500">Search verified doctors by specialization and city instantly.</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 text-center hover:shadow-lg transition">
                    <div class="text-5xl mb-4">📅</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Easy Booking</h3>
                    <p class="text-gray-500">Book appointments online in just a few clicks, anytime.</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 text-center hover:shadow-lg transition">
                    <div class="text-5xl mb-4">💊</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Get Prescriptions</h3>
                    <p class="text-gray-500">Receive digital prescriptions and print them at home.</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 text-center hover:shadow-lg transition">
                    <div class="text-5xl mb-4">✅</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Verified Doctors</h3>
                    <p class="text-gray-500">All doctors are verified and approved by our admin team.</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 text-center hover:shadow-lg transition">
                    <div class="text-5xl mb-4">🔒</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Secure & Private</h3>
                    <p class="text-gray-500">Your health data is safe and completely private.</p>
                </div>
                <div class="bg-white rounded-xl shadow p-6 text-center hover:shadow-lg transition">
                    <div class="text-5xl mb-4">📱</div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Easy to Use</h3>
                    <p class="text-gray-500">Simple and clean interface for patients and doctors.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- How It Works --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">
                How It Works
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
                <div class="p-4">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-blue-600">1</span>
                    </div>
                    <h3 class="font-semibold text-gray-800">Register</h3>
                    <p class="text-gray-500 text-sm mt-1">Create your free account as a patient</p>
                </div>
                <div class="p-4">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-blue-600">2</span>
                    </div>
                    <h3 class="font-semibold text-gray-800">Find Doctor</h3>
                    <p class="text-gray-500 text-sm mt-1">Search doctors by specialization or city</p>
                </div>
                <div class="p-4">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-blue-600">3</span>
                    </div>
                    <h3 class="font-semibold text-gray-800">Book Appointment</h3>
                    <p class="text-gray-500 text-sm mt-1">Select your preferred date and time</p>
                </div>
                <div class="p-4">
                    <div class="bg-blue-100 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl font-bold text-blue-600">4</span>
                    </div>
                    <h3 class="font-semibold text-gray-800">Get Prescription</h3>
                    <p class="text-gray-500 text-sm mt-1">Receive and download your prescription</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="bg-blue-600 py-16 text-white text-center">
        <div class="max-w-2xl mx-auto px-6">
            <h2 class="text-3xl font-bold mb-4">Ready to Get Started?</h2>
            <p class="text-blue-100 mb-8">Join thousands of patients who trust Telemedicine for their healthcare needs.</p>
            <a href="{{ route('register') }}"
               class="bg-white text-blue-600 font-bold px-8 py-3 rounded-md hover:bg-blue-50 text-lg">
                Register Now — It's Free!
            </a>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="bg-gray-800 text-gray-400 py-8 text-center">
        <p>🏥 Telemedicine — Built with Laravel & ❤️</p>
        <p class="text-sm mt-1">© {{ date('Y') }} All rights reserved.</p>
    </footer>

</body>
</html>