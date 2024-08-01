<x-app-layout>
    <x-slot name="header">
        {{ __('Perubahan Jadwal') }}
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
            <a href="{{ route('cetak-perubahanjadwal') }}" target="_blank"
                class="flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green ml-2">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd"
                        d="M8 3a2 2 0 0 0-2 2v3h12V5a2 2 0 0 0-2-2H8Zm-3 7a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h1v-4a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1v4h1a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2H5Zm4 11a1 1 0 0 1-1-1v-4h8v4a1 1 0 0 1-1 1H9Z"
                        clip-rule="evenodd" />
                </svg>
                Cetak Data Laporan Perubahan Jadwal
            </a>
            <a href="{{ route('perubahanjadwals.create') }}"
                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue"
                x-show="('{{ auth()->user()->hasRole('peminjam') }}')">
                Tambah Perubahan Jadwal
            </a>
        </div>

        <div class="overflow-hidden
                mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">Nama Ruangan</th>
                            <th class="px-4 py-3">Nama Peminjam</th>
                            <th class="px-4 py-3">Tanggal Pinjam</th>
                            <th class="px-4 py-3">Tanggal Perubahan</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($perubahanjadwal as $ubahjadwal)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    {{ $ubahjadwal->peminjaman->ruangan->nama_ruangan }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $ubahjadwal->peminjaman->peminjam->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $ubahjadwal->peminjaman->tanggal_pinjam }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $ubahjadwal->tanggal_perubahan }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($ubahjadwal->status == 'menunggu')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-500 text-white">
                                            Pending
                                        </span>
                                    @elseif ($ubahjadwal->status == 'disetujui')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 text-white">
                                            Accepted
                                        </span>
                                    @elseif ($ubahjadwal->status == 'ditolak')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white">
                                            Rejected
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex space-x-2 items-center">
                                        <a href="{{ route('perubahanjadwals.show', $ubahjadwal->id) }}"
                                            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                            Show
                                        </a>
                                        <a href="{{ route('perubahanjadwals.edit', $ubahjadwal->id) }}"
                                            class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green"
                                            x-show="('{{ auth()->user()->hasRole('peminjam') }}' && '{{ $ubahjadwal->status }}' === 'menunggu' || '{{ $ubahjadwal->status }}' === 'ditolak')">
                                            Edit
                                        </a>
                                        <!-- Modal Trigger DELETE -->
                                        <div x-data="{ openDelete: false }" class="inline">
                                            <!-- DELETE BTN -->
                                            <button @click="openDelete = true"
                                                class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red"
                                                x-show="('{{ auth()->user()->hasRole('peminjam') }}' && '{{ $ubahjadwal->status }}' === 'menunggu')">
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                                </svg>
                                            </button>

                                            <!-- Delete Modal -->
                                            <div x-show="openDelete"
                                                x-transition:enter="transition ease-out duration-150"
                                                x-transition:enter-start="opacity-0"
                                                x-transition:enter-end="opacity-100"
                                                x-transition:leave="transition ease-in duration-150"
                                                x-transition:leave-start="opacity-100"
                                                x-transition:leave-end="opacity-0"
                                                class="fixed inset-0 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
                                                <div x-show="openDelete"
                                                    x-transition:enter="transition ease-out duration-150"
                                                    x-transition:enter-start="opacity-0 transform translate-y-1/2"
                                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                                    x-transition:leave="transition ease-in duration-150"
                                                    x-transition:leave-start="opacity-100 transform translate-y-0"
                                                    x-transition:leave-end="opacity-0 transform translate-y-1/2"
                                                    @click.away="openDelete = false"
                                                    @keydown.escape="openDelete = false"
                                                    class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg sm:rounded-lg sm:m-4 sm:max-w-xl"
                                                    role="dialog" id="modal">
                                                    <!-- Modal body -->
                                                    <div class="mt-4 mb-6">
                                                        <!-- Modal title -->
                                                        <p class="mb-2 text-lg font-semibold text-gray-700">
                                                            Hapus Data
                                                        </p>
                                                        <!-- Modal description -->
                                                        <p class="text-sm text-gray-700">
                                                            Apakah Anda yakin ingin menghapus data <span
                                                                class="font-semibold">{{ $ubahjadwal->nama_peminjam }}</span>?
                                                        </p>
                                                    </div>
                                                    <footer
                                                        class="flex flex-col items-center justify-end space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row">
                                                        <button @click="openDelete = false"
                                                            class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                                                            Batal
                                                        </button>
                                                        <form
                                                            action="{{ route('perubahanjadwals.destroy', $ubahjadwal->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </footer>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Trigger VERIFY -->
                                        <div x-data="{ openVerify: false }" class="inline">
                                            <!-- VERIFY Trigger -->
                                            <button @click="openVerify = true"
                                                class="flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue"
                                                x-show="('{{ auth()->user()->hasRole('operator') }}' && '{{ auth()->user()->hasRole('admin') }}' && '{{ $ubahjadwal->status }}' === 'menunggu')">
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M5 11.917L9.724 16.5 19 7.5" />
                                                </svg>
                                            </button>

                                            <!-- Verify Modal -->
                                            <div x-show="openVerify"
                                                x-transition:enter="transition ease-out duration-150"
                                                x-transition:enter-start="opacity-0"
                                                x-transition:enter-end="opacity-100"
                                                x-transition:leave="transition ease-in duration-150"
                                                x-transition:leave-start="opacity-100"
                                                x-transition:leave-end="opacity-0"
                                                class="fixed inset-0 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
                                                <div x-show="openVerify"
                                                    x-transition:enter="transition ease-out duration-150"
                                                    x-transition:enter-start="opacity-0 transform translate-y-1/2"
                                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                                    x-transition:leave="transition ease-in duration-150"
                                                    x-transition:leave-start="opacity-100 transform translate-y-0"
                                                    x-transition:leave-end="opacity-0 transform translate-y-1/2"
                                                    @click.away="openVerify = false"
                                                    @keydown.escape="openVerify = false"
                                                    class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg sm:rounded-lg sm:m-4 sm:max-w-xl"
                                                    role="dialog" id="modal">
                                                    <!-- Modal body -->
                                                    <div class="mt-4 mb-6">
                                                        <!-- Modal title -->
                                                        <p class="mb-2 text-lg font-semibold text-gray-700">
                                                            Confirm Verification
                                                        </p>
                                                        <!-- Modal description -->
                                                        <p class="text-sm text-gray-700">
                                                            Are you sure you want to verify <span
                                                                class="font-semibold">{{ $ubahjadwal->nama_peminjam }}</span>?
                                                        </p>
                                                    </div>
                                                    <footer
                                                        class="flex flex-col items-center justify-end space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row">
                                                        <button @click="openVerify = false"
                                                            class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                                                            Cancel
                                                        </button>
                                                        <form
                                                            action="{{ route('perubahanjadwals.verify', $ubahjadwal->id) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-blue-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-blue-600 hover:bg-blue-700 focus:outline-none focus:shadow-outline-blue">
                                                                Verify
                                                            </button>
                                                        </form>
                                                    </footer>
                                                </div>
                                            </div>
                                        </div>


                                        <!-- Modal Trigger REJECT -->
                                        <div x-data="{ openReject: false }" class="inline">
                                            <!-- REJECT Trigger -->
                                            <button @click="openReject = true"
                                                class="flex items-center px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red"
                                                x-show="('{{ auth()->user()->hasRole('operator') }}' && '{{ auth()->user()->hasRole('admin') }}' && '{{ $ubahjadwal->status }}' === 'menunggu')">
                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>

                                            <!-- Reject Modal -->
                                            <div x-show="openReject"
                                                x-transition:enter="transition ease-out duration-150"
                                                x-transition:enter-start="opacity-0"
                                                x-transition:enter-end="opacity-100"
                                                x-transition:leave="transition ease-in duration-150"
                                                x-transition:leave-start="opacity-100"
                                                x-transition:leave-end="opacity-0"
                                                class="fixed inset-0 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
                                                <div x-show="openReject"
                                                    x-transition:enter="transition ease-out duration-150"
                                                    x-transition:enter-start="opacity-0 transform translate-y-1/2"
                                                    x-transition:enter-end="opacity-100 transform translate-y-0"
                                                    x-transition:leave="transition ease-in duration-150"
                                                    x-transition:leave-start="opacity-100 transform translate-y-0"
                                                    x-transition:leave-end="opacity-0 transform translate-y-1/2"
                                                    @click.away="openReject = false"
                                                    @keydown.escape="openReject = false"
                                                    class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg sm:rounded-lg sm:m-4 sm:max-w-xl"
                                                    role="dialog" id="modal">
                                                    <!-- Modal body -->
                                                    <div class="mt-4 mb-6">
                                                        <!-- Modal title -->
                                                        <p class="mb-2 text-lg font-semibold text-gray-700">
                                                            Confirm Rejection
                                                        </p>
                                                        <!-- Modal description -->
                                                        <p class="text-sm text-gray-700">
                                                            Are you sure you want to reject <span
                                                                class="font-semibold">{{ $ubahjadwal->nama_peminjam }}</span>
                                                            ?
                                                        </p>
                                                        <!-- Input for rejection note -->
                                                        <form
                                                            action="{{ route('perubahanjadwals.reject', $ubahjadwal->id) }}"
                                                            method="POST" class="mt-4">
                                                            @csrf
                                                            @method('PATCH')
                                                            <footer
                                                                class="flex flex-col items-center justify-end space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row">
                                                                <button @click="openReject = false" type="button"
                                                                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                                                                    Cancel
                                                                </button>
                                                                <button type="submit"
                                                                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-red-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-red-600 hover:bg-red-700 focus:outline-none focus:shadow-outline-red">
                                                                    Reject
                                                                </button>
                                                            </footer>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{ $perubahanjadwal->links() }}
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
