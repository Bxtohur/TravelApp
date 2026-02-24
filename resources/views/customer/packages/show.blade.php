<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="md:col-span-2 bg-white shadow-sm sm:rounded-lg overflow-hidden">
                    <img src="{{ Str::startsWith($package->image, 'http') ? $package->image : asset('storage/' . $package->image) }}" class="w-full h-80 object-cover">
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
                                <label class="block text-gray-700 text-sm font-bold mb-2">Tanggal Keberangkatan</label>
                                <input type="date" 
                                       id="tour_date"
                                       name="tour_date" 
                                       min="{{ now()->addDays(7)->format('Y-m-d') }}" 
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500" 
                                       required>
                                <p id="date_warning" class="text-red-500 text-sm mt-1 font-semibold hidden"></p>
                            </div>

                            <div class="mb-6">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Jumlah Peserta (Pax)</label>
                                <input type="number" 
                                       id="pax_count"
                                       name="pax_count" 
                                       min="20" 
                                       max="500" 
                                       value="20" 
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-primary-500 focus:ring-primary-500" 
                                       required>
                                <p id="pax_warning" class="text-red-500 text-sm mt-1 font-semibold hidden"></p>
                            </div>

                            <button type="submit" id="booking_btn" class="w-full bg-primary-600 hover:bg-primary-700 disabled:opacity-50 disabled:cursor-not-allowed text-white font-bold py-3 px-4 rounded-lg transition">
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
                const minDate = dateInput.getAttribute('min'); // Mengambil nilai minimal dari Blade (H+7)
                // Membandingkan string format YYYY-MM-DD
                if (dateInput.value && dateInput.value < minDate) {
                    isDateValid = false;
                    dateWarning.textContent = '*Pemesanan minimal 7 hari dari hari ini.';
                    dateWarning.classList.remove('hidden');
                } else {
                    dateWarning.classList.add('hidden');
                }

                // 2. Validasi Jumlah Peserta
                const paxValue = parseInt(paxInput.value);
                if (isNaN(paxValue) || paxValue < 20) {
                    isPaxValid = false;
                    paxWarning.textContent = '*Jumlah peserta tidak boleh kurang dari 20 orang.';
                    paxWarning.classList.remove('hidden');
                } else if (paxValue > 500) {
                    isPaxValid = false;
                    paxWarning.textContent = '*Kapasitas maksimal adalah 500 orang.';
                    paxWarning.classList.remove('hidden');
                } else {
                    paxWarning.classList.add('hidden');
                }

                // 3. Kontrol Tombol Booking
                // Tombol akan dimatikan jika salah satu tidak valid, atau jika tanggal belum diisi
                if (!dateInput.value || !isDateValid || !isPaxValid) {
                    bookingBtn.disabled = true;
                } else {
                    bookingBtn.disabled = false;
                }
            }

            // Jalankan validasi setiap kali ada perubahan di tanggal atau peserta
            dateInput.addEventListener('input', validateForm);
            paxInput.addEventListener('input', validateForm);
            
            // Jalankan sekali saat pertama kali halaman dimuat untuk mengecek status awal
            validateForm();
        });
    </script>
</x-app-layout>