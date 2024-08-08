<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Data Peminjaman') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <!-- Nama Ruangan -->
        <div class="mb-4">
            <label for="id_ruangan" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
            <p class="mt-1 text-sm text-gray-900">{{ $peminjaman->ruangan->nama_ruangan }}</p>
        </div>

        <div class="grid grid-cols-2 gap-6 mt-4">
            <!-- Tanggal Pinjam -->
            <div>
                <label for="tanggal_pinjam" class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                <p class="mt-1 text-sm text-gray-900">{{ $peminjaman->tanggal_pinjam }}</p>
            </div>
            <!-- Nama Penanggung Jawab -->
            <div>
                <label for="nama_pj" class="block text-sm font-medium text-gray-700">Nama Penanggung Jawab</label>
                <p class="mt-1 text-sm text-gray-900">{{ $peminjaman->nama_pj }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mt-4">
            <!-- Jabatan -->
            <div>
                <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                <p class="mt-1 text-sm text-gray-900">{{ $peminjaman->jabatan }}</p>
            </div>
            <!-- Instansi -->
            <div>
                <label for="instansi" class="block text-sm font-medium text-gray-700">Instansi</label>
                <p class="mt-1 text-sm text-gray-900">{{ $peminjaman->instansi }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6 mt-4">
            <!-- Nomor Identitas -->
            <div>
                <label for="nomor_identitas" class="block text-sm font-medium text-gray-700">Nomor KTP / SIM</label>
                <p class="mt-1 text-sm text-gray-900">{{ $peminjaman->nomor_identitas }}</p>
            </div>
            <!-- Nomor Telepon -->
            <div>
                <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                <p class="mt-1 text-sm text-gray-900">{{ $peminjaman->nomor_telepon }}</p>
            </div>
        </div>

        <!-- Keperluan -->
        <div class="mt-4">
            <label for="keperluan" class="block text-sm font-medium text-gray-700">Keperluan</label>
            <p class="mt-1 text-sm text-gray-900">{{ $peminjaman->keperluan }}</p>
        </div>

        <div class="flex justify-end mt-4">
            <a href="{{ route('peminjamans.index') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                Kembali
            </a>
        </div>
    </div>
</x-app-layout>
