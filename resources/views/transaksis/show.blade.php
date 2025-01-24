<!-- Modal body -->
<div class="p-4 md:p-5 space-y-4">
    <p class="text-base leading-relaxed py-1">
        Nama transaksi: {{ $transaksi->label }}
    </p>
    <p class="text-base leading-relaxed py-1">
        Jumlah: {{ "Rp " . number_format($transaksi->amount, 0, ",", ".") }}
    </p>
    <p class="text-base leading-relaxed py-1">
        Jenis: {{ $transaksi->jenis }}
    </p>
    <p class="text-base leading-relaxed py-1">
        Keterangan:</br>
        {{ $transaksi->note }}
    </p>
    <p class="text-base leading-relaxed py-1">
        Tanggal: {{ $transaksi->formatted_date_detail }}
    </p>
</div>