<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Data Penilaian Petugas') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="grid grid-cols-2 gap-6 mt-4">
            <!-- Nama Petugas -->
            <div>
                <label for="id_petugas" class="block text-sm font-medium text-gray-700">Nama Petugas</label>
                <p class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm">
                    {{ $penilaianpetugas->petugas->name }}
                </p>
            </div>
            <!-- Pelayanan -->
            <div>
                <label for="pelayanan" class="block text-sm font-medium text-gray-700">Pelayanan</label>
                <p class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm">
                    {{ $penilaianpetugas->pelayanan }}
                </p>
            </div>
        </div>

        <!-- Saran -->
        <div class="mt-4">
            <label for="saran" class="block text-sm font-medium text-gray-700">Saran</label>
            <p class="block w-full px-3 py-2 mt-1 text-sm border border-gray-300 rounded-md shadow-sm">
                {{ $penilaianpetugas->saran }}
            </p>
        </div>

        <div class="flex justify-end mt-4">
            <a href="{{ route('penilaianpetugas.index') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                Kembali
            </a>
        </div>
    </div>
</x-app-layout>
