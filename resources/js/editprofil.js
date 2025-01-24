const editButton = document.getElementById('editButton');
const saveSection = document.getElementById('saveSection');
const inputs = document.querySelectorAll('input');
const roleInput = document.querySelector('input[name="role"][readonly]');
const deleteButton = document.querySelector('#deleteButton');
const deleteForm = document.querySelector('#deleteForm');
const backToDashboardButton = document.getElementById('backToDashboardButton');

// Sembunyikan tombol save yg utk ketika kita klik Edit Data
saveSection.style.display = 'none';
backToDashboardButton.style.display = 'block';  // Tombol" kembali ke dashboard" ditampilkan pertama kali

// Toggle antara tombol Edit dan Save mode
editButton.addEventListener('click', () => {
    const isEditing = editButton.textContent.trim() === 'Edit akun';

    // Jika dia klik tombol Edit, maka readonly akan terhapus sehingga data bisa diedit
    if (isEditing) {
        inputs.forEach(input => {
            if (input !== roleInput) {
                input.removeAttribute('readonly');
            }
        });
        editButton.textContent = 'Simpan';  // Ubah tombol Edit data menjadi Simpan
        saveSection.style.display = 'block';  // Show tombol simpan
        deleteButton.style.display = 'none';  // Sembunyikan tombol delete
        editButton.style.display = 'none';   // Sembunyikan tombol edit
        backToDashboardButton.style.display = 'none'; // Sembunyikan tombol kembali ke dashboard
    // Dalam status edit, dan kalau sudah dia akan menyimpan data yg kita edit dengan kita mengklik tombol Simpan
    } else {
        
        inputs.forEach(input => input.setAttribute('readonly', true));
        editButton.textContent = 'Edit akun';  // Ubah button simpan kembali menjadi Edit akun
        saveSection.style.display = 'none';  // Sembunyikan tombol simpan
        deleteButton.style.display = 'block';  // Show tombol delete
        editButton.style.display = 'block';   // Show tombol Edit akun
        backToDashboardButton.style.display = 'block'; // Show tombol kembali ke dashboard
    }
});