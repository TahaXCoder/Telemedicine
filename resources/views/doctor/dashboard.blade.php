<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Doctor Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-700 p-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Profile Status --}}
            @if(!auth()->user()->doctorProfile)
                <div class="mb-6 bg-yellow-100 text-yellow-700 p-4 rounded-md">
                    ⚠️ You have not set up your profile yet.
                    <a href="{{ route('doctor.profile.create') }}" class="underline font-semibold">
                        Complete Profile
                    </a>
                </div>
            @elseif(auth()->user()->doctorProfile->status === 'pending')
                <div class="mb-6 bg-yellow-100 text-yellow-700 p-4 rounded-md">
                    ⏳ Your profile is under review. Please wait for admin approval.
                </div>
            @elseif(auth()->user()->doctorProfile->status === 'rejected')
                <div class="mb-6 bg-red-100 text-red-700 p-4 rounded-md">
                    ❌ Your profile was rejected. Please contact admin.
                </div>
            @else
                <div class="mb-6 bg-green-100 text-green-700 p-4 rounded-md">
                    ✅ Your profile is approved. You are visible to patients.
                </div>
            @endif

            {{-- Appointments Table --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">My Appointments</h3>

                @if($appointments->isEmpty())
                    <p class="text-gray-500">No appointments yet.</p>
                @else
                    <table class="w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2 text-left">Patient</th>
                                <th class="border px-4 py-2 text-left">Date</th>
                                <th class="border px-4 py-2 text-left">Time</th>
                                <th class="border px-4 py-2 text-left">Type</th>
                                <th class="border px-4 py-2 text-left">Notes</th>
                                <th class="border px-4 py-2 text-left">Status</th>
                                <th class="border px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                            <tr>
                                <td class="border px-4 py-2">{{ $appointment->patient->name }}</td>
                                <td class="border px-4 py-2">{{ $appointment->date }}</td>
                                <td class="border px-4 py-2">{{ $appointment->time }}</td>
                                <td class="border px-4 py-2">
                                    @if($appointment->appointment_type === 'online')
                                        <span class="text-green-600 font-semibold">💻 Online</span>
                                    @else
                                        <span class="text-blue-600 font-semibold">🏥 Physical</span>
                                    @endif
                                </td>
                                <td class="border px-4 py-2">{{ $appointment->notes ?? 'N/A' }}</td>

                                {{-- Status Column --}}
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

                                {{-- Actions Column --}}
                                <td class="border px-4 py-2">
                                    @if($appointment->status === 'pending')
                                        <form method="POST" action="{{ route('doctor.confirm', $appointment->id) }}" style="display:inline">
                                            @csrf
                                            <button type="submit"
                                                class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                                                Confirm
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('doctor.cancel', $appointment->id) }}" style="display:inline">
                                            @csrf
                                            <button type="submit"
                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm">
                                                Cancel
                                            </button>
                                        </form>

                                    @elseif($appointment->status === 'confirmed')
                                        @if($appointment->appointment_type === 'online' && !$appointment->meeting_link)
                                            <form method="POST" action="{{ route('doctor.meeting', $appointment->id) }}" style="display:inline">
                                                @csrf
                                                <input type="text" name="meeting_link"
                                                    placeholder="Paste Google Meet / Zoom link"
                                                    class="border rounded px-2 py-1 text-sm w-48">
                                                <button type="submit"
                                                    class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                                                    Send Link
                                                </button>
                                            </form>
                                        @elseif($appointment->appointment_type === 'online' && $appointment->meeting_link)
                                            <a href="{{ $appointment->meeting_link }}" target="_blank"
                                               class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 text-sm">
                                                🔗 Join Meeting
                                            </a>
                                        @endif
                                        <form method="POST" action="{{ route('doctor.complete', $appointment->id) }}" style="display:inline">
                                            @csrf
                                            <button type="submit"
                                                class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-sm">
                                                Mark Complete
                                            </button>
                                        </form>
                                        <a href="{{ route('prescription.create', $appointment->id) }}"
                                           class="bg-purple-500 text-white px-3 py-1 rounded hover:bg-purple-600 text-sm">
                                            ✏️ Write Prescription
                                        </a>

                                    @elseif($appointment->status === 'completed')
                                        @if($appointment->prescription)
                                            <span class="text-green-500 text-sm">✅ Prescription Written</span>
                                        @else
                                            <a href="{{ route('prescription.create', $appointment->id) }}"
                                               class="bg-purple-500 text-white px-3 py-1 rounded hover:bg-purple-600 text-sm">
                                                ✏️ Write Prescription
                                            </a>
                                        @endif
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