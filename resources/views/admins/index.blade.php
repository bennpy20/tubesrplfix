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

<body class="bg-gray-50 dark:bg-gray-900">
    <section class="py-8 antialiased md:py-12">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="flex justify-between items-center mt-3 mb-6 border-b border-gray-300 pb-8">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-3xl">
                    Halo, {{ $admins->username }}
                </h2>
                <div class="flex gap-4">
                    <!-- Tombol Profil -->
                    <a href="{{ route('profiles.index') }}"
                        class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-lime-600 rounded-lg shadow hover:bg-lime-700 dark:bg-lime-500 dark:hover:bg-lime-600 transition">
                        <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 13 16h-2a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 12 21Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <span>Profil</span>
                    </a>
                    <!-- Tombol Logout -->
                    <form action="{{ route('actionlogout') }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-lg shadow hover:bg-red-700 dark:bg-red-500 dark:hover:bg-red-600 transition">
                            <svg class="w-5 h-5 text-white dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
            <!-- Heading & Filters -->
            <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
                <h2 class="mt-2 text-lg font-semibold text-gray-900 dark:text-white sm:text-2xl">Kelola Akun Member</h2>
                <div
                    class="flex flex-col sm:flex-row sm:space-x-4 space-y-3 sm:space-y-0 items-center justify-between mt-4">
                    <label for="table-search" class="sr-only">Search</label>
                    <div class="relative w-full sm:w-auto">
                        <form action="{{ route('admins.search') }}" method="GET" autocomplete="off">
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
                                placeholder="Cari username..">
                        </form>
                    </div>
                    <!-- Dropdown Sort -->
                    <button id="sortDropdownButton1" data-dropdown-toggle="dropdownSort1" type="button"
                        class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white sm:w-auto">
                        <svg class="-ms-0.5 me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 4v16M7 4l3 3M7 4 4 7m9-3h6l-6 6h6m-6.5 10 3.5-7 3.5 7M14 18h4" />
                        </svg>
                        Sort
                        <svg class="-me-0.5 ms-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m19 9-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="dropdownSort1"
                        class="z-50 hidden w-40 divide-y divide-gray-100 rounded-lg bg-white shadow dark:bg-gray-700"
                        data-popper-placement="bottom">
                        <ul class="text-left text-sm font-medium text-gray-500 dark:text-gray-400"
                            aria-labelledby="sortDropdownButton">
                            <!-- Pilihan Ascending (A-Z) -->
                            <li>
                                <a href="{{ route('admins.index', ['sort' => 'asc']) }}"
                                    class="group inline-flex w-full items-center px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                                    Ascending (A-Z)
                                </a>
                            </li>
                            <!-- Pilihan Descending (Z-A) -->
                            <li>
                                <a href="{{ route('admins.index', ['sort' => 'desc']) }}"
                                    class="group inline-flex w-full items-center px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-600 dark:hover:text-white">
                                    Descending (Z-A)
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Daftar akun member -->
            <div class="mb-4 grid gap-4 sm:grid-cols-2 md:mb-8 lg:grid-cols-3 xl:grid-cols-4">
                @foreach ($members as $member)
                    <div
                        class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div class="flex justify-end px-4 pt-4">
                            <button id="dropdownButton-member-{{ $member->id }}"
                                data-dropdown-toggle="dropdown-member-{{ $member->id }}"
                                class="inline-block text-gray-500 dark:text-gray-400 rounded-lg text-sm p-1.5"
                                type="button">
                                <span class="sr-only">Open dropdown</span>
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 16 3">
                                    <path
                                        d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdown-member-{{ $member->id }}"
                                class="z-10 hidden text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                                <ul class="py-2" aria-labelledby="dropdownButton-member-{{ $member->id }}">
                                    <li>
                                        <button type="button" onclick="confirmDeleteAkun({{ $member->id }})" class="block w-full px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                            Hapus Akun Member
                                        </button>
                                        <!-- Form untuk delete akun -->
                                        <form action="{{ route('admins.destroy', $member->id) }}" method="POST" id="delete-akun-{{ $member->id }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex flex-col items-center pb-10">
                            <img class="w-24 h-24 mb-3 rounded-full object-cover shadow-lg"
                                src="https://flowbite.com/docs/images/examples/image-2@2x.jpg" alt="user photo" />
                            <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{ $member->username }}
                            </h5>
                            <span class="text-sm text-gray-500 dark:text-gray-400">{{ $member->email }}</span>
                            <div class="flex mt-4 md:mt-6">
                                <button data-modal-target="modal-show-member-{{ $member->id }}"
                                    data-modal-toggle="modal-show-member-{{ $member->id }}"
                                    class="inline-flex items-center px-4 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Detail profil
                                </button>
                                <!-- Modal manage budget -->
                                <div id="modal-show-member-{{ $member->id }}" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-md max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                            <!-- Modal header -->
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                                    Detail Akun Member
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="modal-show-member-{{ $member->id }}">
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
                                            <div class="p-4 md:p-5">
                                                <p class="pb-2">Username: {{ $member->username }}</p>
                                                <p class="py-2">Email: {{ $member->email }}</p>
                                                <p class="py-2">Nomor telepon: {{ $member->no_telepon }}</p>
                                                <p class="py-2">Tanggal bergabung:
                                                    {{ $member->formatted_date_detail }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            {{ $members->links() }}
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
                text: "Menghapus akun member akan membuat data yang berkaitan dengan akun member ikut terhapus",
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
