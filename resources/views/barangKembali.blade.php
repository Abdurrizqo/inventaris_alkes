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
            <h1 class="text-center font-medium text-gray-800 md:text-2xl">DETAIL INFORMASI PEMINJAMAN DAN PENGEMBALIAN
                BARANG
            </h1>
        </div>
    </div>

    <div class="w-full md:w-1/2 mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white shadow-md rounded-lg p-6 flex flex-col md:flex-row md:items-start gap-5">
            <div class="w-full h-[20rem] md:w-1/3 md:h-[12rem] rounded overflow-hidden">
                <img src="{{ asset('storage/' . $barangKembali->foto_alat_kesehatan) }}" alt="Foto Alat Kesehatan">
            </div>


            <div class="flex flex-col gap-4 mt-4 flex-1">
                <div>
                    <p class="font-medium text-gray-800">Nama Barang</p>
                    <p class="text-sm text-gray-600">{{ $barangKembali->nama_alat_kesehatan }}</p>
                </div>

                <div>
                    <p class="font-medium text-gray-800">Nama Peminjam</p>
                    <p class="text-sm text-gray-600">{{ $barangKembali->nama_pegawai }}</p>
                </div>

                <div>
                    <p class="font-medium text-gray-800">Tangal Pinjam</p>
                    <p class="text-sm text-gray-600">{{ $barangKembali->tanggal_pinjam }}</p>
                </div>

                @if ($barangKembali->status === 'KEMBALI')
                    <p class="text-center text-green-400">Barang Telah Dikembalikan pada
                        <span class="font-medium">{{ $barangKembali->tanggal_kembali }}</span>
                    </p>
                @elseif($barangKembali->status === 'HILANG')
                    <p class="text-center text-red-400">Barang Telah Dinyatakan Hilang pada
                        <span class="font-medium">{{ $barangKembali->tanggal_kembali }}</span>
                    </p>
                @else
                    <div class="mt-8">
                        <span class="hidden items-center" id="loading-stat">
                            <div role="status">
                                <svg aria-hidden="true"
                                    class="w-4 h-4 me-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                            Loading Update....
                        </span>

                        <div class="flex items-center gap-4 mt-2">
                            <input type="hidden" id="form-id" value="{{ $idPinjam }}">
                            <button type="button" id="tombol-kembali"
                                class="focus:outline-none flex-1 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded text-sm py-1.5 px-3 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Kembalikan</button>
                            <button type="button" id="tombol-hilang"
                                class="focus:outline-none flex-1 text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded text-sm py-1.5 px-3 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Hilang</button>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    @vite('resources/js/barangStatusKontrol.js')
</body>

</html>
