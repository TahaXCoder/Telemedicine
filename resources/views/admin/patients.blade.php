<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Patients
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('admin.dashboard') }}"
                   class="text-blue-600 hover:underline">← Back to Dashboard</a>
            </div>
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="mb-4 bg-green-100 text-green-700 p-4 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <h3 class="text-lg font-semibold mb-4">All Patients</h3>
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2 text-left">Name</th>
                            <th class="border px-4 py-2 text-left">Email</th>
                            <th class="border px-4 py-2 text-left">Registered</th>
                            <th class="border px-4 py-2 text-left">Status</th>
                            <th class="border px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $patient)
                        <tr>
                            <td class="border px-4 py-2">{{ $patient->name }}</td>
                            <td class="border px-4 py-2">{{ $patient->email }}</td>
                            <td class="border px-4 py-2">{{ $patient->created_at->format('d M Y') }}</td>
                            <td class="border px-4 py-2">
                                @if($patient->is_blocked)
                                    <span class="text-red-600 font-semibold">🚫 Blocked</span>
                                @else
                                    <span class="text-green-600 font-semibold">✅ Active</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <form method="POST" action="{{ route('admin.block', $patient->id) }}" style="display:inline">
                                    @csrf
                                    <button type="submit"
                                        class="{{ $patient->is_blocked ? 'bg-green-500' : 'bg-red-500' }} text-white px-3 py-1 rounded text-sm">
                                        {{ $patient->is_blocked ? 'Unblock' : 'Block' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>