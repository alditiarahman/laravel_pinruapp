<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Data Penilaian Petugas') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <form action="{{ route('penilaianpetugas.update', $penilaianpetugas->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-6 mt-4">
                <!-- Nama Petugas -->
                <div>
                    <label for="id_petugas" class="block text-sm font-medium text-gray-700">Nama Petugas</label>
                    <select name="id_petugas" id="id_petugas"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="">Pilih Petugas</option>
                        @foreach ($users as $petugas)
                            <option value="{{ $petugas->id }}"
                                {{ $penilaianpetugas->id_petugas == $petugas->id ? 'selected' : '' }}>
                                {{ $petugas->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_petugas')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Pelayanan -->
                <div>
                    <label for="pelayanan" class="block text-sm font-medium text-gray-700">Pelayanan</label>
                    <select name="pelayanan" id="pelayanan"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="fast respon"
                            {{ $penilaianpetugas->pelayanan == 'fast respon' ? 'selected' : '' }}>Fast Response</option>
                        <option value="slow respon"
                            {{ $penilaianpetugas->pelayanan == 'slow respon' ? 'selected' : '' }}>Slow Response</option>
                    </select>
                    @error('pelayanan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Saran -->
            <div class="mt-4">
                <label for="saran" class="block text-sm font-medium text-gray-700">Saran</label>
                <textarea name="saran" id="saran" rows="4"
                    class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('saran', $penilaianpetugas->saran) }}</textarea>
                @error('saran')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex space-x-2 justify-end mt-4">
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-500 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Update
                </button>
                <a href="{{ route('penilaianpetugas.index') }}"
                    class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
