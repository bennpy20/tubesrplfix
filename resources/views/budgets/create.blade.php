<form action="{{ route('budgets.store') }}" method="POST" class="p-4 md:p-5" autocomplete="off">
    @csrf
    <div class="grid gap-4 mb-4 grid-cols-2">
        <div class="col-span-2">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Budget</label>
            <input type="text" name="label" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500
            form-control @error('label') is-invalid @enderror" value="{{ old('label') }}" placeholder="Masukkan nama budget" required />
            <!-- error message untuk label -->
            @error('label')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-span-2">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Anggaran</label>
            <input type="number" name="income" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500
            form-control @error('income') is-invalid @enderror" value="{{ old('income') }}" placeholder="Masukkan anggaran" oninput="this.value = Math.max(0, this.value)" step="any" required />
            <!-- error message untuk label -->
            @error('income')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="col-span-2 sm:col-span-1">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Bulan</label>
            <div class="relative max-w-sm form-control">
                <select id="bulan" name="bulan" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('bulan') is-invalid @enderror">
                    <option value="01" {{ old('bulan') === '01' ? 'selected' : '' }}>Januari</option>
                    <option value="02" {{ old('bulan') === '02' ? 'selected' : '' }}>Februari</option>
                    <option value="03" {{ old('bulan') === '03' ? 'selected' : '' }}>Maret</option>
                    <option value="04" {{ old('bulan') === '04' ? 'selected' : '' }}>April</option>
                    <option value="05" {{ old('bulan') === '05' ? 'selected' : '' }}>Mei</option>
                    <option value="06" {{ old('bulan') === '06' ? 'selected' : '' }}>Juni</option>
                    <option value="07" {{ old('bulan') === '07' ? 'selected' : '' }}>Juli</option>
                    <option value="08" {{ old('bulan') === '08' ? 'selected' : '' }}>Agustus</option>
                    <option value="09" {{ old('bulan') === '09' ? 'selected' : '' }}>September</option>
                    <option value="10" {{ old('bulan') === '10' ? 'selected' : '' }}>Oktober</option>
                    <option value="11" {{ old('bulan') === '11' ? 'selected' : '' }}>November</option>
                    <option value="12" {{ old('bulan') === '12' ? 'selected' : '' }}>Desember</option>
                </select>
                <!-- error message untuk bulan -->
                @error('bulan')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-span-2 sm:col-span-1">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Tahun</label>
            <div class="relative max-w-sm form-control">
                <select id="tahun" name="tahun" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 @error('tahun') is-invalid @enderror">
                    @for ($year = date('Y'); $year <= date('Y') + 5; $year++)
                        <option value="{{ $year }}" {{ old('tahun') === (string)$year ? 'selected' : '' }}>{{ $year }}</option>
                    @endfor
                </select>
                <!-- error message untuk tahun -->
                @error('tahun')
                    <div class="alert alert-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>
    <div class="flex justify-end">
        <button type="submit" class="text-white bg-green-600 hover:bg-green-700 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700">Tambah</button>
    </div>
</form>