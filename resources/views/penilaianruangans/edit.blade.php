<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Data Penilaian Ruangan') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <form action="{{ route('penilaianruangans.update', $penilaianruangan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Ruangan -->
            <div class="mb-4">
                <label for="id_ruangan" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                <select name="id_ruangan" id="id_ruangan"
                    class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Pilih Ruangan</option>
                    @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->id }}" {{ $penilaianruangan->id_ruangan == $ruangan->id ? 'selected' : '' }}>
                            {{ $ruangan->nama_ruangan }}
                        </option>
                    @endforeach
                </select>
                @error('id_ruangan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-6 mt-4">
                <!-- Tanggal Pinjam -->
                <div>
                    <label for="tanggal_pinjam" class="block text-sm font-medium text-gray-700">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" id="tanggal_pinjam"
                        value="{{ old('tanggal_pinjam', $penilaianruangan->tanggal_pinjam) }}"
                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <!-- Kebersihan -->
                <div>
                    <label for="kebersihan" class="block text-sm font-medium text-gray-700">Kebersihan</label>
                    <select name="kebersihan" id="kebersihan"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="bersih" {{ $penilaianruangan->kebersihan == 'bersih' ? 'selected' : '' }}>Bersih</option>
                        <option value="cukup bersih" {{ $penilaianruangan->kebersihan == 'cukup bersih' ? 'selected' : '' }}>Cukup Bersih</option>
                        <option value="kurang bersih" {{ $penilaianruangan->kebersihan == 'kurang bersih' ? 'selected' : '' }}>Kurang Bersih</option>
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
                        <option value="nyaman" {{ $penilaianruangan->kenyamanan == 'nyaman' ? 'selected' : '' }}>Nyaman</option>
                        <option value="cukup nyaman" {{ $penilaianruangan->kenyamanan == 'cukup nyaman' ? 'selected' : '' }}>Cukup Nyaman</option>
                        <option value="kurang nyaman" {{ $penilaianruangan->kenyamanan == 'kurang nyaman' ? 'selected' : '' }}>Kurang Nyaman</option>
                    </select>
                    @error('kenyamanan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Kelengkapan Fasilitas -->
                <div>
                    <label for="kelengkapan_fasilitas" class="block text-sm font-medium text-gray-700">Kelengkapan Fasilitas</label>
                    <select name="kelengkapan_fasilitas" id="kelengkapan_fasilitas"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="lengkap" {{ $penilaianruangan->kelengkapan_fasilitas == 'lengkap' ? 'selected' : '' }}>Lengkap</option>
                        <option value="cukup lengkap" {{ $penilaianruangan->kelengkapan_fasilitas == 'cukup lengkap' ? 'selected' : '' }}>Cukup Lengkap</option>
                        <option value="kurang lengkap" {{ $penilaianruangan->kelengkapan_fasilitas == 'kurang lengkap' ? 'selected' : '' }}>Kurang Lengkap</option>
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
                    class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('saran', $penilaianruangan->saran) }}</textarea>
                @error('saran')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                    Update
                </button>
                <a href="{{ route('penilaianruangans.index') }}"
                    class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
