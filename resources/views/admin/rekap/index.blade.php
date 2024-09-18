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
                Rekap
            </a>
        </div>
    </li>
@endsection

@section('modal')
@endsection

@section('content')
    <div class="flex justify-center items-center mt-4 px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-screen-lg h-auto flex flex-col">

            <div class="text-center border-b-2 border-[#667BC3] pb-4">
                <h1 class="text-4xl font-bold text-[#667BC3]">SELAMAT DATANG DI WEBSITE ABSENSI</h1>
                <p class="text-xl font-medium text-[#667BC3]">FACE RECOGNITION SMK WIKRAMA BOGOR</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-7 mt-6">
                <!-- Total Data Rombel -->
                <div class="bg-[#667BC3] text-white p-8 rounded-lg shadow-md flex justify-between items-center">
                    <i class="fa-solid fa-file-invoice text-5xl mr-6"></i> 
                    <div class="flex flex-col items-start">
                        <div class="text-3xl font-bold">Total Data Rombel</div>
                        <div class="text-base mt-4">Kelas Tersedia</div>
                    </div>
                    <div class="text-6xl font-bold">{{ $rombels }}</div>
                </div>
            
                <!-- Data Siswa -->
                <div class="bg-[#667BC3] text-white p-8 rounded-lg shadow-md flex justify-between items-center">
                    <i class="fa-solid fa-users text-5xl mr-6"></i> 
                    <div class="flex flex-col items-start">
                        <div class="text-3xl font-bold">Data Siswa</div>
                        <div class="text-base mt-4">Keseluruhan Siswa</div>
                    </div>
                    <div class="text-6xl font-bold">{{ $siswa }}</div>
                </div>
            
            
                <div class="bg-[#667BC3] text-white p-8 rounded-lg shadow-md flex justify-between items-center">
                    <i class="fa-solid fa-calendar-check text-5xl mr-6"></i> 
                    <div class="flex flex-col items-start">
                        <div class="text-3xl font-bold">Presensi Hari Ini</div>
                        <div class="text-base mt-4">Dari Total Siswa</div>
                    </div>
                    <div class="text-6xl font-bold">{{ $jumlah }}</div> 
                </div>
            
         
                <div class="bg-[#667BC3] text-white p-8 rounded-lg shadow-md flex justify-between items-center">
                    <i class="fa-solid fa-chalkboard-teacher text-5xl mr-6"></i> 
                    <div class="flex flex-col items-start">
                        <div class="text-3xl font-bold">Data Guru</div>
                        <div class="text-base mt-4">Keseluruhan Guru</div>
                    </div>
                    <div class="text-6xl font-bold">{{ $guru }}</div> 
                </div>
            </div>
            

            <div class="flex justify-center mt-4">
                <a href="{{ route('dashboard.index') }}" class="bg-gray-300 text-gray-800 text-lg font-medium rounded-lg py-2 px-4 transition-transform duration-300 hover:scale-105">
                    Back
                </a>
            </div>
        </div>
    </div>
@endsection


