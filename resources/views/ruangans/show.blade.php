<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Data Ruangan') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
            <!-- Room Name -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Nama Ruangan:</h3>
                <p class="mt-1 text-sm text-gray-600">{{ $ruangans->nama_ruangan }}</p>
            </div>

            <!-- Capacity -->
            <div>
                <h3 class="text-lg font-semibold text-gray-700">Kapasitas:</h3>
                <p class="mt-1 text-sm text-gray-600">{{ $ruangans->kapasitas }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-2">
            <!-- Facilities and Quantities -->
            <div class="mt-4">
                <h3 class="text-lg font-semibold text-gray-700">Fasilitas dan Jumlah:</h3>
                <div class="mt-2 space-y-2">
                    @foreach (json_decode($ruangans->fasilitas, true) as $index => $fasilitas)
                        <div class="flex justify items-center">
                            <span class="px-2 text-sm text-gray-600">{{ $fasilitas[0] }}</span>
                            =
                            <span class="px-2 text-sm font-semibold text-gray-800">{{ $fasilitas[1] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex space-x-2 justify-end mt-4">
            <a href="{{ route('ruangans.index') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg hover:bg-gray-200 focus:outline-none">
                Kembali
            </a>
        </div>
    </div>
</x-app-layout>
