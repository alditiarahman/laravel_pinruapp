<x-app-layout>
    <x-slot name="header">
        {{ __('User') }}
    </x-slot>

    <div class="p-4 bg-white rounded-lg shadow-xs">

        <div class="inline-flex overflow-hidden mb-4 w-full bg-white rounded-lg shadow-md">
            <div class="flex justify-center items-center text-white w-12 bg-purple-500">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                </svg>
            </div>

            <div class="px-4 py-2 -mx-3">
                <div class="mx-3 mb-2">
                    <h1 class="font-bold text-red-500">Info</h1>
                </div>
                <div class="flex flex-col space-y-2">
                    <div class="mx-3 flex items-center space-x-2">
                        <button
                            class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-500 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </button>
                        <span><i style="color: red">*</i><em>Mengubah Menjadi Admin</em></span>
                    </div>

                    <div class="mx-3 flex items-center space-x-2">
                        <button
                            class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-gray-500 border border-transparent rounded-lg active:bg-gray-600 hover:bg-gray-700 focus:outline-none focus:shadow-outline-gray">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </button>
                        <span><i style="color: red">*</i><em>Mengubah Menjadi Operator</em></span>
                    </div>

                    <div class="mx-3 flex items-center space-x-2">
                        <button
                            class="px-3 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </button>
                        <span><i style="color: red">*</i><em>Mengubah Menjadi Peminjam</em></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="overflow-hidden mb-8 w-full rounded-lg border shadow-xs">
            <div class="overflow-x-auto w-full">
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 text-center uppercase bg-gray-50 border-b">
                            <th class="px-4 py-3">Name</th>
                            <th class="px-4 py-3">Email</th>
                            <th class="px-4 py-3">Roles</th>
                            <th class="px-4 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y text-center">
                        @foreach ($users as $user)
                            <tr class="text-gray-700">
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->name }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->email }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $user->roles->pluck('name')->join(', ') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex justify-center space-x-2 items-center">
                                        <!-- Modal Admin VERIFY -->
                                        <div x-data="{ openVerify: false }">
                                            <!-- VERIFY Trigger -->
                                            <button @click="openVerify = true"
                                                class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-500 border border-transparent rounded-lg active:bg-pruple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
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
                                                            Confirm Role Change
                                                        </p>
                                                        <!-- Modal description -->
                                                        <p class="text-sm text-gray-700">
                                                            Are you sure you want to change roles <span
                                                                class="font-semibold">{{ $user->name }}</span>?
                                                        </p>
                                                    </div>
                                                    <footer
                                                        class="flex flex-col items-center justify-end space-y-4 sm:space-y-0 sm:space-x-2 sm:flex-row">
                                                        <button @click="openVerify = false"
                                                            class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                                                            Cancel
                                                        </button>
                                                        <form action="{{ route('users.makeAdmin', $user->id) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                                                Change
                                                            </button>
                                                        </form>
                                                    </footer>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Operator VERIFY -->
                                        <div x-data="{ openVerify: false }">
                                            <!-- VERIFY Trigger -->
                                            <button @click="openVerify = true"
                                                class="px-3 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-gray-500 border border-transparent rounded-lg active:bg-gray-600 hover:bg-gray-700 focus:outline-none focus:shadow-outline-gray">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
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
                                                            Confirm Role Change
                                                        </p>
                                                        <!-- Modal description -->
                                                        <p class="text-sm text-gray-700">
                                                            Are you sure you want to change roles <span
                                                                class="font-semibold">{{ $user->name }}</span>?
                                                        </p>
                                                    </div>
                                                    <footer
                                                        class="flex flex-col items-center justify-end space-y-4 sm:space-y-0 sm:space-x-2 sm:flex-row">
                                                        <button @click="openVerify = false"
                                                            class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                                                            Cancel
                                                        </button>
                                                        <form action="{{ route('users.makeOperator', $user->id) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                                                Change
                                                            </button>
                                                        </form>
                                                    </footer>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Peminjam VERIFY -->
                                        <div x-data="{ openVerify: false }">
                                            <!-- VERIFY Trigger -->
                                            <button @click="openVerify = true"
                                                class="px-3 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 bg-white border border-gray-300 rounded-lg active:bg-gray-100 hover:bg-gray-200 focus:outline-none focus:shadow-outline-gray">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
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
                                                            Confirm Role Change
                                                        </p>
                                                        <!-- Modal description -->
                                                        <p class="text-sm text-gray-700">
                                                            Are you sure you want to change roles <span
                                                                class="font-semibold">{{ $user->name }}</span>?
                                                        </p>
                                                    </div>
                                                    <footer
                                                        class="flex flex-col items-center justify-end space-y-4 sm:space-y-0 sm:space-x-2 sm:flex-row">
                                                        <button @click="openVerify = false"
                                                            class="w-full px-5 py-3 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                                                            Cancel
                                                        </button>
                                                        <form action="{{ route('users.makePeminjam', $user->id) }}"
                                                            method="POST" class="inline">
                                                            @csrf
                                                            @method('PATCH')
                                                            <button type="submit"
                                                                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                                                Change
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
                {{ $users->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
