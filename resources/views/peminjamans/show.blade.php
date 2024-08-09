<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Data Peminjaman') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="grid grid-cols-2 gap-6 mt-4">
            <!-- Nama Ruangan -->
            <div>
                <label for="nama_ruangan" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                <input type="text" id="nama_ruangan" readonly
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $peminjaman->ruangan->nama_ruangan }}">
            </div>
            <!-- Nama Penanggung Jawab -->
            <div>
                <label for="nama_pj" class="block text-sm font-medium text-gray-700">Nama Penanggung Jawab</label>
                <input type="text" id="nama_pj" readonly
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $peminjaman->nama_pj }}">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mt-4">
            <!-- Tanggal Mulai -->
            <div>
                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input type="text" id="tanggal_mulai" readonly
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $peminjaman->tanggal_mulai }}">
            </div>
            <!-- Tanggal Selesai -->
            <div>
                <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                <input type="text" id="tanggal_selesai" readonly
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $peminjaman->tanggal_selesai }}">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mt-4">
            <!-- Jabatan -->
            <div>
                <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                <input type="text" id="jabatan" readonly
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $peminjaman->jabatan }}">
            </div>
            <!-- Instansi -->
            <div>
                <label for="instansi" class="block text-sm font-medium text-gray-700">Instansi</label>
                <input type="text" id="instansi" readonly
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $peminjaman->instansi }}">
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mt-4">
            <!-- Nomor Identitas -->
            <div>
                <label for="nomor_identitas" class="block text-sm font-medium text-gray-700">Nomor KTP / SIM</label>
                <input type="text" id="nomor_identitas" readonly
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $peminjaman->nomor_identitas }}">
            </div>
            <!-- Nomor Telepon -->
            <div>
                <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <input type="text" id="nomor_telepon" readonly
                    class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    value="{{ $peminjaman->nomor_telepon }}">
            </div>
        </div>

        <!-- Keperluan -->
        <div class="mt-4">
            <label for="keperluan" class="block text-sm font-medium text-gray-700">Keperluan</label>
            <textarea id="keperluan" rows="4" readonly
                class="block w-full px-3 py-2 mt-1 text-sm bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $peminjaman->keperluan }}</textarea>
        </div>

        <div class="flex justify-end mt-4">
            <a href="{{ route('peminjamans.index') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                Kembali
            </a>
        </div>
    </div>
</x-app-layout>
