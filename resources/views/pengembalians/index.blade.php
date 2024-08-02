<x-app-layout>
    <x-slot name="header">
        {{ __('Pengembalian') }}
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

        <div class="flex space-x-2 justify-end mb-4">
            <a href="{{ route('cetak-pengembalian') }}" target="_blank"
                class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-500 border border-transparent rounded-lg active:bg-pruple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                </svg>
            </a>
            <a href="{{ route('pengembalians.create') }}"
                class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-500 border border-transparent rounded-lg active:bg-pruple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                x-show="('{{ auth()->user()->hasRole('peminjam') }}')">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </div>

        <div class="overflow-hidden
                mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 text-center uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">Nama Ruangan</th>
                            <th class="px-4 py-3">Nama Peminjam</th>
                            <th class="px-4 py-3">Tanggal Pinjam</th>
                            <th class="px-4 py-3">Tanggal Pengembalian</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($pengembalian as $kembali)
                            <tr class="text-gray-700 text-center">
                                <td class="px-4 py-3 text-sm">
                                    {{ $kembali->peminjaman->ruangan->nama_ruangan }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $kembali->peminjaman->peminjam->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $kembali->peminjaman->tanggal_pinjam }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $kembali->tanggal_pengembalian }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex justify-center space-x-2 items-center">
                                        <a href="{{ route('pengembalians.show', $kembali->id) }}"
                                            class="px-1 py-2 text-sm font-medium leading-5 text-purple-500 transition-colors duration-150 border border-transparent rounded-lg active:text-purple-600 hover:text-purple-700 focus:outline-none focus:shadow-outline-purple">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-6">
                                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                <path fill-rule="evenodd"
                                                    d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('pengembalians.edit', $kembali->id) }}"
                                            class="px-1 py-2 text-sm font-medium leading-5 text-purple-500 transition-colors duration-150 border border-transparent rounded-lg active:text-purple-600 hover:text-purple-700 focus:outline-none focus:shadow-outline-purple">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-6">
                                                <path
                                                    d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                            </svg>
                                        </a>
                                        <!-- Modal Trigger DELETE -->
                                        <div x-data="{ openDelete: false }" class="inline">
                                            <!-- DELETE BTN -->
                                            <button @click="openDelete = true"
                                                class="px-1 py-2 text-sm font-medium leading-5 text-purple-500 transition-colors duration-150 border border-transparent rounded-lg active:text-purple-600 hover:text-purple-700 focus:outline-none focus:shadow-outline-purple">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="size-6">
                                                    <path fill-rule="evenodd"
                                                        d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                        clip-rule="evenodd" />
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
                                                                class="font-semibold">{{ $kembali->nama_peminjam }}</span>?
                                                        </p>
                                                    </div>
                                                    <footer
                                                        class="flex flex-col items-center justify-end space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row">
                                                        <button @click="openDelete = false"
                                                            class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                                                            Batal
                                                        </button>
                                                        <form
                                                            action="{{ route('pengembalians.destroy', $kembali->id) }}"
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
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div
                class="px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase bg-gray-50 border-t sm:grid-cols-9">
                {{ $pengembalian->links() }}
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
