<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Doctors
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('admin.dashboard') }}"
                   class="text-blue-600 hover:underline">← Back to Dashboard</a>
            </div>
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">All Doctors</h3>

                @if(session('success'))
                    <div class="mb-4 bg-green-100 text-green-700 p-4 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border px-4 py-2 text-left">Name</th>
                            <th class="border px-4 py-2 text-left">Email</th>
                            <th class="border px-4 py-2 text-left">Specialization</th>
                            <th class="border px-4 py-2 text-left">City</th>
                            <th class="border px-4 py-2 text-left">Status</th>
                            <th class="border px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($doctors as $doctor)
                        <tr>
                            <td class="border px-4 py-2">{{ $doctor->user->name }}</td>
                            <td class="border px-4 py-2">{{ $doctor->user->email }}</td>
                            <td class="border px-4 py-2">{{ $doctor->specialization }}</td>
                            <td class="border px-4 py-2">{{ $doctor->city }}</td>
                            <td class="border px-4 py-2">
                                @if($doctor->status === 'approved')
                                    <span class="text-green-600 font-semibold">✅ Approved</span>
                                @elseif($doctor->status === 'pending')
                                    <span class="text-yellow-600 font-semibold">⏳ Pending</span>
                                @else
                                    <span class="text-red-600 font-semibold">❌ Rejected</span>
                                @endif
                            </td>
                            <td class="border px-4 py-2">
                                <form method="POST" action="{{ route('admin.block', $doctor->user->id) }}" style="display:inline">
                                    @csrf
                                    <button type="submit"
                                        class="{{ $doctor->user->is_blocked ? 'bg-green-500' : 'bg-red-500' }} text-white px-3 py-1 rounded text-sm">
                                        {{ $doctor->user->is_blocked ? 'Unblock' : 'Block' }}
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