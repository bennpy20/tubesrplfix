<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    {{-- CSS yg punya kita: style.css --}}
    @vite('resources/css/style.css')
    {{-- JS yg punya kita: grafik.js --}}
    @vite('resources/js/grafik.js')
    @vite('resources/js/editprofil.js')
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
    <title>MoneyBeacon</title>
</head>

<body>
    <section class="bg-white dark:bg-gray-900">
        <div class="max-w-xl px-4 py-8 mx-auto lg:py-14">
            <h2 class="mb-6 text-2xl text-center font-bold text-gray-900 dark:text-white">Profil Pengguna</h2>
            <form action="{{ route('profiles.update', $users->id) }}" method="POST" id="update-form">
                @csrf
                @method('PUT')
                <div class="grid gap-4 mb-8 sm:grid-cols-2 sm:gap-6 sm:mb-10">
                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <input type="text" name="username" value="{{ $users->username }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            readonly>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" value="{{ $users->email }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            readonly>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomor
                            telepon</label>
                        <input type="phone" name="no_telepon" value="{{ $users->no_telepon }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            readonly>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                        <input type="text" name="role"
                            value="{{ $users->role == 'Admin' ? 'Admin' : ($users->role == 'Member' ? 'Member' : '') }}"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            readonly>
                    </div>
                </div>
                <!-- Submit Button for update -->
                <div class="flex flex-col space-y-4" id="saveSection">
                    <button type="submit"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                        Simpan
                    </button>
                </div>
            </form>
            <!-- Tombol Edit Akun -->
            <button type="button" id="editButton"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700">
                Edit akun
            </button>
            <!-- Form Delete Akun -->
            <form action="{{ route('profiles.destroy', $users->id) }}" method="POST"
                id="delete-akun-{{ $users->id }}" style="display: block;" class="pt-5">
                @csrf
                @method('DELETE')
                <button type="button" id="deleteButton" onclick="confirmDeleteAkun({{ $users->id }})"
                    class="w-full text-red-600 flex justify-center items-center hover:text-white border border-red-600 hover:bg-red-600 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Hapus akun
                </button>
            </form>
            <!-- Form kembali ke dashboard (home) -->
            <form action="{{ Auth::user()->role == 'Admin' ? route('admins.index') : route('home') }}" method="GET"
                id="backToDashboardForm" class="pt-5">
                <button type="submit" id="backToDashboardButton"
                    class="w-full text-gray-900 border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:text-white dark:border-gray-600 dark:hover:bg-gray-700">
                    Kembali ke Dashboard
                </button>
            </form>
        </div>
    </section>

    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        CKEDITOR.replace('description');
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        //message with sweetalert
        @if (session('success'))
            Swal.fire({
                icon: "success",
                title: "BERHASIL",
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @elseif (session('error'))
            Swal.fire({
                icon: "error",
                title: "GAGAL!",
                text: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif
    </script>
    <script>
        function confirmDeleteAkun(id) {
            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Menghapus akun akan membuat data yang berkaitan dengan akun ikut terhapus",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#c0c0c0",
                confirmButtonText: "Hapus Akun"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-akun-${id}`).submit(); // Submit the form if confirmed
                }
            });
        }
    </script>
</body>

</html>
