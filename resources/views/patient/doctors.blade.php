<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Find a Doctor
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Search Filter --}}
            <div class="bg-white shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="flex gap-4">
                    <input type="text" id="search-specialization"
                        placeholder="Specialization (e.g. Cardiologist)"
                        class="w-full border-gray-300 rounded-md shadow-sm">
                    <input type="text" id="search-city"
                        placeholder="City (e.g. Lahore)"
                        class="w-full border-gray-300 rounded-md shadow-sm">
                    <button id="search-btn"
                        class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700">
                        Search
                    </button>
                </div>
                <div id="search-loading" class="mt-2 text-blue-500 hidden">
                    🔍 Searching...
                </div>
            </div>

            {{-- Doctor Cards --}}
            <div id="doctors-container">
                @include('patient.partials.doctor-cards', ['doctors' => $doctors])
            </div>

        </div>
    </div>

    {{-- jQuery AJAX Search --}}
    <script>
        $(document).ready(function () {

            function searchDoctors() {
                let specialization = $('#search-specialization').val();
                let city = $('#search-city').val();

                $('#search-loading').removeClass('hidden');
                $('#doctors-container').css('opacity', '0.5');

                $.ajax({
                    url: '{{ route("patient.doctors.search") }}',
                    method: 'GET',
                    data: {
                        specialization: specialization,
                        city: city
                    },
                    success: function (response) {
                        $('#doctors-container').html(response);
                        $('#doctors-container').css('opacity', '1');
                        $('#search-loading').addClass('hidden');
                    },
                    error: function () {
                        $('#search-loading').addClass('hidden');
                        $('#doctors-container').css('opacity', '1');
                        alert('Search failed. Please try again.');
                    }
                });
            }

            // Search on button click
            $('#search-btn').on('click', function () {
                searchDoctors();
            });

            // Search on typing (live search)
            $('#search-specialization, #search-city').on('keyup', function () {
                clearTimeout(window.searchTimer);
                window.searchTimer = setTimeout(searchDoctors, 500);
            });

        });
    </script>

</x-app-layout>