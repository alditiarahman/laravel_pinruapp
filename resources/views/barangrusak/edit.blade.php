<x-app-layout>
    <x-slot name="header">
        {{ __('Edit Data Barang Rusak') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <form action="{{ route('barangrusak.update', $barangrusak->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 gap-6 mt-4">
                <!-- Nama Ruangan -->
                <div>
                    <label for="id_ruangan" class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
                    <select name="id_ruangan" id="id_ruangan"
                        class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        onchange="showFasilitas(this)">
                        <option value="">Pilih Ruangan</option>
                        @foreach ($ruangans as $ruangan)
                            <option value="{{ $ruangan->id }}" data-fasilitas="{{ $ruangan->fasilitas }}"
                                {{ $ruangan->id == $barangrusak->id_ruangan ? 'selected' : '' }}>
                                {{ $ruangan->nama_ruangan }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_ruangan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Nama Barang dan Foto Barang Rusak -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang</label>
                        <select name="nama_barang" id="nama_barang"
                            class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Pilih Barang</option>
                        </select>
                        @error('nama_barang')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <script>
                        const selectFasilitas = document.getElementById('nama_barang');
                        const oldNamaBarang = "{{ $barangrusak->nama_barang }}";

                        document.getElementById('id_ruangan').addEventListener('change', (e) => {
                            const fasilitas = e.target.options[e.target.selectedIndex].dataset.fasilitas;
                            const fasilitasArray = JSON.parse(fasilitas);
                            const fasilitasNames = fasilitasArray.map(f => f[0]);
                            const fasilitasJumlahs = fasilitasArray.map(f => f[1]);
                            selectFasilitas.innerHTML = '<option value="">Pilih Barang</option>';
                            fasilitasNames.forEach((f, i) => {
                                const option = document.createElement('option');
                                option.value = f;
                                option.textContent = `${f} (Jumlah: ${fasilitasJumlahs[i]})`;
                                if (f === oldNamaBarang) {
                                    option.selected = true;
                                }
                                selectFasilitas.appendChild(option);
                            });
                        });

                        document.getElementById('nama_barang').addEventListener('change', (e) => {
                            const fasilitas = e.target.options[e.target.selectedIndex].textContent;
                            const jumlah = fasilitas.split(' (Jumlah: ')[1].replace(')', '');
                            document.getElementById('jumlah').value = jumlah;
                        });

                        // Load initial data on page load
                        window.addEventListener('DOMContentLoaded', (e) => {
                            const event = new Event('change');
                            document.getElementById('id_ruangan').dispatchEvent(event);
                        });
                    </script>
                    <div>
                        <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                        <input type="number" name="jumlah" id="jumlah"
                            class="w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                            value="{{ $barangrusak->jumlah }}">
                        @error('jumlah')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div>
                    <label for="foto_barang" class="block text-sm font-medium text-gray-700">Foto Barang Rusak</label>
                    <input name="foto_barang" type="file" class="file-input file-input-bordered w-full max-w-xs"
                        x-on:change="fileChosen">
                    @error('foto_barang')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                    @if ($barangrusak->foto_barang)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $barangrusak->foto_barang) }}" class="h-28 w-28 object-cover">
                        </div>
                    @endif
                    <template x-if="fotoBarangPreview">
                        <div class="mt-2">
                            <img x-bind:src="fotoBarangPreview" class="h-28 w-28 object-cover">
                        </div>
                    </template>
                </div>
            </div>

            <div class="flex space-x-2 justify-end mt-4">
                <button type="submit"
                    class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-500 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    Update
                </button>
                <a href="{{ route('barangrusak.index') }}"
                    class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                    Kembali
                </a>
            </div>
        </form>
    </div>

    <script>
        function fileChosen(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    this.fotoBarangPreview = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
