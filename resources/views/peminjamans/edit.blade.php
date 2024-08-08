<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Data Peminjaman') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <form action="{{ route('peminjamans.update', $peminjaman->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama Ruangan -->
            <div class="mb-4">
                <label for="id_ruangan" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                <select name="id_ruangan" id="id_ruangan"
                    class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Pilih Ruangan</option>
                    @foreach ($ruangans as $ruangan)
                        <option value="{{ $ruangan->id }}"
                            {{ $ruangan->id == $peminjaman->id_ruangan ? 'selected' : '' }}>
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
                        value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}"
                        class="block w-full px-3 py-2 mt-1 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <!-- Nama Penanggung Jawab -->
                <div>
                    <label for="nama_pj" class="block text-sm font-medium text-gray-700">Nama Penanggung Jawab</label>
                    <input type="text" name="nama_pj" id="nama_pj"
                        value="{{ old('nama_pj', $peminjaman->nama_pj) }}" autocomplete="off"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('nama_pj')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mt-4">
                <!-- Jabatan -->
                <div>
                    <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan</label>
                    <input type="text" name="jabatan" id="jabatan"
                        value="{{ old('jabatan', $peminjaman->jabatan) }}" autocomplete="off"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('jabatan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Instansi -->
                <div>
                    <label for="instansi" class="block text-sm font-medium text-gray-700">Instansi</label>
                    <input type="text" name="instansi" id="instansi"
                        value="{{ old('instansi', $peminjaman->instansi) }}" autocomplete="off"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('instansi')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6 mt-4">
                <!-- Nomor Identitas -->
                <div>
                    <label for="nomor_identitas" class="block text-sm font-medium text-gray-700">Nomor Identitas</label>
                    <input type="text" name="nomor_identitas" id="nomor_identitas"
                        value="{{ old('nomor_identitas', $peminjaman->nomor_identitas) }}" autocomplete="off"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('nomor_identitas')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Nomor Telepon -->
                <div>
                    <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" id="nomor_telepon"
                        value="{{ old('nomor_telepon', $peminjaman->nomor_telepon) }}" autocomplete="off"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('nomor_telepon')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Keperluan -->
            <div class="mt-4">
                <label for="keperluan" class="block text-sm font-medium text-gray-700">Keperluan</label>
                <textarea name="keperluan" id="keperluan" rows="4"
                    class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('keperluan', $peminjaman->keperluan) }}</textarea>
                @error('keperluan')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mt-4">
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                    Update
                </button>
                <a href="{{ route('peminjamans.index') }}"
                    class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
