<x-layout>
    <div class="p-5 m-2">
        <div class="lg:flex lg:items-center lg:justify-between mb-6">
            <div class="min-w-0 flex-1">
                <h2 class="text-2xl/7 font-bold text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight pb-1">Halo, {{ Auth::user()->username }}</h2>
                <div class="mt-1 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap sm:space-x-6">
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                        <svg class="mr-1.5 size-5 shrink-0 text-gray-400" viewBox="0 0 20 20" fill="#F59E0B" aria-hidden="true" data-slot="icon">
                            <path d="M10.75 10.818v2.614A3.13 3.13 0 0 0 11.888 13c.482-.315.612-.648.612-.875 0-.227-.13-.56-.612-.875a3.13 3.13 0 0 0-1.138-.432ZM8.33 8.62c.053.055.115.11.184.164.208.16.46.284.736.363V6.603a2.45 2.45 0 0 0-.35.13c-.14.065-.27.143-.386.233-.377.292-.514.627-.514.909 0 .184.058.39.202.592.037.051.08.102.128.152Z" />
                            <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-8-6a.75.75 0 0 1 .75.75v.316a3.78 3.78 0 0 1 1.653.713c.426.33.744.74.925 1.2a.75.75 0 0 1-1.395.55 1.35 1.35 0 0 0-.447-.563 2.187 2.187 0 0 0-.736-.363V9.3c.698.093 1.383.32 1.959.696.787.514 1.29 1.27 1.29 2.13 0 .86-.504 1.616-1.29 2.13-.576.377-1.261.603-1.96.696v.299a.75.75 0 1 1-1.5 0v-.3c-.697-.092-1.382-.318-1.958-.695-.482-.315-.857-.717-1.078-1.188a.75.75 0 1 1 1.359-.636c.08.173.245.376.54.569.313.205.706.353 1.138.432v-2.748a3.782 3.782 0 0 1-1.653-.713C6.9 9.433 6.5 8.681 6.5 7.875c0-.805.4-1.558 1.097-2.096a3.78 3.78 0 0 1 1.653-.713V4.75A.75.75 0 0 1 10 4Z" clip-rule="evenodd" />
                        </svg>
                        Saldo Total: {{ "Rp " . number_format($jml_saldo, 0, ",", ".") }}
                        <span id="formatted-jml-saldo"></span>
                    </div>
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                        <svg class="w-6 h-6 mr-1.5 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="#047857" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4.5V19a1 1 0 0 0 1 1h15M7 14l4-4 4 4 5-5m0 0h-3.207M20 9v3.207"/>
                        </svg>
                        Pemasukan: {{ "Rp " . number_format($jml_pemasukan, 0, ",", ".") }}
                    </div>
                    <div class="mt-2 flex items-center text-sm text-gray-500">
                        <svg class="w-6 h-6 mr-1.5 text-gray-400 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="#B91C1C" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4.5V19a1 1 0 0 0 1 1h15M7 10l4 4 4-4 5 5m0 0h-3.207M20 15v-3.207"/>
                        </svg>
                        Pengeluaran: {{ "Rp " . number_format($jml_pengeluaran, 0, ",", ".") }}
                    </div>
                </div>
            </div>
            @if ($budgets->isNotEmpty())
            <div class="mt-5 flex lg:ml-4 lg:mt-0">
                <a href="/budgets/index" class="block max-w-[18rem] p-2 bg-blue-50 border border-blue-100 rounded-lg shadow hover:bg-blue-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700 transition">
                    <div class="flex items-center justify-between px-2">
                        <div class="pr-4">
                            <div class="flex items-center justify-center w-6 h-6 bg-blue-200 text-blue-800 rounded-full">
                                <svg class="w-4 h-4 text-gray-700 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M18.458 3.11A1 1 0 0 1 19 4v16a1 1 0 0 1-1.581.814L12 16.944V7.056l5.419-3.87a1 1 0 0 1 1.039-.076ZM22 12c0 1.48-.804 2.773-2 3.465v-6.93c1.196.692 2 1.984 2 3.465ZM10 8H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6V8Zm0 9H5v3a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-3Z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                        @if ($hitung_budget === 0)
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-400">
                            Kamu belum memiliki limit budget untuk bulan ini...
                        </p>
                        @else
                        <p class="text-sm font-medium text-gray-700 dark:text-gray-400">
                            Kamu memiliki {{ $hitung_budget }} limit budget bulan ini. Ayo cek sekarang...
                        </p>
                        @endif
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/>
                        </svg>
                    </div>
                </a>
            </div>
            @endif
        </div>
        <!-- Content grafik + tabel -->
        <div class="flex space-x-4 gap-x-2">
            <!-- Container utk grafik -->
            <div class="max-w-base min-w-[27em] w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between">
                    <div class="flex justify-center items-center">
                        <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Laporan Saldo</h5>
                        <svg data-popover-target="chart-info" data-popover-placement="bottom" class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z"/>
                        </svg>
                        <div data-popover id="chart-info" role="tooltip" class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                            <div class="p-3 space-y-2">
                                <p>Berikut ini adalah diagram perbandingan antara seluruh pemasukan dan pengeluaran</p>
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                                </svg></a>
                            </div>
                            <div data-popper-arrow></div>
                            </div>
                        </div>
                    </div>
                <!-- Donut Chart -->
                <div class="py-6" id="donut-chart"></div>
            </div>
            <div class="w-full max-w-full p-4 bg-white rounded-lg shadow sm:p-6 dark:bg-gray-800 dark:border-gray-700">
                <div class="flex items-center justify-between mb-8">
                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Transaksi Terbaru</h5>
                    <a href="/transaksis/index" class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">
                        View all
                    </a>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="min-w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-4">
                                    No
                                </th>
                                <th scope="col" class="px-5 py-4 pr-32">
                                    Nama
                                </th>
                                <th scope="col" class="px-5 py-4 pr-20">
                                    Jumlah
                                </th>
                                <th scope="col" class="px-5 py-4 pr-20">
                                    Jenis
                                </th>
                                <th scope="col" class="px-5 py-4 pr-20">
                                    Tanggal
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transaksis as $nomor => $transaksi)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row" class="px-5 py-4 text-center font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $transaksis->firstItem() + $nomor }}
                                </th>
                                <td class="px-5 py-4 text-gray-700">
                                    {{ Str::limit($transaksi->label, 20) }}
                                </td>
                                <td class="px-5 py-4 text-gray-700">
                                    {{ "Rp " . number_format($transaksi->amount, 0, ",", ".") }}
                                </td>
                                <td class="px-5 py-4 text-gray-700">
                                    {{ $transaksi->jenis }}
                                </td>
                                <td class="px-5 py-4 text-gray-700">
                                    {{ $transaksi->formatted_date }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        const pemasukan = parseInt(@json($jml_pemasukan)) || 0;
        const pengeluaran = parseInt(@json($jml_pengeluaran)) || 0;
    </script>
</x-layout>