<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pembayaran</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <div class="text-center mb-6">
                    <h3 class="text-lg text-gray-600">Total Tagihan Anda</h3>
                    <p class="text-4xl font-bold text-primary-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                    <p class="text-sm text-gray-500 mt-2">Untuk Paket: {{ $transaction->package->name }} ({{ $transaction->pax_count }} Pax)</p>
                </div>

                <div class="border-t pt-4">
                    <h4 class="font-bold text-gray-800 mb-2">Instruksi Pembayaran:</h4>
                    <ol class="list-decimal list-inside text-gray-700 space-y-2 mb-6">
                        <li>Silakan transfer ke Bank <strong>BCA 123-456-7890</strong> a.n PT BROOKAL SUKSES ABADI.</li>
                        <li>Pastikan nominal transfer sesuai hingga 3 digit terakhir.</li>
                        <li>Simpan bukti transfer (foto/screenshot).</li>
                        <li>Upload bukti transfer pada form di bawah ini.</li>
                    </ol>

                    <div class="p-4 bg-blue-50 border-l-4 border-blue-600 rounded-r-md shadow-sm">
                        <div class="flex items-start">
                            <div class="flex-shrink-0 mt-0.5">
                                <svg class="h-5 w-5 text-blue-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3 text-sm text-blue-800 leading-relaxed">
                                <p>
                                    <strong>Butuh Bantuan?</strong> Jika Anda mengalami kendala saat melakukan pembayaran, silakan
                                    <a href="https://wa.me/6285720031617" target="_blank" rel="noopener noreferrer" class="font-bold underline hover:text-blue-900 transition duration-200">
                                        Hubungi CS via WhatsApp
                                    </a>.
                                </p>
                            </div>
                        </div>
                    </div>
                    </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Konfirmasi Pembayaran</h3>

                @if($transaction->status == 'pending')
                    <form action="{{ route('customer.transactions.update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Upload Bukti Transfer</label>
                            <input type="file" name="payment_proof" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 transition duration-200" required>
                        </div>

                        <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-4 rounded-lg shadow transition duration-300">
                            Kirim Bukti Pembayaran
                        </button>
                    </form>
                @else
                    <div class="text-center p-4 bg-yellow-50 text-yellow-800 rounded-lg">
                        <p class="font-bold mb-1">Bukti pembayaran sudah dikirim.</p>
                        <p>Status saat ini: <span class="uppercase font-semibold">{{ str_replace('_', ' ', $transaction->status) }}</span></p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
