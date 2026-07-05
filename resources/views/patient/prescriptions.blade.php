<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            My Prescriptions
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if($prescriptions->isEmpty())
                    <p class="text-gray-500">No prescriptions yet.</p>
                @else
                    <table class="w-full table-auto border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="border px-4 py-2 text-left">Doctor</th>
                                <th class="border px-4 py-2 text-left">Date</th>
                                <th class="border px-4 py-2 text-left">Medicines</th>
                                <th class="border px-4 py-2 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($prescriptions as $prescription)
                            <tr>
                                <td class="border px-4 py-2">Dr. {{ $prescription->doctor->name }}</td>
                                <td class="border px-4 py-2">{{ $prescription->created_at->format('d M Y') }}</td>
                                <td class="border px-4 py-2">{{ Str::limit($prescription->medicines, 50) }}</td>
                                <td class="border px-4 py-2">
                                    <a href="{{ route('prescription.show', $prescription->id) }}"
                                       class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 text-sm">
                                        View
                                    </a>
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