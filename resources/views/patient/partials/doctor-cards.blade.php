@if($doctors->isEmpty())
    <p class="text-gray-500">No doctors found.</p>
@else
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($doctors as $doctor)
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800">
                Dr. {{ $doctor->user->name }}
            </h3>
            <p class="text-blue-600 font-medium">{{ $doctor->specialization }}</p>
            <p class="text-gray-500 text-sm mt-1">{{ $doctor->qualification }}</p>
            <p class="text-gray-500 text-sm">{{ $doctor->experience }} years experience</p>
            <p class="text-gray-500 text-sm">📍 {{ $doctor->city }}</p>
            <p class="text-green-600 font-semibold mt-2">PKR {{ $doctor->fee }}</p>
            <p class="text-gray-600 text-sm mt-2">{{ Str::limit($doctor->bio, 80) }}</p>
            <a href="{{ route('patient.book', $doctor->user_id) }}"
               class="mt-4 block text-center bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
                Book Appointment
            </a>
        </div>
        @endforeach
    </div>
@endif