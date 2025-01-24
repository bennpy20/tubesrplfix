<form action="{{ route('transaksis.store') }}" method="POST" class="p-4 md:p-5" autocomplete="off">
    @csrf
    <div class="grid gap-4 mb-4 grid-cols-2">
        <div class="col-span-2">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Transaksi</label>
            <input type="text" name="label" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500
            form-control @error('label') is-invalid @enderror" value="{{ old('label') }}" placeholder="Masukkan nama transaksi" required />
            <!-- error message untuk label -->
            @error('label')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-span-2 sm:col-span-1">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Harga</label>
            <input type="number" name="amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500
            form-control @error('amount') is-invalid @enderror" value="{{ old('amount') }}" placeholder="Masukkan harga" oninput="this.value = Math.max(0, this.value)" step="any" required />
            <!-- error message untuk amount -->
            @error('amount')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-span-2 sm:col-span-1">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Transaksi</label>
            <select name="jenis" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500
            form-control @error('jenis') is-invalid @enderror" value="{{ old('jenis') }}">
                {{-- <option selected="">Select category</option> --}}
                <option value="Pemasukan">Pemasukan</option>
                <option value="Pengeluaran">Pengeluaran</option>
            </select>
            <!-- error message untuk jenis -->
            @error('jenis')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-span-2">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tanggal</label>
            <div class="relative max-w-sm form-control">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                    </svg>
                </div>
                <input name="date" datepicker datepicker-format="yyyy-mm-dd" datepicker-autohide type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
                @error('date') is-invalid @enderror" value="{{ old('date') }}" placeholder="Pilih tanggal"  required />
            </div>
            <!-- error message untuk tanggal -->
            @error('date')
            <div class="alert alert-danger mt-2">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-span-2">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
            <textarea name="note" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500
            form-control @error('note') is-invalid @enderror" placeholder="Tulis keterangan...">{{ old('note') }}</textarea>                    
        </div>
        <!-- error message untuk note -->
        @error('note')
        <div class="alert alert-danger mt-2">
            {{ $message }}
        </div>
        @enderror
        <div class="col-span-2">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dompet</label>
            <select name="id_dompet" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500
            form-control @error('id_dompet') is-invalid @enderror" value="{{ old('id_dompet') }}">
                @foreach ($dompets as $dompet)
                    <option value="{{ $dompet->id }}">{{ $dompet->label }}</option>
                @endforeach
            </select>
            @error('id_dompet')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="flex justify-end">
        <button type="submit" class="text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700">Tambah</button>
    </div>
</form>