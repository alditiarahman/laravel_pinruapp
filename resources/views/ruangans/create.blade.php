<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Data Ruangan') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <form action="{{ route('ruangans.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
                <div>
                    <label for="nama_ruangan" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                    <input type="text" name="nama_ruangan" id="nama_ruangan" autocomplete="off"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('nama_ruangan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="kapasitas" class="block text-sm font-medium text-gray-700">Kapasitas</label>
                    <input type="text" name="kapasitas" id="kapasitas" autocomplete="off"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('kapasitas')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="sm:col-span-2">
                    <label for="fasilitas" class="block text-sm font-medium text-gray-700">Fasilitas</label>
                    <textarea name="fasilitas" id="fasilitas" cols="30" rows="10"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                    @error('fasilitas')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex space-x-2 justify-end mt-4">
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-500 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Simpan
                </button>
                <a href="{{ route('ruangans.index') }}"
                    class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
