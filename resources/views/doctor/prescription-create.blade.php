<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Write Prescription
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Patient Info --}}
                <div class="mb-6 p-4 bg-blue-50 rounded-md">
                    <h3 class="text-lg font-semibold">Patient: {{ $appointment->patient->name }}</h3>
                    <p class="text-gray-500 text-sm">Appointment Date: {{ $appointment->date }}</p>
                    <p class="text-gray-500 text-sm">Notes: {{ $appointment->notes ?? 'N/A' }}</p>
                </div>

                @if($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('prescription.store', $appointment->id) }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold">Medicines</label>
                        <textarea name="medicines" rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="e.g. Panadol 500mg - 1 tablet twice daily&#10;Amoxicillin 250mg - 1 capsule three times daily">{{ old('medicines') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold">Instructions</label>
                        <textarea name="instructions" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="e.g. Take medicines after meals. Drink plenty of water. Rest for 2 days.">{{ old('instructions') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold">Additional Notes (optional)</label>
                        <textarea name="notes" rows="2"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Any additional notes...">{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                        Save Prescription & Complete Appointment
                    </button>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>