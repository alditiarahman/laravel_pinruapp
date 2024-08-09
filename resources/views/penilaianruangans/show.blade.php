<x-app-layout>
    <x-slot name="header">
        {{ __('Show Data Penilaian Ruangan') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <form action="{{ route('penilaianruangans.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Nama Ruangan -->
                <div class="mt-4">
                    <label for="id_ruangan" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                    <input type="text" name="id_ruangan" id="id_ruangan" readonly
                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ $penilaianruangan->ruangan->nama_ruangan }}">
                    @error('id_ruangan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            <div class="grid grid-cols-2 gap-6 mt-4">
                <!-- Peminjam -->
                <div>
                    <label for="id_peminjam" class="block text-sm font-medium text-gray-700">Nama Peminjam</label>
                    <input type="text" name="id_peminjam" id="id_peminjam" readonly
                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        value="{{ $penilaianruangan->peminjam->name }}">
                    @error('id_peminjam')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Kebersihan -->
                <div>
                    <label for="kebersihan" class="block text-sm font-medium text-gray-700">Kebersihan</label>
                    <input value="{{ $penilaianruangan->kebersihan }}" type="text" name="kebersihan" id="kebersihan"
                        autocomplete="off"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        readonly>
                    @error('kebersihan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="grid grid-cols-2 gap-6 mt-4">
                <!-- Kenyamanan -->
                <div>
                    <label for="kenyamanan" class="block text-sm font-medium text-gray-700">Kenyamanan</label>
                    <input value="{{ $penilaianruangan->kenyamanan }}" type="text" name="kenyamanan" id="kenyamanan"
                        autocomplete="off"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        readonly>
                    @error('kenyamanan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Kelengkapan Fasilitas -->
                <div>
                    <label for="kelengkapan_fasilitas" class="block text-sm font-medium text-gray-700">Kelengkapan
                        Fasilitas</label>
                    <input value="{{ $penilaianruangan->kelengkapan_fasilitas }}" type="text"
                        name="kelengkapan_fasilitas" id="kelengkapan_fasilitas" autocomplete="off"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        readonly>
                    @error('kelengkapan_fasilitas')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Saran -->
            <div class="mt-4">
                <label for="saran" class="block text-sm font-medium text-gray-700">Saran</label>
                <textarea name="saran" id="saran" rows="4" readonly
                    class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ $penilaianruangan->saran }}</textarea>
                @error('saran')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mt-4">
                <a href="{{ route('penilaianruangans.index') }}"
                    class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
