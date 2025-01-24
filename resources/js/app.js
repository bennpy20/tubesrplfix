import './bootstrap';

window.alert = function() {};

function formatRupiah(amount) {
    const formatter = new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0, // agar tidak ada desimal
    });
    
    return formatter.format(amount);
}

// Fungsi untuk menampilkan nilai dalam format rupiah
function formatRupiahValue(id, value) {
    const formattedValue = formatRupiah(value);
    document.getElementById(id).textContent = formattedValue;
}