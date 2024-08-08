<x-app-layout>
    <x-slot name="header">
        {{ __('Detail Data Maintenance') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">
        <!-- Nama Ruangan -->
        <div>
            <label class="block text-sm font-medium text-gray-700">Nama Ruangan</label>
            <p class="mt-1 text-sm text-gray-900">{{ $maintenance->ruangan->nama_ruangan }}</p>
        </div>

        <div class="grid grid-cols-2 gap-6 mt-4">
            <!-- Tanggal Maintenance -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Tanggal Maintenance</label>
                <p class="mt-1 text-sm text-gray-900">{{ $maintenance->tanggal_maintenance }}</p>
            </div>
            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Status</label>
                <p class="mt-1 text-sm text-gray-900">{{ ucfirst($maintenance->status) }}</p>
            </div>
        </div>

        <div class="flex justify-end mt-4">
            <a href="{{ route('maintenances.index') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                Kembali
            </a>
        </div>
    </div>
</x-app-layout>
