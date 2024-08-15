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

        <div class="flex flex-col items-center justify-start space-y-2 md:flex-row md:space-y-0 md:space-x-20">
            <form action="{{ route('cetak-hisniru-ruangan') }}" method="GET" target="_blank">
                <p class="pb-2 text-sm font-semibold text-gray-700">Laporan Riwayat Penilaian Ruangan By Ruangan
                </p>
                <div class="flex space-x-2">
                    <!-- Input Label dan Select -->
                    <div class="flex relative">
                        <select
                            class="block w-max text-sm bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            id="ruangan" name="ruangan">
                            <option value="">Semua Ruangan</option>
                            @foreach ($ruangan as $r)
                                <option value="{{ $r->id }}">{{ $r->nama_ruangan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Button -->
                    <div>
                        <button type="submit" id="generate_pdf" name="generate_pdf"
                            class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-500 border border-transparent rounded-lg active:bg-pruple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
            <form action="{{ route('cetak-hisniru-peminjam') }}" method="GET" target="_blank">
                <p class="pb-2 text-sm font-semibold text-gray-700">Laporan Riwayat Penilaian Ruangan By Peminjam
                </p>
                <div class="flex space-x-2">
                    <!-- Input Label dan Select -->
                    <div class="flex relative">
                        <select
                            class="block w-max text-sm bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            id="peminjam" name="peminjam">
                            <option value="">Semua Peminjam</option>
                            @foreach ($user as $p)
                                <option value="{{ $p->id }}">{{ $p->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Button -->
                    <div>
                        <button type="submit" id="generate_pdf" name="generate_pdf"
                            class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-500 border border-transparent rounded-lg active:bg-pruple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="flex space-x-2 justify-end mb-4">
            <a href="{{ route('cetak-penilaianruangan') }}" target="_blank"
                class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-500 border border-transparent rounded-lg active:bg-pruple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                </svg>
            </a>
            <a href="{{ route('penilaianruangans.create') }}"
                class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-500 border border-transparent rounded-lg active:bg-pruple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </div>

        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 text-center uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">Nama Ruangan</th>
                            <th class="px-4 py-3">Nama Peminjam</th>
                            <th class="px-4 py-3">Kebersihan</th>
                            <th class="px-4 py-3">Kenyamanan</th>
                            <th class="px-4 py-3">Kelengkapan Fasilitas</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y">
                        @foreach ($penilaianruangan as $nilairuangan)
                            <tr class="text-gray-700 text-center">
                                <td class="px-4 py-3 text-sm">
                                    {{ $nilairuangan->ruangan->nama_ruangan }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $nilairuangan->peminjam->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($nilairuangan->kebersihan == 'bersih')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 text-white">
                                            Bersih
                                        </span>
                                    @elseif ($nilairuangan->kebersihan == 'cukup bersih')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-500 text-white">
                                            Cukup Bersih
                                        </span>
                                    @elseif ($nilairuangan->kebersihan == 'kurang bersih')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white">
                                            Kurang Bersih
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($nilairuangan->kenyamanan == 'nyaman')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 text-white">
                                            Nyaman
                                        </span>
                                    @elseif ($nilairuangan->kenyamanan == 'cukup nyaman')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-500 text-white">
                                            Cukup Nyaman
                                        </span>
                                    @elseif ($nilairuangan->kenyamanan == 'kurang nyaman')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white">
                                            Kurang Nyaman
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if ($nilairuangan->kelengkapan_fasilitas == 'lengkap')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-500 text-white">
                                            Lengkap
                                        </span>
                                    @elseif ($nilairuangan->kelengkapan_fasilitas == 'cukup lengkap')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-500 text-white">
                                            Cukup Lengkap
                                        </span>
                                    @elseif ($nilairuangan->kelengkapan_fasilitas == 'kurang lengkap')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-500 text-white">
                                            Kurang Lengkap
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex justify-center items-center space-x-2">
                                        <a href="{{ route('penilaianruangans.show', $nilairuangan->id) }}"
                                            class="px-1 py-2 text-sm font-medium leading-5 text-purple-500 transition-colors duration-150 border border-transparent rounded-lg active:text-purple-600 hover:text-purple-700 focus:outline-none focus:shadow-outline-purple">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-6">
                                                <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                                <path fill-rule="evenodd"
                                                    d="M1.323 11.447C2.811 6.976 7.028 3.75 12.001 3.75c4.97 0 9.185 3.223 10.675 7.69.12.362.12.752 0 1.113-1.487 4.471-5.705 7.697-10.677 7.697-4.97 0-9.186-3.223-10.675-7.69a1.762 1.762 0 0 1 0-1.113ZM17.25 12a5.25 5.25 0 1 1-10.5 0 5.25 5.25 0 0 1 10.5 0Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('cetak-beritaacarapenilaianruangan', $nilairuangan->id) }}"
                                            target="_blank"
                                            class="px-1 py-2 text-sm font-medium leading-5 text-purple-500 transition-colors duration-150 border border-transparent rounded-lg active:text-purple-600 hover:text-purple-700 focus:outline-none focus:shadow-outline-purple">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-6">
                                                <path fill-rule="evenodd"
                                                    d="M5.625 1.5H9a3.75 3.75 0 0 1 3.75 3.75v1.875c0 1.036.84 1.875 1.875 1.875H16.5a3.75 3.75 0 0 1 3.75 3.75v7.875c0 1.035-.84 1.875-1.875 1.875H5.625a1.875 1.875 0 0 1-1.875-1.875V3.375c0-1.036.84-1.875 1.875-1.875Zm5.845 17.03a.75.75 0 0 0 1.06 0l3-3a.75.75 0 1 0-1.06-1.06l-1.72 1.72V12a.75.75 0 0 0-1.5 0v4.19l-1.72-1.72a.75.75 0 0 0-1.06 1.06l3 3Z"
                                                    clip-rule="evenodd" />
                                                <path
                                                    d="M14.25 5.25a5.23 5.23 0 0 0-1.279-3.434 9.768 9.768 0 0 1 6.963 6.963A5.23 5.23 0 0 0 16.5 7.5h-1.875a.375.375 0 0 1-.375-.375V5.25Z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('penilaianruangans.edit', $nilairuangan->id) }}"
                                            class="px-1 py-2 text-sm font-medium leading-5 text-purple-500 transition-colors duration-150 border border-transparent rounded-lg active:text-purple-600 hover:text-purple-700 focus:outline-none focus:shadow-outline-purple">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-6">
                                                <path
                                                    d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('penilaianruangans.destroy', $nilairuangan->id) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-1 py-2 text-sm font-medium leading-5 text-purple-500 transition-colors duration-150 border border-transparent rounded-lg active:text-purple-600 hover:text-purple-700 focus:outline-none focus:shadow-outline-purple"
                                                onclick="return confirm('Are you sure you want to delete this item?')">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="size-6">
                                                    <path fill-rule="evenodd"
                                                        d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
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
            }, 10000);
        });
    </script>

</x-app-layout>
