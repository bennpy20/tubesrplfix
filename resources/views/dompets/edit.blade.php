<form action="{{ route('dompets.update', $dompet->id) }}" method="POST" class="p-4 md:p-5" autocomplete="off">
    @csrf
    @method('PUT')
    <div class="grid gap-4 mb-4 grid-cols-2">
        <div class="col-span-2">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Dompet</label>
            <input type="text" name="label" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500
            form-control @error('label') is-invalid @enderror" value="{{ old('label', $dompet->label) }}" placeholder="Masukkan nama dompet" required />
            <!-- error message untuk label -->
            @error('label')
                <div class="alert alert-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="flex justify-end">
        <button type="submit" class="text-white bg-yellow-400 hover:bg-yellow-500 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-yellow-400 dark:hover:bg-yellow-500">Simpan</button>
    </div>
</form>