<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Data Pembatalan') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <form action="{{ route('pembatalans.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-2 gap-6 mt-4">
                <!-- ID Peminjaman -->
                <div class="mb-4">
                    <label for="id_peminjaman" class="block text-sm font-medium text-gray-700">ID Peminjaman</label>
                    <select name="id_peminjaman" id="id_peminjaman"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Pilih ID Peminjaman</option>
                        @foreach ($peminjamans as $peminjaman)
                            <option value="{{ $peminjaman->id }}"> {{ $peminjaman->peminjam->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_peminjaman')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Nama Ruangan -->
                <div>
                    <label for="nama_ruangan" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" id="nama_ruangan" readonly
                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mt-4">
                <!-- Nama Petugas -->
                <div>
                    <label for="nama_petugas" class="block text-sm font-medium text-gray-700">Nama Petugas</label>
                    <input type="text" name="nama_petugas" id="nama_petugas" readonly
                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <!-- Nama Peminjam -->
                <div>
                    <label for="nama_peminjam" class="block text-sm font-medium text-gray-700">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" id="nama_peminjam" readonly
                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mt-4">
                <!-- Tanggal Pinjam -->
                <div>
                    <label for="tanggal_pinjam" class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                    <input type="text" name="tanggal_pinjam" id="tanggal_pinjam" readonly
                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <!-- Tanggal Pembatalan -->
                <div>
                    <label for="tanggal_pembatalan" class="block text-sm font-medium text-gray-700">Tanggal
                        Pembatalan</label>
                    <input type="date" name="tanggal_pembatalan" id="tanggal_pembatalan"
                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
            </div>

            <!-- Alasan Pembatalan -->
            <div class="mt-4">
                <label for="alasan_pembatalan" class="block text-sm font-medium text-gray-700">Alasan Pembatalan</label>
                <textarea name="alasan_pembatalan" id="alasan_pembatalan" rows="4"
                    class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                @error('alasan_pembatalan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                    Simpan
                </button>
                <a href="{{ route('pembatalans.index') }}"
                    class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                    Kembali
                </a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#id_peminjaman').change(function() {
                var peminjamanId = $(this).val();
                if (peminjamanId) {
                    $.ajax({
                        url: '{{ route('pembatalans.create') }}',
                        type: 'GET',
                        data: {
                            ajax: true
                        },
                        dataType: 'json',
                        success: function(data) {
                            var selectedPeminjaman = data.find(peminjaman => peminjaman.id ==
                                peminjamanId);
                            if (selectedPeminjaman) {
                                $('#nama_ruangan').val(selectedPeminjaman.ruangan.nama_ruangan);
                                $('#nama_petugas').val(selectedPeminjaman.petugas.name);
                                $('#nama_peminjam').val(selectedPeminjaman.peminjam.name);
                                $('#tanggal_pinjam').val(selectedPeminjaman.tanggal_pinjam);
                            }
                        }
                    });
                } else {
                    $('#nama_ruangan').val('');
                    $('#nama_petugas').val('');
                    $('#nama_peminjam').val('');
                    $('#tanggal_pinjam').val('');
                }
            });
        });
    </script>
</x-app-layout>
