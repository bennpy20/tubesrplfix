<x-layout>
    <div class="m-5">
        <div class="lg:flex lg:items-center lg:justify-between m-2">
            <div class="min-w-0 flex-1">
                <p class="text-lg font-bold text-gray-500 mb-2">Jumlah saldo</p>
                <!-- Total Dompet : sesuai dengan nama di hasil akhir SP -->
                <h2 class="text-2xl/7 font-bold text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight mb-5">
                    {{ 'Rp ' . number_format($total_dompet[0]->Total_Dompet, 0, ',', '.') }}
                </h2>
            </div>
            <!-- Tombol di pojok kanan -->
            <div data-modal-target="modal-create-dompet" data-modal-toggle="modal-create-dompet"
                class="flex justify-end items-center">
                <button
                    class="bg-blue-600 hover:bg-blue-700 text-white font-medium text-base px-4 py-2 rounded-lg shadow">
                    Tambah Dompet
                </button>
            </div>
            <div id="modal-create-dompet" tabindex="-1" aria-hidden="true"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <!-- Modal header -->
                        <div
                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                Tambah dompet
                            </h3>
                            <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="modal-create-dompet">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        @include('dompets/create') <!-- Include isi modal dari file create.blade.php -->
                    </div>
                </div>
            </div>
        </div>
        <div class="mb-6">
            <div class="border-b border-gray-300 m-2"></div>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @forelse($dompets as $dompet)
                <div class="m-2">
                    <div class="block w-[275px] p-6 border rounded-lg shadow-lg hover:shadow-xl transition-shadow hover:bg-gray-100 dark:border-gray-700 dark:hover:bg-gray-700"
                        style="background: linear-gradient(to right, {{ $dompet->bg_color }})">
                        <div class="flex items-center justify-between mb-2">
                            <h5 class="text-2xl font-bold tracking-tight text-white dark:text-white">
                                {{ $dompet->label }}</h5>
                            <!-- Tombol di sebelah label -->
                            <button type="button" id="dropdown-button-dompet-{{ $dompet->id }}"
                                data-dropdown-toggle="dropdown-dompet-{{ $dompet->id }}"
                                class="inline-block text-white dark:text-white text-sm p-1.5">
                                <span class="sr-only">Open dropdown</span>
                                <svg class="w-5 h-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 16 3">
                                    <path
                                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdown-dompet-{{ $dompet->id }}"
                                class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-32 dark:bg-gray-700">
                                <ul class="py-2" aria-labelledby="dropdown-button-dompet-{{ $dompet->id }}">
                                    <li>
                                        <a href="#" data-modal-target="modal-edit-dompet-{{ $dompet->id }}"
                                            data-modal-toggle="modal-edit-dompet-{{ $dompet->id }}"
                                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#"
                                            onclick="event.preventDefault(); confirmDelete({{ $dompet->id }});"
                                            class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                            Hapus
                                        </a>
                                        <!-- Formulir Delete yang tersembunyi -->
                                        <form action="{{ route('dompets.destroy', $dompet->id) }}" method="POST"
                                            id="delete-form-{{ $dompet->id }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            <!-- Modal utk edit -->
                            <div id="modal-edit-dompet-{{ $dompet->id }}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-md max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                Edit dompet
                                            </h3>
                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-toggle="modal-edit-dompet-{{ $dompet->id }}">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        @include('dompets/edit', ['dompet' => $dompet]) <!-- Include isi modal dari file edit.blade.php -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-xl font-normal text-white dark:text-white">
                            {{ 'Rp ' . number_format($dompet->current_amount, 0, ',', '.') }}</p>
                    </div>
                </div>
            @empty
                <div class="flex items-center p-4 m-2 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 col-span-full"
                    role="alert">
                    <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="w-screen max-w-6xl">
                        <span class="font-medium">Data dompet belum ada</span>
                        <!-- Change a few things up and try submitting again. -->
                    </div>
                </div>
            @endforelse
        </div>
        @if ($dompets->isNotEmpty())
            <footer class="bg-white dark:bg-gray-900 m-2">
                <div class="w-full max-w-screen-xl mx-auto md:py-8">
                    {{-- <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" /> --}}
                    <span class="block text-sm text-gray-500 dark:text-gray-400 mb-3">Keterangan dompet:</span>
                    <!-- Membungkus lingkaran dan teks dalam div dengan flexbox -->
                    <div class="flex items-center mb-2">
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                            <circle cx="10" cy="10" r="7" fill="#DC2626" />
                        </svg>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Saldo < Rp 0</span>
                    </div>
                    <div class="flex items-center mb-2">
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                            <circle cx="10" cy="10" r="7" fill="#00ACC1" />
                        </svg>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Rp 0 ≤ Saldo < Rp 500.000</span>
                    </div>
                    <div class="flex items-center mb-2">
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                            <circle cx="10" cy="10" r="7" fill="#009688" />
                        </svg>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Rp 500.000 ≤ Saldo < Rp 1.000.000</span>
                    </div>
                    <div class="flex items-center mb-2">
                        <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg" class="mr-2">
                            <circle cx="10" cy="10" r="7" fill="#D97706" />
                        </svg>
                        <span class="text-sm text-gray-500 dark:text-gray-400">Saldo ≥ Rp 1.000.000</span>
                    </div>
                </div>
            </footer>
        @endif
    </div>
</x-layout>