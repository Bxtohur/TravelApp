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
                    <ol class="list-decimal list-inside text-gray-700 space-y-2">
                        <li>Silakan transfer ke Bank <strong>BCA 123-456-7890</strong> a.n PT BROOKAL SUKSES ABADI.</li>
                        <li>Pastikan nominal transfer sesuai hingga 3 digit terakhir.</li>
                        <li>Simpan bukti transfer (foto/screenshot).</li>
                        <li>Upload bukti transfer pada form di bawah ini.</li>
                    </ol>
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
                            <input type="file" name="payment_proof" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100" required>
                        </div>

                        <button type="submit" class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-2 px-4 rounded">
                            Kirim Bukti Pembayaran
                        </button>
                    </form>
                @else
                    <div class="text-center p-4 bg-yellow-50 text-yellow-800 rounded-lg">
                        <p class="font-bold">Bukti pembayaran sudah dikirim.</p>
                        <p>Status saat ini: <span class="uppercase">{{ str_replace('_', ' ', $transaction->status) }}</span></p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
