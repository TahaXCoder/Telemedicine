<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Patient Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-700 p-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Quick Action --}}
            <div class="mb-6">
                <a href="{{ route('patient.doctors') }}"
                   class="bg-blue-600 text-white py-2 px-6 rounded-md hover:bg-blue-700">
                    🔍 Find & Book a Doctor
                </a>
                <a href="{{ route('patient.prescriptions') }}"
                  class="bg-green-600 text-white py-2 px-6 rounded-md hover:bg-green-700">
                  💊 My Prescriptions
                 </a>
            </div>

            {{-- Appointments --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">My Appointments</h3>

                @if($appointments->isEmpty())
                    <p class="text-gray-500">No appointments yet. Book your first appointment!</p>
                @else
                    <table class="w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2 text-left">Doctor</th>
                                <th class="border px-4 py-2 text-left">Specialization</th>
                                <th class="border px-4 py-2 text-left">Date</th>
                                <th class="border px-4 py-2 text-left">Time</th>
                                <th class="border px-4 py-2 text-left">Type</th>
                                <th class="border px-4 py-2 text-left">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                            <tr>
                                <td class="border px-4 py-2">Dr. {{ $appointment->doctor->name }}</td>
                                <td class="border px-4 py-2">{{ $appointment->doctor->doctorProfile->specialization }}</td>
                                <td class="border px-4 py-2">{{ $appointment->date }}</td>
                                <td class="border px-4 py-2">{{ $appointment->time }}</td>
                                <td class="border px-4 py-2">
                                    @if($appointment->appointment_type === 'online')
                                        <span class="text-green-600 font-semibold">💻 Online</span>
                                        @if($appointment->meeting_link)
                                            <br>
                                            <a href="{{ $appointment->meeting_link }}" target="_blank"
                                               class="text-blue-500 text-sm underline">Join Meeting</a>
                                        @endif
                                    @else
                                        <span class="text-blue-600 font-semibold">🏥 Physical</span>
                                    @endif
                                </td>
                                <td class="border px-4 py-2">
                                    @if($appointment->status === 'pending')
                                        <span class="text-yellow-600 font-semibold">⏳ Pending</span>
                                    @elseif($appointment->status === 'confirmed')
                                        <span class="text-green-600 font-semibold">✅ Confirmed</span>
                                    @elseif($appointment->status === 'completed')
                                        <span class="text-blue-600 font-semibold">🏁 Completed</span>
                                    @else
                                        <span class="text-red-600 font-semibold">❌ Cancelled</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>