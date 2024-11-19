@extends('layouts.template_fix')

@section('top_content')
    {{-- <li>
        <div class="flex items-center">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
            <a href="#b"
                class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                Dashboard
            </a>
        </div>
    </li> --}}
@endsection

@section('modal')
@endsection

@section('content')
    <div class="flex justify-center items-center">
        <div class="flex flex-nowrap my-5 w-full">
            <div class="w-1/3 p-2">
                <a href="{{ route('data-absen') }}">
                    <div
                        class="flex items-center flex-row w-full bg-gradient-to-r dark:from-cyan-500 dark:to-blue-500 from-indigo-500 via-purple-500 to-pink-500 rounded-md p-3">
                        <div
                            class="flex text-indigo-500 dark:text-white items-center bg-white dark:bg-[#0F172A] p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12 ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                stroke="currentColor" class="object-scale-down transition duration-500">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                        </div>
                        <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                            <div class="text-xs whitespace-nowrap">
                                Siswa Absen Hari Ini
                            </div>
                            <div class="">
                                {{ $countSiswaAbsenToday }}
                            </div>
                        </div>
                        <div class="flex items-center flex-none text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                stroke="currentColor" class="w-6 h-6">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>

                        </div>
                    </div>
                </a>
            </div>

            <div class="w-1/3 p-2">
                <a href="{{ route('belum-absen') }}">
                <div
                    class="flex items-center flex-row w-full bg-gradient-to-r dark:from-cyan-500 dark:to-blue-500 from-indigo-500 via-purple-500 to-pink-500 rounded-md p-3">
                    <div
                        class="flex text-indigo-500 dark:text-white items-center bg-white dark:bg-[#0F172A] p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12 ">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                            stroke="currentColor" class="object-scale-down transition duration-500 ">
                            <path strokeLinecap="round" strokeLinejoin="round"
                                d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                    </div>
                    <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                        <div class="text-xs whitespace-nowrap">
                            Siswa Belum Absen
                        </div>
                        <div class="">
                            {{ $countSiswaBelumAbsenToday }}
                        </div>
                    </div>
                    <div class="flex items-center flex-none text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                            stroke="currentColor" class="w-6 h-6">
                            <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                        </svg>
                    </div>
                </div>
                </a>
            </div>

            <div class="w-1/3 p-2">
                <a href="{{ route('admin.register.index') }}">
                    <div
                        class="flex items-center flex-row w-full bg-gradient-to-r dark:from-cyan-500 dark:to-blue-500 from-indigo-500 via-purple-500 to-pink-500 rounded-md p-3">
                        <div
                            class="flex text-indigo-500 dark:text-white items-center bg-white dark:bg-[#0F172A] p-2 rounded-md flex-none w-8 h-8 md:w-12 md:h-12 ">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                stroke="currentColor" class="object-scale-down transition duration-500">
                                <path strokeLinecap="round" strokeLinejoin="round"
                                    d="M3.75 3v11.25A2.25 2.25 0 006 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0118 16.5h-2.25m-7.5 0h7.5m-7.5 0l-1 3m8.5-3l1 3m0 0l.5 1.5m-.5-1.5h-9.5m0 0l-.5 1.5m.75-9l3-3 2.148 2.148A12.061 12.061 0 0116.5 7.605" />
                            </svg>
                        </div>
                        <div class="flex flex-col justify-around flex-grow ml-5 text-white">
                            <div class="text-xs whitespace-nowrap">
                                Jumlah Siswa
                            </div>
                            <div class="">
                                {{ $totalSiswa }}
                            </div>
                        </div>
                        <div class="flex items-center flex-none text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" strokeWidth={1.5}
                                stroke="currentColor" class="w-6 h-6">
                                <path strokeLinecap="round" strokeLinejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                            </svg>

                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <h1 class="text-center font-bold text-xl ">Laporan Harian</h1>
    <div class="px-10 flex gap-5">
        <div class="w-[70%] mt-5 border-2 rounded-xl h-[500px] p-4"> <!-- Lebar untuk chart bar -->
            <canvas id="myChart"></canvas>
        </div>
        <div class="w-[30%] mt-5 border-2 rounded-xl h-[500px] p-4"> <!-- Lebar untuk chart pie -->
            <canvas id="PieChart"></canvas>
        </div>
    </div>


    <script>
        const ctx2 = document.getElementById('PieChart').getContext('2d');

        new Chart(ctx2, {
            type: 'pie',
            data: {
                labels: ['Sudah Absen', 'Belum Absen'],
                datasets: [{
                    data: [{{ $countSiswaAbsenToday }}, {{ $countSiswaBelumAbsenToday }}],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Allows you to set height explicitly
            }
        });
    </script>

    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        // Data absensi dari controller
        const absensiData = @json($absensiData);

        // Fungsi untuk memformat tanggal
        function formatDate(date) {
            const options = {
                month: 'short',
                day: 'numeric'
            };
            return date.toLocaleDateString('en-US', options);
        }

        // Fungsi untuk mendapatkan label dan data absensi
        function getDateLabelsAndData() {
            const labels = [];
            const data = [];
            const today = new Date();

            // Loop dari 4 hari kebelakang sampai 2 hari kedepan
            for (let i = -6; i <= 0; i++) {
                const currentDate = new Date(today);
                currentDate.setDate(today.getDate() + i);
                const formattedDate = currentDate.toISOString().split('T')[0]; // Format ke YYYY-MM-DD

                labels.push(formatDate(currentDate));

                // Cari apakah tanggal tersebut ada di dalam data absensi dari controller
                const foundData = absensiData.find(item => item.tanggal === formattedDate);

                // Jika ditemukan, tambahkan jumlah absensi, jika tidak ditemukan, set 0
                data.push(foundData ? foundData.jumlah_absen : 0);
            }

            return {
                labels,
                data
            };
        }

        const {
            labels,
            data
        } = getDateLabelsAndData();

        // Fungsi untuk menghasilkan warna cerah
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

        // Membuat chart
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Siswa Absen',
                    data: data,
                    backgroundColor: generateColors(data.length), // Menggunakan warna pastel
                    borderColor: generateColors(data.length).map(color => color.replace('0.2',
                    '1')), // Warna border lebih tegas
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>


{{-- Script jika Sabtu Minggu tidak ada pada chart --}}
{{-- const ctx = document.getElementById('myChart').getContext('2d');
// Data absensi dari controller
const absensiData = @json($absensiData);

// Fungsi untuk memformat tanggal
function formatDate(date) {
    const options = {
        month: 'short',
        day: 'numeric'
    };
    return date.toLocaleDateString('en-US', options);
}

// Fungsi untuk mendapatkan label dan data absensi
function getDateLabelsAndData() {
    const labels = [];
    const data = [];
    const today = new Date();

    // Loop dari 6 hari kebelakang sampai hari ini
    for (let i = -6; i <= 0; i++) {
        const currentDate = new Date(today);
        currentDate.setDate(today.getDate() + i);

        // Cek apakah hari adalah Sabtu (6) atau Minggu (0)
        const dayOfWeek = currentDate.getDay();
        if (dayOfWeek === 6 || dayOfWeek === 0) {
            continue; // Skip Sabtu dan Minggu
        }

        const formattedDate = currentDate.toISOString().split('T')[0]; // Format ke YYYY-MM-DD

        labels.push(formatDate(currentDate));

        // Cari apakah tanggal tersebut ada di dalam data absensi dari controller
        const foundData = absensiData.find(item => item.tanggal === formattedDate);

        // Jika ditemukan, tambahkan jumlah absensi, jika tidak ditemukan, set 0
        data.push(foundData ? foundData.jumlah_absen : 0);
    }

    return {
        labels,
        data
    };
}

const { labels, data } = getDateLabelsAndData();

// Fungsi untuk menghasilkan warna cerah
function generateColors(length) {
    // Array warna pastel yang cerah
    const pastelColors = [
        'rgba(255, 99, 132, 0.2)',   // Merah muda
        'rgba(54, 162, 235, 0.2)',   // Biru muda
        'rgba(255, 206, 86, 0.2)',   // Kuning lembut
        'rgba(75, 192, 192, 0.2)',   // Hijau mint
        'rgba(153, 102, 255, 0.2)',  // Ungu muda
        'rgba(255, 159, 64, 0.2)',   // Oranye lembut
        'rgba(255, 99, 132, 0.2)'    // Merah muda
    ];

    const colors = [];
    for (let i = 0; i < length; i++) {
        // Looping warna pastel sesuai panjang data
        colors.push(pastelColors[i % pastelColors.length]);
    }
    return colors;
}

// Membuat chart
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [{
            label: 'Total Siswa Absen',
            data: data,
            backgroundColor: generateColors(data.length), // Menggunakan warna pastel
            borderColor: generateColors(data.length).map(color => color.replace('0.2', '1')), // Warna border lebih tegas
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
}); --}}

@endsection
