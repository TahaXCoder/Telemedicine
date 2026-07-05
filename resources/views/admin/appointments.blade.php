<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            All Appointments
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('admin.dashboard') }}"
                   class="text-blue-600 hover:underline">← Back to Dashboard</a>
            </div>
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">All Appointments</h3>
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2 text-left">Patient</th>
                            <th class="border px-4 py-2 text-left">Doctor</th>
                            <th class="border px-4 py-2 text-left">Date</th>
                            <th class="border px-4 py-2 text-left">Time</th>
                            <th class="border px-4 py-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td class="border px-4 py-2">{{ $appointment->patient->name }}</td>
                            <td class="border px-4 py-2">Dr. {{ $appointment->doctor->name }}</td>
                            <td class="border px-4 py-2">{{ $appointment->date }}</td>
                            <td class="border px-4 py-2">{{ $appointment->time }}</td>
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
            </div>
        </div>
    </div>
</x-app-layout>