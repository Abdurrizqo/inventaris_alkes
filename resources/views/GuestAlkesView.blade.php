<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>ALKES RSUD KUDUNGGA</title>
</head>

<body class="bg-[#F5F5F5]">

    <div class="w-screen md:w-1/2 mx-auto">
        <div class="flex justify-center items-center mt-4 px-6 py-3">
            <h1 class="text-center font-medium text-gray-800 md:text-2xl">DETAIL INFORMASI ALAT KESEHATAN
            </h1>
        </div>
    </div>

    <div class="p-6">
        <nav class="px-5 py-3 text-gray-700 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700 inline-flex"
            aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="/"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Home
                    </a>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180  w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">Detail
                            Barang</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <div class="w-full md:w-1/2 mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-md rounded-lg p-6 flex flex-col gap-5">
            <div class="w-full h-[20rem] rounded overflow-hidden">
                <img src="{{ asset('storage/' . $alatKesehatan->foto_alat_kesehatan) }}" alt="Foto Alat Kesehatan">
            </div>

            <div class="flex-1">
                <h1 class="text-center text-gray-800 font-semibold text-xl">
                    {{ $alatKesehatan->nama_alat_kesehatan }}
                </h1>

                <div class="my-3 text-gray-700">
                    <p class="font-medium text-lg">Kode Inventaris :</p>
                    <p class="text-gray-600">{{ $alatKesehatan->kode_inventaris }}</p>
                </div>

                <div class="my-3 text-gray-700">
                    <p class="font-medium text-lg">Merk Barang :</p>
                    <p class="text-gray-600">{{ $alatKesehatan->merk }}</p>
                </div>

                <div class="my-3 text-gray-700">
                    <p class="font-medium text-lg">Type Barang :</p>
                    <p class="text-gray-600">{{ $alatKesehatan->type }}</p>
                </div>

                <div class="my-3 text-gray-700">
                    <p class="font-medium text-lg">Nomor Seri :</p>
                    <p class="text-gray-600">{{ $alatKesehatan->nomer_seri }}</p>
                </div>

                <div class="my-3 text-gray-700">
                    <p class="font-medium text-lg">Ruangan :</p>
                    <p class="text-gray-600">{{ $alatKesehatan->nama_ruangan }}</p>
                </div>

                <div class="my-3 text-gray-700">
                    <p class="font-medium text-lg">AKD :</p>
                    <p class="text-gray-600">{{ $alatKesehatan->akd }}</p>
                </div>

                <div class="my-3 text-gray-700">
                    <p class="font-medium text-lg">AKL :</p>
                    <p class="text-gray-600">{{ $alatKesehatan->akl }}</p>
                </div>

                <div class="my-3 text-gray-700">
                    <p class="font-medium text-lg">Klasifikasi :</p>
                    <p class="text-gray-600">{{ $alatKesehatan->klasifikasi }}</p>
                </div>

                <div class="my-3 text-gray-700">
                    <p class="font-medium text-lg">Teknologi :</p>
                    <p class="text-gray-600">{{ $alatKesehatan->teknologi }}</p>
                </div>

                <div class="my-3 text-gray-700">
                    <p class="font-medium text-lg">Risiko :</p>
                    <p class="text-gray-600">{{ $alatKesehatan->risiko }}</p>
                </div>

                <div class="my-3 text-gray-700">
                    <p class="font-medium text-lg">Tanggal Pengadaan :</p>
                    <p class="text-gray-600">
                        {{ \Carbon\Carbon::parse($alatKesehatan->tanggal_pengadaan)->format('d M Y') }}</p>
                </div>

                <div class="my-3 text-gray-700">
                    <p class="font-medium text-lg">Sumber Pendanaan :</p>
                    <p class="text-gray-600">{{ $alatKesehatan->sumber_pendanaan }}</p>
                </div>

                <div class="my-3 text-gray-700">
                    <p class="font-medium text-lg">Penyedia :</p>
                    <p class="text-gray-600">{{ $alatKesehatan->nama_penyedia }}</p>
                </div>

                <div class="my-3 text-gray-700">
                    <p class="font-medium text-lg">Masa Garansi :</p>
                    <p class="text-gray-600">{{ $alatKesehatan->masa_garansi }}</p>
                </div>
            </div>

            @if ($statusPinjam)
                @if ($statusPinjam->status == 'PINJAM')
                    <p class="text-center text-red-400">
                        Barang Telah Dipinjam Oleh {{ $statusPinjam->nama_pegawai }} sejak
                        {{ $statusPinjam->tanggal_pinjam }}
                    </p>
                @elseif ($statusPinjam->status == 'HILANG')
                    <p class="text-center text-red-400">
                        Barang Telah Telah Dinyatakan HILANG sejak
                        {{ $statusPinjam->tanggal_kembali }}
                    </p>
                @endif
            @else
                <div class="flex justify-end">
                    <button data-modal-target="pinjam-modal" data-modal-toggle="pinjam-modal"
                        class="w-full md:w-40 focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-md text-sm px-6 py-2 dark:focus:ring-yellow-900">Pinjam
                        Barang</button>
                </div>

                <div id="pinjam-modal" tabindex="-1" aria-hidden="true"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div
                                class="flex items-center justify-between px-4 md:px-5 py-3 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Pinjam Barang
                                </h3>
                                <button type="button"
                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                    data-modal-toggle="pinjam-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <form class="px-4 md:px-5 py-3" id="form_pinjam">
                                @csrf
                                <input type="hidden" name="barang" id="id_barang"
                                    value="{{ $alatKesehatan->id }}">
                                <div class="mb-6">
                                    <label for="username_pegawai"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                                    <input type="text" name="username" id="username_pegawai"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="username" required>
                                </div>

                                <div class="mb-6">
                                    <label for="password_pegawai"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                                    <input type="password" name="password" id="password_pegawai"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="password" required>
                                </div>

                                <div class="mb-12">
                                    <label for="tel_pegawai"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nomer
                                        WA</label>
                                    <input type="tel" name="no_wa" id="tel_pegawai"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                        placeholder="Nomer WA" required>
                                </div>

                                <div class="flex justify-end">
                                    <button type="submit" id="button_pinjam"
                                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        Pinjam Barang
                                    </button>

                                    <button disabled type="button" id="button_loading"
                                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 hidden items-center">
                                        <svg aria-hidden="true" role="status"
                                            class="inline w-4 h-4 me-3 text-white animate-spin" viewBox="0 0 100 101"
                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                                fill="#E5E7EB" />
                                            <path
                                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                                fill="currentColor" />
                                        </svg>
                                        Loading...
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    @vite('resources/js/pinjamBarang.js')
</body>

</html>
