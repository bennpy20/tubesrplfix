<x-layout>
    <div class="p-5 m-2">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-black mb-2">Kelola Budget</h1>
                <p class="text-lg text-gray-600">Buat pembatasan budgetmu sekarang!</p>
            </div>
            <div class="flex items-center space-x-4">
                <!-- Button Kelola Budget -->
                @if ($budgets->isNotEmpty())
                <button data-modal-target="modal-manage-budget" data-modal-toggle="modal-manage-budget" class="bg-indigo-600 hover:bg-indigo-700 transition text-white font-medium text-base px-4 py-2 rounded-lg shadow">
                Kelola Budget
                </button>
                @endif
                <!-- Modal manage budget -->
                <div id="modal-manage-budget" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Kelola Budget
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="modal-manage-budget">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5">
                                <p class="text-sm text-gray-500 dark:text-gray-300">
                                    Pilih budget yang ingin dihapus:
                                </p>
                                <ul class="mt-4 space-y-2">
                                    @foreach ($budgets as $budget)
                                        <li class="flex items-center justify-between text-gray-900 dark:text-white pb-1">
                                            <span>{{ $budget->label }}</span>
                                            <button type="button" class="text-red-600 hover:text-red-800 focus:outline-none" onclick="confirmDelete({{ $budget->id }})">
                                                Hapus budget
                                            </button>
                                            <form id="delete-form-{{ $budget->id }}" action="{{ route('budgets.destroy', $budget->id) }}" method="POST" style="display: none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Button buat limit budget -->
                @if ($dompets->isNotEmpty())
                    <button data-modal-target="modal-create-budget" data-modal-toggle="modal-create-budget" class="bg-blue-600 hover:bg-blue-700 transition text-white font-medium text-base px-4 py-2 rounded-lg shadow ">
                        Buat Limit Budget
                    </button>
                @else
                    <!-- Jika dompet belum ada, tampilkan pesan -->
                    <div class="text-red-600 font-medium mb-4">
                        Silakan buat dompet terlebih dahulu.
                    </div>
                @endif
                <!-- Modal create budget -->
                <div id="modal-create-budget" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Tambah budget
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="modal-create-budget">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            @include('budgets/create') <!-- Include isi modal dari file create.blade.php -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <ol class="sm:grid sm:grid-cols-3 sm:gap-6">
            @forelse ($budgets as $budget)
            <li class="relative mb-6 sm:mb-0 w-96 {{ $budget->status === 'Mendatang' ? 'opacity-50' : 'opacity-100' }}">
                <div class="flex items-center">
                    <div class="z-10 flex items-center justify-center w-6 h-6 bg-blue-200 rounded-full ring-0 ring-white dark:bg-blue-900 sm:ring-8 dark:ring-blue-900 shrink-0">
                        <svg class="w-2.5 h-2.5 text-blue-700 dark:text-blue-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <div class="hidden sm:flex w-full bg-gray-200 h-0.5 dark:bg-gray-700"></div>
                </div>
                <div class="mt-2 sm:pe-2 sm:ps-1">
                    <div class="relative pb-2 flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $budget->label }}</h3>
                        <div class="flex items-center space-x-2">
                            <span class="text-white text-xs font-medium px-2 py-1 rounded" style="background-color: {{ $budget->statusColor }}">{{ $budget->status }}</span>
                        </div>
                    </div>
                    <time class="block mb-4 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">Periode: {{ $budget->PeriodeBaru }}</time>
                    <p class="text-base font-normal text-gray-600 dark:text-gray-400 pb-1">Budget: {{ "Rp " . number_format($budget->income, 0, ",", ".") }}</p>
                    <p class="text-base font-normal text-gray-600 dark:text-gray-400 pb-4">Terpakai: {{ "Rp " . number_format($budget->expense, 0, ",", ".") }}</p>
                    <p class="text-base font-normal pb-1" style="color: {{ $budget->color }};">Sisa: {{ "Rp " . number_format($budget->sisa, 0, ",", ".") }}</p>
                    <div class="flex items-center space-x-4">
                        <div class="w-11/12 bg-gray-200 rounded-full dark:bg-gray-700">
                            <div class="text-xs font-medium p-2 leading-none rounded-full" style="width: {{ $budget->persen }}%; background-color: {{ $budget->color }};"></div>
                        </div>
                        <span class="text-sm font-medium flex items-center" style="color: {{ $budget->color }};">{{ $budget->persen }}%</span>
                    </div>
                </div>
            </li>
            @empty
            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400 col-span-full" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div class="w-screen max-w-6xl">
                    <span class="font-medium m-2">Data budget belum ada</span>
                    <!-- Change a few things up and try submitting again. -->
                </div>
            </div>
            @endforelse
        </ol>
    </div>
</x-layout>