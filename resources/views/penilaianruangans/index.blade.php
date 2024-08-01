<x-app-layout>
    <x-slot name="header">
        {{ __('Penilaian Ruangan') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">

        <!-- Alert section -->
        @if (session('success'))
            <div id="alert-success" class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md">
                <div class="flex justify-center items-center w-12 bg-blue-500">
                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
                        </path>
                    </svg>
                </div>
                <div class="px-4 py-2 -mx-3">
                    <div class="mx-3">
                        <span class="font-semibold text-blue-500">Success</span>
                        <p class="text-sm text-gray-600">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @elseif(session('error'))
            <div id="alert-error" class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md">
                <div class="flex justify-center items-center w-12 bg-red-500">
                    <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z">
                        </path>
                    </svg>
                </div>
                <div class="px-4 py-2 -mx-3">
                    <div class="mx-3">
                        <span class="font-semibold text-red-500">Error</span>
                        <p class="text-sm text-gray-600">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif
        <!-- End of alert section -->

        <div class="flex justify-end mb-4">
            <a href="{{ route('cetak-penilaianruangan') }}" target="_blank"
                class="flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green ml-2">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z"
                        clip-rule="evenodd" />
                </svg>
                Cetak Data Laporan Penilaian Ruangan
            </a>
            <a href="{{ route('penilaianruangans.create') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                Tambah Penilaian Ruangan
            </a>
        </div>

        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">Nama Ruangan</th>
                            <th class="px-4 py-3">Nama Peminjam</th>
                            <th class="px-4 py-3">Tanggal Pinjam</th>
                            <th class="px-4 py-3">Kebersihan</th>
                            <th class="px-4 py-3">Kenyamanan</th>
                            <th class="px-4 py-3">Kelengkapan Fasilitas</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($penilaianruangan as $nilairuangan)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    {{ $nilairuangan->ruangan->nama_ruangan }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $nilairuangan->peminjam->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $nilairuangan->tanggal_pinjam }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($nilairuangan->kebersihan == 'bersih')
                                        Bersih
                                    @elseif ($nilairuangan->kebersihan == 'cukup bersih')
                                        Cukup Bersih
                                    @elseif ($nilairuangan->kebersihan == 'kurang bersih')
                                        Kurang bersih
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($nilairuangan->kenyamanan == 'nyaman')
                                        Nyaman
                                    @elseif ($nilairuangan->kenyamanan == 'cukup nyaman')
                                        Cukup Nyaman
                                    @elseif ($nilairuangan->kenyamanan == 'kurang nyaman')
                                        Kurang Nyaman
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($nilairuangan->kelengkapan_fasilitas == 'lengkap')
                                        Lengkap
                                    @elseif ($nilairuangan->kelengkapan_fasilitas == 'cukup lengkap')
                                        Cukup Lengkap
                                    @elseif ($nilairuangan->kelengkapan_fasilitas == 'kurang lengkap')
                                        Kurang Lengkap
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <a href="{{ route('penilaianruangans.show', $nilairuangan->id) }}"
                                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                        Show
                                    </a>
                                    <a href="{{ route('penilaianruangans.edit', $nilairuangan->id) }}"
                                        class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green">
                                        Edit
                                    </a>
                                    <form action="{{ route('penilaianruangans.destroy', $nilairuangan->id) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red"
                                            onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{ $penilaianruangan->links() }}
            </div>
        </div>

    </div>

    <!-- Add this script block to hide the alert after 3 seconds -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                var alertSuccess = document.getElementById('alert-success');
                var alertError = document.getElementById('alert-error');
                if (alertSuccess) {
                    alertSuccess.style.display = 'none';
                }
                if (alertError) {
                    alertError.style.display = 'none';
                }
            }, 3000);
        });
    </script>

</x-app-layout>
