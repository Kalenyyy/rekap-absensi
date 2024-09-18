@extends('layouts.template_fix')

@section('top_content')
    {{-- <li>
        <div class="flex items-center">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clip-rule="evenodd"></path>
            </svg>
            <a href="{{ route('admin.user.index') }}"
                class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                Users
            </a>
        </div>
    </li> --}}
@endsection

@section('modal')
@endsection

@section('content')
    <div class="flex justify-center items-center mt-12">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-screen-lg flex flex-col mx-auto sm:ml-16 sm:-mt-16 lg:ml-32 lg:-mt-15">
            <!-- Adjusted margin-left and margin-top with responsive utilities -->
            <div class="text-center border-b-2 border-[#667BC3] pb-4 mb-3">
                <h1 class="text-4xl font-bold text-[#667BC3]">
                    SELAMAT DATANG DI WEBSITE ABSENSI FACE RECOGNITION SMK WIKRAMA BOGOR
                </h1>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 flex-grow px-4"> <!-- Adjusted gap and padding -->
                <a href="{{ route('dashboard.gen20') }}"
                   class="bg-[#667BC3] text-white text-4xl font-bold rounded-lg flex items-center justify-center h-48 transform transition-transform duration-300 hover:scale-105">
                   GEN 20
                </a>
                <a href="{{ route('dashboard.gen21') }}"
                   class="bg-[#667BC3] text-white text-3xl font-bold rounded-lg flex items-center justify-center h-48 transform transition-transform duration-300 hover:scale-105">
                    GEN 21
                </a>
                
                <a href="{{ route('dashboard.gen22') }}"
                   class="bg-[#667BC3] text-white text-3xl font-bold rounded-lg flex items-center justify-center h-48 transform transition-transform duration-300 hover:scale-105 sm:col-span-2 mt-4">
                    GEN 22
                </a>
            </div>
        </div>
    </div>
@endsection
