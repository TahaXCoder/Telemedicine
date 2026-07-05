<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Telemedicine</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-600 to-blue-400 min-h-screen flex items-center justify-center">

    <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">

        {{-- Logo --}}
        <div class="text-center mb-6">
            <span class="text-5xl">🏥</span>
            <h1 class="text-2xl font-bold text-blue-600 mt-2">Telemedicine</h1>
            <p class="text-gray-500 text-sm">Login to your account</p>
        </div>

        {{-- Session Status --}}
        @if (session('status'))
            <div class="mb-4 text-green-600 text-sm text-center">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your email">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                    placeholder="Enter your password">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember Me --}}
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center gap-2 text-gray-600 text-sm">
                    <input type="checkbox" name="remember">
                    Remember me
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-blue-500 text-sm hover:underline">
                        Forgot password?
                    </a>
                @endif
            </div>

            {{-- Submit --}}
            <button type="submit"
                class="w-full bg-blue-600 text-white font-bold py-3 rounded-lg hover:bg-blue-700 transition">
                Login
            </button>

        </form>

        <p class="text-center text-gray-500 text-sm mt-6">
            Don't have an account?
            <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:underline">Register here</a>
        </p>

        <p class="text-center mt-4">
            <a href="{{ url('/') }}" class="text-gray-400 text-sm hover:underline">← Back to Home</a>
        </p>

    </div>

</body>
</html>