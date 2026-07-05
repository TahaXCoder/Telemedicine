<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 bg-green-100 text-green-700 p-4 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-blue-500 text-white rounded-lg p-6 shadow">
                    <h3 class="text-lg font-semibold">👨‍⚕️ Total Doctors</h3>
                    <p class="text-4xl font-bold mt-2">{{ $totalDoctors }}</p>
                </div>
                <div class="bg-green-500 text-white rounded-lg p-6 shadow">
                    <h3 class="text-lg font-semibold">🧑‍💼 Total Patients</h3>
                    <p class="text-4xl font-bold mt-2">{{ $totalPatients }}</p>
                </div>
                <div class="bg-purple-500 text-white rounded-lg p-6 shadow">
                    <h3 class="text-lg font-semibold">📅 Total Appointments</h3>
                    <p class="text-4xl font-bold mt-2">{{ $totalAppointments }}</p>
                </div>
            </div>

            {{-- Quick Links --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <a href="{{ route('admin.doctors') }}"
                   class="bg-white shadow-sm rounded-lg p-4 text-center hover:bg-gray-50">
                    <p class="text-blue-600 font-semibold">👨‍⚕️ Manage Doctors</p>
                </a>
                <a href="{{ route('admin.patients') }}"
                   class="bg-white shadow-sm rounded-lg p-4 text-center hover:bg-gray-50">
                    <p class="text-green-600 font-semibold">🧑‍💼 Manage Patients</p>
                </a>
                <a href="{{ route('admin.appointments') }}"
                   class="bg-white shadow-sm rounded-lg p-4 text-center hover:bg-gray-50">
                    <p class="text-purple-600 font-semibold">📅 All Appointments</p>
                </a>
            </div>

            {{-- Pending Doctor Approvals --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">⏳ Pending Doctor Approvals</h3>

                @if($pendingDoctors->isEmpty())
                    <p class="text-gray-500">No pending doctors at the moment.</p>
                @else
                    <table class="w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2 text-left">Name</th>
                                <th class="border px-4 py-2 text-left">Email</th>
                                <th class="border px-4 py-2 text-left">Specialization</th>
                                <th class="border px-4 py-2 text-left">Qualification</th>
                                <th class="border px-4 py-2 text-left">Experience</th>
                                <th class="border px-4 py-2 text-left">Fee</th>
                                <th class="border px-4 py-2 text-left">City</th>
                                <th class="border px-4 py-2 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingDoctors as $doctor)
                            <tr>
                                <td class="border px-4 py-2">{{ $doctor->user->name }}</td>
                                <td class="border px-4 py-2">{{ $doctor->user->email }}</td>
                                <td class="border px-4 py-2">{{ $doctor->specialization }}</td>
                                <td class="border px-4 py-2">{{ $doctor->qualification }}</td>
                                <td class="border px-4 py-2">{{ $doctor->experience }} years</td>
                                <td class="border px-4 py-2">PKR {{ $doctor->fee }}</td>
                                <td class="border px-4 py-2">{{ $doctor->city }}</td>
                                <td class="border px-4 py-2">
                                    <form method="POST" action="{{ route('admin.approve', $doctor->id) }}" style="display:inline">
                                        @csrf
                                        <button type="submit"
                                            class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">
                                            Approve
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.reject', $doctor->id) }}" style="display:inline">
                                        @csrf
                                        <button type="submit"
                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                            Reject
                                        </button>
                                    </form>
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