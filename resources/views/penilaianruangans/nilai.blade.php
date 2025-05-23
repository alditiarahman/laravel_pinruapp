<x-app-layout>
    <x-slot name="header">
        {{ __('Tambah Data Penilaian Ruangan') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <form action="{{ route('penilaianruangans.nilaiRuangan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id_peminjaman" value="{{ $pinjam->id }}">

            <div class="grid grid-cols-2 gap-6 mt-4">
                <!-- Nama Ruangan -->
                <div>
                    <label for="id_ruangan" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                    <input type="text" id="id_ruangan" name="id_ruangan" value="{{ $ruangan->nama_ruangan }}"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        readonly>

                    <!-- Menyembunyikan ID ruangan di form -->
                    <input type="hidden" name="id_ruangan" value="{{ $ruangan->id }}">

                    @error('id_ruangan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Kebersihan -->
                <div>
                    <label for="kebersihan" class="block text-sm font-medium text-gray-700">Kebersihan</label>
                    <select name="kebersihan" id="kebersihan"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="bersih">Bersih</option>
                        <option value="cukup bersih">Cukup Bersih</option>
                        <option value="kurang bersih">Kurang Bersih</option>
                    </select>
                    @error('kebersihan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6 mt-4">
                <!-- Kenyamanan -->
                <div>
                    <label for="kenyamanan" class="block text-sm font-medium text-gray-700">Kenyamanan</label>
                    <select name="kenyamanan" id="kenyamanan"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="nyaman">Nyaman</option>
                        <option value="cukup nyaman">Cukup Nyaman</option>
                        <option value="kurang nyaman">Kurang Nyaman</option>
                    </select>
                    @error('kenyamanan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Kelengkapan Fasilitas -->
                <div>
                    <label for="kelengkapan_fasilitas" class="block text-sm font-medium text-gray-700">Kelengkapan
                        Fasilitas</label>
                    <select name="kelengkapan_fasilitas" id="kelengkapan_fasilitas"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="lengkap">Lengkap</option>
                        <option value="cukup lengkap">Cukup Lengkap</option>
                        <option value="kurang lengkap">Kurang Lengkap</option>
                    </select>
                    @error('kelengkapan_fasilitas')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Saran -->
            <div class="mt-4">
                <label for="saran" class="block text-sm font-medium text-gray-700">Saran</label>
                <textarea name="saran" id="saran" rows="4"
                    class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                @error('saran')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-2 justify-end mt-4">
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-500 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Simpan
                </button>
                <a href="{{ route('penilaianruangans.index') }}"
                    class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
