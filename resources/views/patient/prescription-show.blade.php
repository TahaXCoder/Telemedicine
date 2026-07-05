<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Prescription Details
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div id="prescription-card" class="bg-white shadow-sm sm:rounded-lg p-8">

                {{-- Header --}}
                <div class="text-center border-b pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-blue-600">🏥 Telemedicine</h2>
                    <p class="text-gray-500 text-sm">Online Medical Prescription</p>
                </div>

                {{-- Doctor Info --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-gray-700">Doctor:</h3>
                    <p class="text-lg font-bold">Dr. {{ $prescription->doctor->name }}</p>
                    <p class="text-gray-500">{{ $prescription->doctor->doctorProfile->specialization }}</p>
                    <p class="text-gray-500">{{ $prescription->doctor->doctorProfile->qualification }}</p>
                </div>

                {{-- Patient Info --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-gray-700">Patient:</h3>
                    <p class="text-lg">{{ auth()->user()->name }}</p>
                    <p class="text-gray-500">Date: {{ $prescription->created_at->format('d M Y') }}</p>
                </div>

                {{-- Medicines --}}
                <div class="mb-6 p-4 bg-blue-50 rounded-md">
                    <h3 class="font-semibold text-gray-700 mb-2">💊 Medicines:</h3>
                    <p class="text-gray-800 whitespace-pre-line">{{ $prescription->medicines }}</p>
                </div>

                {{-- Instructions --}}
                <div class="mb-6 p-4 bg-green-50 rounded-md">
                    <h3 class="font-semibold text-gray-700 mb-2">📋 Instructions:</h3>
                    <p class="text-gray-800 whitespace-pre-line">{{ $prescription->instructions }}</p>
                </div>

                @if($prescription->notes)
                <div class="mb-6 p-4 bg-yellow-50 rounded-md">
                    <h3 class="font-semibold text-gray-700 mb-2">📝 Notes:</h3>
                    <p class="text-gray-800">{{ $prescription->notes }}</p>
                </div>
                @endif

                {{-- Print Button --}}
                <button onclick="window.print()"
                    class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                    🖨️ Print Prescription
                </button>

            </div>
        </div>
    </div>
</x-app-layout>