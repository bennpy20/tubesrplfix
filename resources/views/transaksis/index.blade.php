<x-layout>
    <div class="p-5 m-2">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-7">
            <div>
                <h1 class="text-2xl font-bold text-black mb-2">Daftar Transaksi</h1>
                <p class="text-lg text-gray-600">Catat setiap transaksi yang terjadi disini</p>
            </div>
            <div class="flex items-center">
                <!-- Button tambah transaksi -->
                @if ($dompets->isNotEmpty())
                    <button data-modal-target="modal-create-transaksi" data-modal-toggle="modal-create-transaksi"
                        class="bg-blue-600 hover:bg-blue-700 transition text-white font-medium text-base px-4 py-2 rounded-lg shadow ">
                        Tambah Transaksi
                    </button>
                @else
                    <!-- Jika dompet belum ada, tampilkan pesan -->
                    <div class="text-red-600 font-medium mb-4">
                        Silakan buat dompet terlebih dahulu.
                    </div>
                @endif
                <div id="modal-create-transaksi" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Tambah transaksi baru
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-toggle="modal-create-transaksi">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            @include('transaksis/create') <!-- Include isi modal dari file create.blade.php -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="relative overflow-x-auto sm:rounded-lg">
            <div
                class="flex flex-column sm:flex-row flex-wrap space-y-4 sm:space-y-0 items-center justify-between p-0.5 pb-4 w-full">
                <div>
                    <form method="GET" action="{{ route('transaksis.index') }}">
                        <button id="dropdownRadioButton" data-dropdown-toggle="dropdownRadio"
                            class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600"
                            type="button">
                            <svg class="w-3 h-3 text-gray-500 dark:text-gray-400 me-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z" />
                            </svg>
                            @if ($filter_transaksi == '7_days')
                                7 Hari Terakhir
                            @elseif ($filter_transaksi == '1_month')
                                1 Bulan Terakhir
                            @elseif ($filter_transaksi == '3_months')
                                3 Bulan Terakhir
                            @elseif ($filter_transaksi == '1_year')
                                1 Tahun Terakhir
                            @else
                                Semua Transaksi
                            @endif
                            <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 4 4 4-4" />
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownRadio"
                            class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600"
                            data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="top">
                            <ul class="p-3 space-y-1 text-sm text-gray-700 dark:text-gray-200">
                                <li>
                                    <label
                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <input type="radio" name="filter" value="all"
                                            {{ $filter_transaksi == 'all' ? 'checked' : '' }}
                                            onchange="this.form.submit()"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <span class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Semua
                                            Transaksi</span>
                                    </label>
                                </li>
                                <li>
                                    <label
                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <input type="radio" name="filter" value="7_days"
                                            {{ $filter_transaksi == '7_days' ? 'checked' : '' }}
                                            onchange="this.form.submit()"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <span class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">7 Hari
                                            Terakhir</span>
                                    </label>
                                </li>
                                <li>
                                    <label
                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <input type="radio" name="filter" value="1_month"
                                            {{ $filter_transaksi == '1_month' ? 'checked' : '' }}
                                            onchange="this.form.submit()"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <span class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1 Bulan
                                            Terakhir</span>
                                    </label>
                                </li>
                                <li>
                                    <label
                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <input type="radio" name="filter" value="3_months"
                                            {{ $filter_transaksi == '3_months' ? 'checked' : '' }}
                                            onchange="this.form.submit()"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <span class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">3 Bulan
                                            Terakhir</span>
                                    </label>
                                </li>
                                <li>
                                    <label
                                        class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <input type="radio" name="filter" value="1_year"
                                            {{ $filter_transaksi == '1_year' ? 'checked' : '' }}
                                            onchange="this.form.submit()"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <span class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">1 Tahun
                                            Terakhir</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
                <label for="table-search" class="sr-only">Search</label>
                <div class="relative">
                    <form action="{{ route('transaksis.search') }}" method="GET" autocomplete="off">
                        <div class="absolute inset-y-0 left-0 rtl:inset-r-0 rtl:right-0 flex items-center ps-3">
                            <button type="submit" class="pointer-events-auto flex items-center focus:outline-none">
                                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd">
                                    </path>
                                </svg>
                            </button>
                        </div>
                        <input type="text" name="search" value="{{ old('search') }}"
                            class="block p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Cari nama transaksi..">
                    </form>
                </div>
            </div>

            <table class="w-full my-2 mb-6 text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-5 pr-7">
                            No
                        </th>
                        <th scope="col" class="px-6 py-5 pr-28">
                            Nama Transaksi
                        </th>
                        <th scope="col" class="px-6 py-5 pr-20">
                            Jumlah
                        </th>
                        <th scope="col" class="px-6 py-5 pr-16">
                            Jenis
                        </th>
                        <th scope="col" class="px-6 py-5 pr-48">
                            Keterangan
                        </th>
                        <th scope="col" class="px-6 py-5 pr-16">
                            Tanggal
                        </th>
                        <th scope="col" class="px-6 py-5 pr-24">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $nomor => $transaksi)
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td class="px-6 py-4 text-gray-900">
                                {{ $transaksis->firstItem() + $nomor }}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
                                {{ Str::limit($transaksi->label, 25) }}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
                                {{ 'Rp ' . number_format($transaksi->amount, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
                                {{ $transaksi->jenis }}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
                                {{ Str::limit($transaksi->note, 35) }}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
                                {{ $transaksi->formatted_date }}
                            </td>
                            <td class="px-6 py-4 text-gray-900">
                                {{-- Show data --}}
                                <button data-modal-target="modal-show-transaksi-{{ $transaksi->id }}"
                                    data-modal-toggle="modal-show-transaksi-{{ $transaksi->id }}" type="button"
                                    class="focus:outline-none bg-blue-400 hover:bg-blue-500 font-medium rounded-lg text-sm p-1 text-center inline-flex items-center me-2">
                                    <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z" />
                                        <path stroke="currentColor" stroke-width="2"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                                </button>
                                <div id="modal-show-transaksi-{{ $transaksi->id }}" tabindex="-1"
                                    aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Detail transaksi
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="modal-show-transaksi-{{ $transaksi->id }}">
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
                                            @include('transaksis.show')
                                            <!-- Include isi modal dari file show.blade.php -->
                                        </div>
                                    </div>
                                </div>
                                {{-- Edit data --}}
                                <button data-modal-target="modal-edit-transaksi-{{ $transaksi->id }}"
                                    data-modal-toggle="modal-edit-transaksi-{{ $transaksi->id }}" type="button"
                                    class="focus:outline-none bg-yellow-300 hover:bg-yellow-400 font-medium rounded-lg text-sm p-1 text-center inline-flex items-center me-2">
                                    <svg class="w-4 h-4 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28" />
                                    </svg>
                                </button>
                                <div id="modal-edit-transaksi-{{ $transaksi->id }}" tabindex="-1"
                                    aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Edit transaksi
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="modal-edit-transaksi-{{ $transaksi->id }}">
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
                                            @include('transaksis.edit', ['transaksi' => $transaksi])
                                            <!-- Include isi modal dari file edit.blade.php -->
                                        </div>
                                    </div>
                                </div>
                                {{-- Delete data --}}
                                <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST"
                                    id="delete-form-{{ $transaksi->id }}" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $transaksi->id }})"
                                        class="focus:outline-none bg-red-600 hover:bg-red-700 font-medium rounded-lg text-sm p-1 text-center inline-flex items-center me-2">
                                        <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <div class="flex items-center p-4 my-2 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                            role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Data tidak tersedia!</span>
                            </div>
                        </div>
                    @endforelse
                </tbody>
            </table>
            {{ $transaksis->links() }}
        </div>
    </div>
</x-layout>
