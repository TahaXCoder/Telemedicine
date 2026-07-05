<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Complete Your Doctor Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                @if($errors->any())
                    <div class="mb-4 text-red-600">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('doctor.profile.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700">Specialization</label>
                        <input type="text" name="specialization" value="{{ old('specialization') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="e.g. Cardiologist, Dermatologist">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Qualification</label>
                        <input type="text" name="qualification" value="{{ old('qualification') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="e.g. MBBS, MD">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Experience (years)</label>
                        <input type="number" name="experience" value="{{ old('experience') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Consultation Fee (PKR)</label>
                        <input type="number" name="fee" value="{{ old('fee') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">City</label>
                        <input type="text" name="city" value="{{ old('city') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="e.g. Lahore, Karachi">
                    </div>
                          <div class="mb-4">
                         <label class="block text-gray-700">Clinic Address (for physical visits)</label>
                         <input type="text" name="clinic_address" value="{{ old('clinic_address') }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                          placeholder="e.g. Clinic 5, Al-Rehman Plaza, Main Boulevard, Lahore">
                         </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Bio</label>
                        <textarea name="bio" rows="4"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Tell patients about yourself...">{{ old('bio') }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                        Submit Profile for Approval
                    </button>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>