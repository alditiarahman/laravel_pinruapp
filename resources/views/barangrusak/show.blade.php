<x-app-layout>
    <x-slot name="header">
        {{ __('Show Data Barang Rusak') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <form action="{{ route('barangrusak.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 gap-6 mt-4">
                <!-- Nama Ruangan dan Nama Barang -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="id_ruangan" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                        <input type="text" name="id_ruangan" id="id_ruangan" readonly
                            class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            value="{{ $barangrusak->ruangan->nama_ruangan }}">
                        @error('id_ruangan')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                        <input value="{{ $barangrusak->nama_barang }}" type="text" name="nama_barang"
                            id="nama_barang" autocomplete="off"
                            class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            readonly>
                        @error('nama_barang')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <!-- Foto Barang Rusak -->
                <div x-data="{ fotoBarangPreview: '{{ $barangrusak->foto_barang ? asset('storage/barangrusak/' . $barangrusak->foto_barang) : '' }}' }">
                    <label for="foto_barang" class="block text-sm font-medium text-gray-700">Foto Barang Rusak</label>
                    @error('foto_barang')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    <template x-if="fotoBarangPreview">
                        <div class="mt-2">
                            <img :src="fotoBarangPreview" class="h-28 w-28 object-cover">
                        </div>
                    </template>
                </div>
            </div>
            <div class="flex justify-end mt-4">
                <a href="{{ route('barangrusak.index') }}"
                    class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
