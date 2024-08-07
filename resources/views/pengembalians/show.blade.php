<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Pengembalian') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="grid grid-cols-2 gap-6 mt-4">
            <!-- Nama Ruangan -->
            <div>
                <label for="nama_ruangan" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                <input type="text" id="nama_ruangan" readonly
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $pengembalian->peminjaman->ruangan->nama_ruangan }}">
            </div>
            <!-- Nama Petugas -->
            <div>
                <label for="nama_petugas" class="block text-sm font-medium text-gray-700">Nama Petugas</label>
                <input type="text" id="nama_petugas" readonly
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $pengembalian->peminjaman->petugas->name }}">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mt-4">
            <!-- Nama Peminjam -->
            <div>
                <label for="nama_peminjam" class="block text-sm font-medium text-gray-700">Nama Peminjam</label>
                <input type="text" id="nama_peminjam" readonly
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $pengembalian->peminjaman->peminjam->name }}">
            </div>
            <!-- Tanggal Pinjam -->
            <div>
                <label for="tanggal_pinjam" class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                <input type="text" id="tanggal_pinjam" readonly
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $pengembalian->peminjaman->tanggal_pinjam }}">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mt-4">
            <!-- Tanggal Pengembalian -->
            <div>
                <label for="tanggal_pengembalian" class="block text-sm font-medium text-gray-700">Tanggal
                    Pengembalian</label>
                <input type="text" id="tanggal_pengembalian" readonly
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $pengembalian->tanggal_pengembalian }}">
            </div>
            <!-- Jumlah Hari -->
            <div>
                <label for="jumlah_hari" class="block text-sm font-medium text-gray-700">Jumlah Hari</label>
                <input type="text" id="jumlah_hari" readonly
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $pengembalian->jumlah_hari }}">
            </div>
        </div>

        <div class="flex justify-end mt-4">
            <a href="{{ route('pengembalians.index') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                Kembali
            </a>
        </div>
    </div>
</x-app-layout>
