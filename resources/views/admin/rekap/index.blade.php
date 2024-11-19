@extends('layouts.template_fix')

@section('top_content')
    <li>
        <div class="flex items-center">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
            <a href=""
                class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                Rekap Absensi
            </a>
        </div>
    </li>
@endsection

@section('modal')
    @foreach ($siswaAbsens as $siswaAbsen)
        <!-- Modal -->
        <div id="modal-{{ $siswaAbsen->id }}" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-modal md:h-full">
            <div class="relative w-full h-full max-w-2xl md:h-auto">
                <!-- Modal content -->
                <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow">
                    <!-- Header -->
                    <div class="flex items-center justify-between p-4 border-b dark:border-gray-700">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Bukti Kehadiran - {{ $siswaAbsen->siswa->name }}
                        </h3>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-700 dark:hover:text-white"
                            data-modal-hide="modal-{{ $siswaAbsen->id }}">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414 1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Body -->
                    <div class="p-4">
                        <img src="{{ asset('storage/absensi/' . $siswaAbsen->foto_siswa) }}"
                            alt="{{ $siswaAbsen->siswa->name }}" class="w-full h-auto object-cover rounded-md">
                    </div>
                    <!-- Footer -->
                    <div class="flex items-center p-6 space-x-2 border-t border-gray-200 dark:border-gray-700">
                        <button data-modal-hide="modal-{{ $siswaAbsen->id }}" type="button"
                            class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg px-5 py-2.5 text-center">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('content')
    <form action="{{ route('admin.rekap.index') }}" method="get">
        <div class="relative max-w-lg flex gap-1">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                </svg>
            </div>
            <input id="datepicker-actions" value="{{ request('tanggal') }}" datepicker datepicker-buttons
                datepicker-autoselect-today type="text" name="tanggal"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Select date" autocomplete="off">
            <button type="submit"
                class="inline-flex items-center py-2.5 px-3 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>Search
            </button>
        </div>
    </form>

    <div class="mb-4 mt-4 border-b border-gray-200 dark:border-gray-700">
        <div class="flex justify-between items-center">
            <!-- Tabs -->
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="default-styled-tab"
                data-tabs-toggle="#default-styled-tab-content"
                data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
                data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                role="tablist">
                <li class="me-2" role="presentation">
                    <button class="inline-block p-4 border-b-2 rounded-t-lg" id="absen-tab"
                        data-tabs-target="#tab-content-absen" type="button" role="tab"
                        aria-controls="tab-content-absen" aria-selected="false">Absen</button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="tidak-absen-tab" data-tabs-target="#tab-content-tidak-absen" type="button" role="tab"
                        aria-controls="tab-content-tidak-absen" aria-selected="false">Tidak Absen</button>
                </li>
                <li class="me-2" role="presentation">
                    <button
                        class="inline-block p-4 border-b-2 rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300"
                        id="persentase-tab" data-tabs-target="#tab-content-persentase" type="button" role="tab"
                        aria-controls="tab-content-persentase" aria-selected="false">Persentase</button>
                </li>
            </ul>
            <!-- Display Date -->
            <div class="text-gray-900 text-sm font-medium">
                Tanggal: <span class="font-semibold">{{ $tanggalTeks }}</span>
            </div>
        </div>
    </div>


    <div id="default-styled-tab-content">
        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="tab-content-absen" role="tabpanel"
            aria-labelledby="absen-tab">

            <div class="border-b border-gray-200 dark:border-gray-700 mb-4">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="nested-profile-tab"
                    data-tabs-toggle="#nested-profile-tab-content"
                    data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
                    data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                    role="tablist">
                    @foreach ($rombels as $index => $rombel)
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg"
                                id="nested-profile-tab-button-{{ $index }}"
                                data-tabs-target="#nested-profile-content-{{ $index }}" type="button"
                                role="tab" aria-controls="nested-profile-content-{{ $index }}"
                                aria-selected="false">
                                {{ $rombel['name_rombel'] }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div id="nested-profile-tab-content">
                @foreach ($rombels as $index => $rombel)
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                        id="nested-profile-content-{{ $index }}" role="tabpanel"
                        aria-labelledby="nested-profile-tab-button-{{ $index }}">

                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-300">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Nama Siswa</th>
                                        <th scope="col" class="px-6 py-3">NIS</th>
                                        <th scope="col" class="px-6 py-3">Rombel</th>
                                        <th scope="col" class="px-6 py-3">Rayon</th>
                                        <th scope="col" class="px-6 py-3">Bukti Kehadiran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($siswaAbsens as $siswaAbsen)
                                        @if ($siswaAbsen->siswa->rombel === $rombel->name_rombel)
                                            <tr class="bg-white dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $siswaAbsen->siswa->name }}
                                                </th>
                                                <td class="px-6 py-4">{{ $siswaAbsen->siswa->nis }}</td>
                                                <td class="px-6 py-4">{{ $siswaAbsen->siswa->rombel }}</td>
                                                <td class="px-6 py-4">{{ $siswaAbsen->siswa->rayon }}</td>
                                                <td class="px-6 py-4">
                                                    <!-- Tombol untuk membuka modal -->
                                                    <button data-modal-target="modal-{{ $siswaAbsen->id }}"
                                                        data-modal-toggle="modal-{{ $siswaAbsen->id }}"
                                                        class="text-blue-500 hover:underline focus:outline-none">
                                                        Lihat Bukti Kehadiran
                                                    </button>

                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>


        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="tab-content-tidak-absen" role="tabpanel"
            aria-labelledby="tidak-absen-tab">

            <div class=" border-b border-gray-200 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="nested-tidak-absen-tab"
                    data-tabs-toggle="#nested-tidak-absen-tab-content"
                    data-tabs-active-classes="text-purple-600 hover:text-purple-600 dark:text-purple-500 dark:hover:text-purple-500 border-purple-600 dark:border-purple-500"
                    data-tabs-inactive-classes="dark:border-transparent text-gray-500 hover:text-gray-600 dark:text-gray-400 border-gray-100 hover:border-gray-300 dark:border-gray-700 dark:hover:text-gray-300"
                    role="tablist">
                    @foreach ($rombels as $index => $rombel)
                        <li class="me-2" role="presentation">
                            <button class="inline-block p-4 border-b-2 rounded-t-lg"
                                id="nested-tidak-absen-tab-button-{{ $index }}"
                                data-tabs-target="#nested-tidak-absen-content-{{ $index }}" type="button"
                                role="tab" aria-controls="nested-tidak-absen-content-{{ $index }}"
                                aria-selected="false">
                                {{ $rombel['name_rombel'] }}
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div id="nested-tidak-absen-tab-content">
                @foreach ($rombels as $index => $rombel)
                    <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800"
                        id="nested-tidak-absen-content-{{ $index }}" role="tabpanel"
                        aria-labelledby="nested-tidak-absen-tab-button-{{ $index }}">

                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-900 uppercase dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Nama Siswa</th>
                                        <th scope="col" class="px-6 py-3">NIS</th>
                                        <th scope="col" class="px-6 py-3">Rombel</th>
                                        <th scope="col" class="px-6 py-3">Rayon</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($getSiswaBelumAbsen as $siswaTidakAbsen)
                                        @if ($siswaTidakAbsen->rombel === $rombel->name_rombel)
                                            <tr class="bg-white dark:bg-gray-800">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                    {{ $siswaTidakAbsen->name }}
                                                </th>
                                                <td class="px-6 py-4">{{ $siswaTidakAbsen->nis }}</td>
                                                <td class="px-6 py-4">{{ $siswaTidakAbsen->rombel }}</td>
                                                <td class="px-6 py-4">{{ $siswaTidakAbsen->rayon }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>


        <div class="hidden p-4 rounded-lg bg-gray-50 dark:bg-gray-800" id="tab-content-persentase" role="tabpanel"
            aria-labelledby="persentase-tab">
            <div class="w-full mt-5 border-2 rounded-xl h-[350px] p-4"> <!-- Lebar untuk chart bar -->
                <canvas id="myChart" class="w-full h-[350px]"></canvas>
            </div>
        </div>
    </div>

    <script>
        // Array warna pastel yang tersedia
        function generateColors(length) {
            // Array warna pastel yang cerah
            const pastelColors = [
                'rgba(255, 99, 132, 0.2)', // Merah muda
                'rgba(54, 162, 235, 0.2)', // Biru muda
                'rgba(255, 206, 86, 0.2)', // Kuning lembut
                'rgba(75, 192, 192, 0.2)', // Hijau mint
                'rgba(153, 102, 255, 0.2)', // Ungu muda
                'rgba(255, 159, 64, 0.2)', // Oranye lembut
                'rgba(255, 99, 132, 0.2)' // Merah muda
            ];

            const colors = [];
            for (let i = 0; i < length; i++) {
                // Looping warna pastel sesuai panjang data
                colors.push(pastelColors[i % pastelColors.length]);
            }
            return colors;
        }

        // Data rombel dan absensi
        const rombels = @json($rombels->pluck('name_rombel')); 
        const data = @json($absensiByRombel); 

        // Pastikan data sudah diterima dengan benar
        console.log(rombels); 
        console.log(data); 

        // Mengonversi data untuk chart
        const chartLabels = rombels;
        const chartData = rombels.map(rombel => data[rombel] ||
        0); 

        console.log(chartLabels); 
        console.log(chartData); 

        // Konfigurasi Chart.js
        const ctx2 = document.getElementById('myChart').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: chartLabels, // Menampilkan nama rombel
                datasets: [{
                    label: 'Data Absen',
                    data: chartData, // Data absensi
                    backgroundColor: generateColors(chartData.length),
                    borderColor: generateColors(chartData.length).map(color => color.replace(
                        /0\.2/, '1')),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true // Memastikan sumbu Y mulai dari 0
                    }
                }
            }
        });
    </script>
@endsection
