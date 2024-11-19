@extends('layouts.template_fix')

@section('top_content')
    <li>
        <div class="flex items-center">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fillRule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clipRule="evenodd"></path>
            </svg>
            <a href=""
                class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">Data
                Absen Siswa</a>
        </div>

    </li>
@endsection

@section('content')
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 space-y-4 md:space-y-0">
        <!-- Judul -->
        <h1 class="text-3xl font-bold">Data Absen Hari ini</h1>

        <form class="flex items-center w-1/2 md:w-2/3 lg:w-1/3" action="" method="GET">
            <!-- Dropdown Rombel -->
            <div class="relative inline-block text-left mr-2 w-full md:w-auto">
                <select name="rombel" id="rombel"
                    class="w-auto min-w-[200px] py-2.5 px-4 text-sm font-medium text-gray-900 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white dark:border-gray-600 dark:focus:ring-gray-700">
                    <option value="" hidden selected>Pilih Rombel</option> <!-- Opsi default -->
                    @foreach ($rombels as $rombel)
                        <option value="{{ $rombel->name_rombel }}"
                            {{ request('rombel') == $rombel->name_rombel ? 'selected' : '' }}>
                            {{ $rombel->name_rombel }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Search Input -->
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2" />
                    </svg>
                </div>
                <input type="text" id="simple-search" name="search"
                    class="w-full py-2.5 pl-10 pr-4 text-sm bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search name..." value="{{ request('search') }}">
            </div>

            <!-- Search Button -->
            <button type="submit"
                class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Search</span>
            </button>
        </form>
    </div>

    <div class="relative overflow-x-auto sm:rounded-lg">
        <div class="flex flex-wrap justify-start gap-4">
            @foreach ($getAllSiswaAbsenToday as $siswa)
                <!-- Card -->
                <div
                    class="max-w-xs flex-shrink-0 w-1/5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="#">
                        <img class="rounded-t-lg h-48 w-full object-cover"
                            src="{{ asset('storage/absensi/' . $siswa['foto_siswa']) }}" alt="{{ $siswa['name'] }}" />
                    </a>
                    <div class="p-5">
                        <a href="#">
                            <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                                {{ $siswa['name'] }}</h5>
                        </a>
                        <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">
                            {{ $siswa['siswa']['rombel'] }} | {{ $siswa['siswa']['rayon'] }} | {{ $siswa['siswa']['nis'] }}
                        </p>
                        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            Tanggal: {{ \Carbon\Carbon::parse($siswa['tanggal'])->format('d, F Y') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- @foreach ($getAllSiswaAbsenToday as $siswa)
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden mt-4">
                <!-- Tombol Collapse -->
                <button
                    class="w-full p-4 text-left text-purple-700 font-semibold flex justify-between items-center bg-purple-100 hover:bg-purple-200 transition duration-300"
                    onclick="toggleCollapsible('{{ $siswa['id'] }}')">
                    <span>{{ $siswa['name'] }} / {{ $siswa['siswa']['rombel'] }} / {{ $siswa['siswa']['rayon'] }}</span>
                    <span>&#9660;</span> <!-- Dropdown Arrow -->
                </button>
                <!-- Collapsible Content -->
                <div id="{{ $siswa['id'] }}"
                    class="px-6 pb-4 overflow-hidden transition-[max-height] duration-500 ease-in-out max-h-0">
                    <div class="flex items-start mt-4 space-x-4">
                        <!-- Informasi Siswa -->
                        <div class="text-gray-600 flex-1 space-y-2">
                            <p><strong class="text-gray-900">NIS:</strong> {{ $siswa['siswa']['nis'] }}</p>
                            <p><strong class="text-gray-900">Rayon:</strong> {{ $siswa['siswa']['rayon'] }}</p>
                            <p><strong class="text-gray-900">Rombel:</strong> {{ $siswa['siswa']['rombel'] }}</p>
                        </div>
                        <!-- Gambar Siswa -->
                        <div class="w-32 h-32">
                            <img class="w-full h-full object-cover rounded-md border border-gray-300"
                                src="{{ asset('storage/absensi/' . $siswa['foto_siswa']) }}" alt="Foto Siswa">
                        </div>
                    </div>
                </div>
            </div>
        @endforeach --}}


    <!-- Pagination Section -->
    <div class="flex flex-col items-center mt-6 space-y-3">
        <!-- Help text -->
        <span class="text-sm text-gray-700 dark:text-gray-400">
            Showing <span
                class="font-semibold text-gray-900 dark:text-white">{{ $getAllSiswaAbsenToday->firstItem() }}</span>
            to <span class="font-semibold text-gray-900 dark:text-white">{{ $getAllSiswaAbsenToday->lastItem() }}</span>
            of <span class="font-semibold text-gray-900 dark:text-white">{{ $getAllSiswaAbsenToday->total() }}</span>
            Entries
        </span>

        <!-- Pagination Buttons -->
        <div class="inline-flex mt-2 xs:mt-0">
            <!-- Previous Page Link -->
            @if ($getAllSiswaAbsenToday->onFirstPage())
                <button disabled
                    class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-gray-400 rounded-l-lg">
                    <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0l4-4M1 5l4 4" />
                    </svg>
                    Prev
                </button>
            @else
                <a href="{{ $getAllSiswaAbsenToday->previousPageUrl() }}">
                    <button
                        class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-l-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 5H1m0 0l4-4M1 5l4 4" />
                        </svg>
                        Prev
                    </button>
                </a>
            @endif

            <!-- Next Page Link -->
            @if ($getAllSiswaAbsenToday->hasMorePages())
                <a href="{{ $getAllSiswaAbsenToday->nextPageUrl() }}">
                    <button
                        class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border-0 border-l border-gray-300 rounded-r-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Next
                        <svg class="w-4 h-4 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h12m0 0L9 1m4 4L9 9" />
                        </svg>
                    </button>
                </a>
            @else
                <button disabled
                    class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-gray-400 rounded-r-lg">
                    Next
                    <svg class="w-4 h-4 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h12m0 0L9 1m4 4L9 9" />
                    </svg>
                </button>
            @endif
        </div>
    </div>

    <script>
        // Function to toggle collapsible content
        function toggleCollapsible(id) {
            var content = document.getElementById(id);

            if (content.style.maxHeight) {
                // Close the content smoothly
                content.style.maxHeight = null;
            } else {
                // Open the content smoothly by setting the max-height to scrollHeight
                content.style.maxHeight = content.scrollHeight + "px";
            }
        }

        $(document).ready(function() {
            $('#simple-search').on('keyup', function() {
                let search = $(this).val();
                let rombel = $('#rombel').val();

                $.ajax({
                    url: "{{ route('search.absen.today') }}",
                    method: 'GET',
                    data: {
                        search: search,
                        rombel: rombel,
                    },
                    success: function(response) {
                        $('.list').html(
                            response); // Update collapsible atau bagian halaman yang benar
                    }
                });
            });

            $('#rombel').on('change', function() {
                let search = $('#simple-search').val();
                let rombel = $(this).val();

                $.ajax({
                    url: "{{ route('search.absen.today') }}",
                    method: 'GET',
                    data: {
                        search: search,
                        rombel: rombel,
                    },
                    success: function(response) {
                        $('.list').html(
                            response); // Update collapsible atau bagian halaman yang benar
                    }
                });
            });
        });
    </script>
@endsection
