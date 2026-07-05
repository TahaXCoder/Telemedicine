<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Book Appointment
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">

                {{-- Doctor Info --}}
                <div class="mb-6 p-4 bg-blue-50 rounded-md">
                    <h3 class="text-lg font-semibold">Dr. {{ $doctor->user->name }}</h3>
                    <p class="text-blue-600">{{ $doctor->specialization }}</p>
                    <p class="text-gray-500 text-sm">{{ $doctor->qualification }} • {{ $doctor->experience }} years</p>
                    <p class="text-gray-500 text-sm">📍 {{ $doctor->city }}</p>
                    <p class="text-green-600 font-semibold">Consultation Fee: PKR {{ $doctor->fee }}</p>
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

                <form method="POST" action="{{ route('patient.book.store', $doctor->user_id) }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700">Select Date</label>
                        <input type="date" name="date"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            min="{{ date('Y-m-d', strtotime('+1 day')) }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700">Select Time</label>
                        <select name="time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                            <option value="09:00">9:00 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="12:00">12:00 PM</option>
                            <option value="14:00">2:00 PM</option>
                            <option value="15:00">3:00 PM</option>
                            <option value="16:00">4:00 PM</option>
                            <option value="17:00">5:00 PM</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-semibold">Appointment Type</label>
                        <div class="grid grid-cols-2 gap-4 mt-2">
                            <label id="physical-card"
                                class="border-2 border-blue-500 bg-blue-50 rounded-lg p-4 text-center cursor-pointer">
                                <input type="radio" name="appointment_type" value="physical" class="hidden" checked>
                                <div class="text-3xl mb-1">🏥</div>
                                <div class="font-semibold text-blue-600">Physical Visit</div>
                                <div class="text-xs text-gray-500">Visit doctor's clinic</div>
                            </label>
                            <label id="online-card"
                                class="border-2 border-gray-200 rounded-lg p-4 text-center cursor-pointer">
                                <input type="radio" name="appointment_type" value="online" class="hidden">
                                <div class="text-3xl mb-1">💻</div>
                                <div class="font-semibold text-gray-600">Online Consultation</div>
                                <div class="text-xs text-gray-500">Video call with doctor</div>
                            </label>
                        </div>
                    </div>

                    {{-- Physical Address Info --}}
                    <div id="physical-info" class="mb-4 p-3 bg-blue-50 rounded-md">
                        <p class="text-sm text-blue-700 font-semibold">📍 Clinic Address:</p>
                        <p class="text-sm text-gray-600">{{ $doctor->clinic_address ?? 'Address not provided by doctor' }}</p>
                    </div>

                    {{-- Online Info --}}
                    <div id="online-info" class="mb-4 p-3 bg-green-50 rounded-md hidden">
                        <p class="text-sm text-green-700 font-semibold">💻 Online Consultation</p>
                        <p class="text-sm text-gray-600">Doctor will send you a meeting link after confirming your appointment.</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Notes (optional)</label>
                        <textarea name="notes" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                            placeholder="Describe your symptoms..."></textarea>
                    </div>

                    <button type="button" id="confirm-btn"
                        class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700">
                        Confirm Appointment
                    </button>

                    {{-- Confirmation Popup --}}
                    <div id="confirm-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white rounded-lg p-6 max-w-sm w-full shadow-xl">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Confirm Booking</h3>
                            <p class="text-gray-600 mb-4">Are you sure you want to book this appointment?</p>
                            <div class="flex gap-3">
                                <button id="yes-confirm"
                                    class="flex-1 bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
                                    Yes, Book It
                                </button>
                                <button id="no-confirm"
                                    class="flex-1 bg-gray-300 text-gray-700 py-2 rounded-md hover:bg-gray-400">
                                    Cancel
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        const physicalCard = document.getElementById('physical-card');
        const onlineCard = document.getElementById('online-card');
        const physicalInfo = document.getElementById('physical-info');
        const onlineInfo = document.getElementById('online-info');
        const physicalRadio = physicalCard.querySelector('input');
        const onlineRadio = onlineCard.querySelector('input');

        physicalCard.addEventListener('click', function () {
            physicalRadio.checked = true;
            physicalCard.classList.add('border-blue-500', 'bg-blue-50');
            physicalCard.querySelector('div:nth-child(2)').classList.replace('text-gray-600', 'text-blue-600');
            onlineCard.classList.remove('border-blue-500', 'bg-blue-50');
            onlineCard.classList.add('border-gray-200');
            onlineCard.querySelector('div:nth-child(2)').classList.replace('text-blue-600', 'text-gray-600');
            physicalInfo.classList.remove('hidden');
            onlineInfo.classList.add('hidden');
        });

        onlineCard.addEventListener('click', function () {
            onlineRadio.checked = true;
            onlineCard.classList.add('border-blue-500', 'bg-blue-50');
            onlineCard.querySelector('div:nth-child(2)').classList.replace('text-gray-600', 'text-blue-600');
            physicalCard.classList.remove('border-blue-500', 'bg-blue-50');
            physicalCard.classList.add('border-gray-200');
            physicalCard.querySelector('div:nth-child(2)').classList.replace('text-blue-600', 'text-gray-600');
            physicalInfo.classList.add('hidden');
            onlineInfo.classList.remove('hidden');
        });
    </script>

    {{-- jQuery Script at bottom --}}
    <script>
        $(document).ready(function () {

            // Show popup on button click
            $('#confirm-btn').on('click', function () {
                $('#confirm-modal').removeClass('hidden');
            });

            // Submit form on Yes
            $('#yes-confirm').on('click', function () {
                $('form').submit();
            });

            // Hide popup on Cancel
            $('#no-confirm').on('click', function () {
                $('#confirm-modal').addClass('hidden');
            });

        });
    </script>

</x-app-layout>