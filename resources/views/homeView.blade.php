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
            <h1 class="text-center font-medium text-gray-800 md:text-xl">DATA INVENTARIS ALAT KESEHATAN RUMAH SAKIT UMUM
                DAERAH KUDUNGGA
            </h1>
        </div>


        <form class="px-4 my-4 mb-16">
            <input type="text" name="search"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Cari nama alkes, kode inventaris" />

            <div class="w-full flex items-center justify-center mt-4 gap-4">
                <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-md text-sm px-6 py-1.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cari</button>

                <a href="scan-qr-alkes"
                    class="focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-md text-sm px-6 py-1.5 dark:focus:ring-yellow-900">Scan
                    QR</a>
            </div>
        </form>


        @if (count($alkes) > 0)
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-10">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-center">
                                NO
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                NAMA ALAT
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                GAMBAR
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                RUANGAN
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                KODE INVENTARIS
                            </th>
                            <th scope="col" class="px-6 py-3 text-center">
                                KELOLA
                            </th>
                        </tr>
                    </thead>
                    <tbody class="text-lg">
                        @foreach ($alkes as $index => $item)
                            <tr
                                class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ ++$index }}
                                </th>
                                <td class="px-6 py-4 text-nowrap">
                                    {{ $item->nama_alat_kesehatan }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="w-28">
                                        <img src="{{ asset('storage/' . $item->foto_alat_kesehatan) }}" class="w-full">
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-nowrap">
                                    {{ $item->nama_ruangan }}
                                </td>
                                <td class="px-6 py-4 text-nowrap">
                                    {{ $item->kode_inventaris }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="data-alkes/{{ $item->id }}"
                                        class="focus:outline-none px-6 py-1.5 text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</body>

</html>
