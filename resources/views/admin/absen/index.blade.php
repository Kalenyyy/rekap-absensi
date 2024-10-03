@extends('layouts.template_fix')

@section('top_content')
    <li>
        <div class="flex items-center">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fillRule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clipRule="evenodd"></path>
            </svg>
            <a href="{{ route('admin.register.index') }}"
                class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">Data
                Siswa</a>
        </div>

    </li>
@endsection

@section('content')
    @if (session('status'))
        <div id="alert-3"
            class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
            role="alert">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                {{ session('status') }}
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-3" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endif
    <form action="{{ route('admin.register.import') }}" method="POST" enctype="multipart/form-data" class="mb-6">
        @csrf
        <div class="flex items-center space-x-4">
            <input type="file" name="file"
                class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400" />
            <button type="submit"
                class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50">
                Import
            </button>
        </div>
    </form>

    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 space-y-4 md:space-y-0">
        <!-- Judul -->
        <h1 class="text-3xl font-bold">Data Siswa</h1>

        <form class="flex items-center w-1/2 md:w-2/3 lg:w-1/3" action="{{ route('admin.register.index') }}" method="GET">
            <!-- Dropdown Rombel -->
            <div class="relative inline-block text-left mr-2 w-full md:w-auto">
                <select name="rombel" id="rombel"
                    class="w-auto min-w-[200px] py-2.5 px-4 text-sm font-medium text-gray-900 bg-gray-100 border border-gray-300 rounded-lg hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:text-white dark:border-gray-600 dark:focus:ring-gray-700">
                    <option value="" hidden>Pilih Rombel</option> <!-- Opsi default -->
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



    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Nama Siswa</th>
                    <th scope="col" class="px-6 py-3">NIS</th>
                    <th scope="col" class="px-6 py-3">Rayon</th>
                    <th scope="col" class="px-6 py-3">Rombel</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_siswas as $student)
                    @php
                        // Cek apakah siswa dengan nnis tertentu sudah terdaftar di tabel student_register
                        $isRegistered = \App\Models\StudentRegister::where('nis', $student['nis'])->exists();
                    @endphp
                    <tr
                        class="bg-white border-b dark:bg-gray-900 dark:border-gray-700 even:bg-gray-50 even:dark:bg-gray-800">
                        <td class="px-6 py-4">
                            {{ ($data_siswas->currentPage() - 1) * $data_siswas->perPage() + $loop->iteration }}</td>
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                            {{ $student['name'] }}</th>
                        <td class="px-6 py-4">{{ $student['nis'] }}</td>
                        <td class="px-6 py-4">{{ $student['rayon'] }}</td>
                        <td class="px-6 py-4">{{ $student['rombel'] }}</td>
                        <td class="px-6 py-4">
                            @if ($isRegistered)
                                <!-- Jika siswa sudah terdaftar, tombol berwarna abu-abu -->
                                <button type="button"
                                    class="px-5 py-2.5 text-sm font-medium text-white bg-gray-400 rounded-full cursor-not-allowed">
                                    Registered
                                </button>
                            @else
                                <!-- Jika belum terdaftar, tombol berwarna biru -->
                                <a href="{{ route('admin.register.RegisterSiswa', $student['id']) }}">
                                    <button type="button"
                                        class="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-full hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:bg-blue-700 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                        Register
                                    </button>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination Section -->
    <div class="flex flex-col items-center mt-6 space-y-3">
        <!-- Help text -->
        <span class="text-sm text-gray-700 dark:text-gray-400">
            Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $data_siswas->firstItem() }}</span>
            to <span class="font-semibold text-gray-900 dark:text-white">{{ $data_siswas->lastItem() }}</span>
            of <span class="font-semibold text-gray-900 dark:text-white">{{ $data_siswas->total() }}</span> Entries
        </span>

        <!-- Pagination Buttons -->
        <div class="inline-flex mt-2 xs:mt-0">
            <!-- Previous Page Link -->
            @if ($data_siswas->onFirstPage())
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
                <a href="{{ $data_siswas->previousPageUrl() }}">
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
            @if ($data_siswas->hasMorePages())
                <a href="{{ $data_siswas->nextPageUrl() }}">
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
@endsection
