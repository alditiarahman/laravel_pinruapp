<x-app-layout>
    <x-slot name="header">
        {{ __('Show Data Peminjaman') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <form action="{{ route('peminjamans.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-2 gap-6 mt-4">
                <!-- Nama Ruangan -->
                <div>
                    <label for="id_ruangan" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                    <input type="text" name="id_ruangan" id="id_ruangan" readonly
                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ $peminjaman->ruangan->nama_ruangan }}">
                    @error('id_ruangan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Peminjam -->
                <div>
                    <label for="id_peminjam" class="block text-sm font-medium text-gray-700">Nama Peminjam</label>
                    <input type="text" name="id_peminjam" id="id_peminjam" readonly
                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ $peminjaman->peminjam->name }}">
                    @error('id_peminjam')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6 mt-4">
                <!-- Petugas -->
                <div>
                    <label for="id_petugas" class="block text-sm font-medium text-gray-700">Disetujui Oleh</label>
                    <input type="text" name="id_petugas" id="id_petugas" readonly
                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ $peminjaman->petugas ? $peminjaman->petugas->name : 'Belum Disetujui' }}">
                    @error('id_petugas')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Tanggal Pinjam -->
                <div>
                    <label for="tanggal_pinjam" class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                    <input value="{{ $peminjaman->tanggal_pinjam }}" type="text" name="tanggal_pinjam"
                        id="tanggal_pinjam" autocomplete="off"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        readonly>
                    @error('tanggal_pinjam')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6 mt-4">
                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <input value="{{ $peminjaman->status }}" type="text" name="status" id="status"
                        autocomplete="off"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        readonly>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="surat_pernyataan" class="block text-sm font-medium text-gray-700">Surat
                        Pernyataan</label>
                    <a href="{{ asset('storage/peminjamans/' . $peminjaman->surat_pernyataan) }}" target="_blank"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm text-blue-500">Lihat
                        Surat Pernyataan</a>
                </div>
            </div>

            <!-- Keperluan -->
            <div class="mt-4">
                <label for="keperluan" class="block text-sm font-medium text-gray-700">Keperluan</label>
                <textarea name="keperluan" id="keperluan" rows="4" readonly
                    class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $peminjaman->keperluan }}</textarea>
                @error('keperluan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mt-4">
                <a href="{{ route('peminjamans.index') }}"
                    class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
