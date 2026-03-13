<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Paket: ') . $package->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="md:col-span-2 bg-white shadow-sm sm:rounded-lg overflow-hidden">
                    <img src="{{ Str::startsWith($package->image, 'http') ? $package->image : asset('storage/' . $package->image) }}" class="w-full h-80 object-cover" alt="{{ $package->name }}">
                    <div class="p-8">
                        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $package->name }}</h1>

                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-primary-600 mb-2">Destinasi Wisata:</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $package->destinations }}</p>
                        </div>

                        <div class="mb-6">
                            <h3 class="text-lg font-bold text-primary-600 mb-2">Fasilitas Termasuk:</h3>
                            <p class="text-gray-700 leading-relaxed">{{ $package->facilities }}</p>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <div class="bg-white shadow-sm sm:rounded-lg p-6 sticky top-4">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">Form Pemesanan</h3>
                        <p class="text-3xl font-bold text-primary-600 mb-6">Rp {{ number_format($package->price, 0, ',', '.') }} <span class="text-sm text-gray-500 font-normal">/ orang</span></p>

                        <form action="{{ route('customer.transactions.store', $package->id) }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="tour_date">Tanggal Keberangkatan</label>
                                <input type="date"
                                       id="tour_date"
                                       name="tour_date"
                                       min="{{ now()->addDays(7)->format('Y-m-d') }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white"
                                       required>
                                <p id="date_warning" class="text-red-500 text-sm mt-1 font-semibold hidden"></p>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="pax_count">Jumlah Peserta (Pax)</label>
                                <input type="number"
                                       id="pax_count"
                                       name="pax_count"
                                       min="16"
                                       max="500"
                                       value="16"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500 bg-white"
                                       required>
                                <p id="pax_warning" class="text-red-500 text-sm mt-1 font-semibold hidden"></p>

                                <div class="mt-4 p-4 bg-blue-50 border-l-4 border-blue-600 rounded-r-md shadow-sm">
                                    <div class="flex items-start">
                                        <div class="flex-shrink-0 mt-0.5">
                                            <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3 text-xs text-blue-800 leading-relaxed">
                                            <p class="font-semibold mb-1">Kapasitas Armada:</p>
                                            <ul class="list-disc list-inside mb-1">
                                                <li>16 pax untuk Mobil Hiace</li>
                                                <li>20 pax untuk Mobil Long Elf</li>
                                                <li>35 pax untuk Medium Bus</li>
                                                <li>50 & 59 pax untuk Big Bus</li>
                                            </ul>
                                            <p class="italic text-blue-700 mt-2">
                                                *Berlaku kelipatan untuk pemesanan lebih banyak.
                                                <a href="https://wa.me/6285720031617" target="_blank" rel="noopener noreferrer" class="font-bold underline hover:text-blue-900 transition duration-200">
                                                    Hubungi CS
                                                </a>
                                                apabila ada yang ingin ditanyakan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                </div>

                            <button type="submit" id="booking_btn" class="w-full bg-primary-600 hover:bg-primary-700 disabled:opacity-50 disabled:cursor-not-allowed text-white font-bold py-3 px-4 rounded-lg transition duration-300 shadow">
                                Booking Sekarang
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('tour_date');
            const paxInput = document.getElementById('pax_count');
            const bookingBtn = document.getElementById('booking_btn');
            const dateWarning = document.getElementById('date_warning');
            const paxWarning = document.getElementById('pax_warning');

            function validateForm() {
                let isDateValid = true;
                let isPaxValid = true;

                // 1. Validasi Tanggal
                const minDate = dateInput.getAttribute('min');
                if (dateInput.value && dateInput.value < minDate) {
                    isDateValid = false;
                    dateWarning.textContent = '*Pemesanan minimal 7 hari dari hari ini.';
                    dateWarning.classList.remove('hidden');
                } else {
                    dateWarning.classList.add('hidden');
                }

                // 2. Validasi Jumlah Peserta
                const paxValue = parseInt(paxInput.value);
                if (isNaN(paxValue) || paxValue < 16) {
                    isPaxValid = false;
                    paxWarning.textContent = '*Jumlah peserta tidak boleh kurang dari 16 orang.';
                    paxWarning.classList.remove('hidden');
                } else if (paxValue > 500) {
                    isPaxValid = false;
                    paxWarning.textContent = '*Kapasitas maksimal adalah 500 orang.';
                    paxWarning.classList.remove('hidden');
                } else {
                    paxWarning.classList.add('hidden');
                }

                // 3. Kontrol Tombol Booking
                if (!dateInput.value || !isDateValid || !isPaxValid) {
                    bookingBtn.disabled = true;
                } else {
                    bookingBtn.disabled = false;
                }
            }

            dateInput.addEventListener('input', validateForm);
            paxInput.addEventListener('input', validateForm);

            // Validasi di awal saat halaman dimuat
            validateForm();
        });
    </script>
</x-app-layout>
