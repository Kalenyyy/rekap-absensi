@extends('layouts.template_fix')

@section('top_content')
@endsection

@section('content')
    <form action="{{ route('admin.register.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" />
        <button type="submit">Import</button>
    </form> 
    <h1 class="text-3xl font-bold ">Data Siswa</h1>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Nama Siswa
                    </th>
                    <th scope="col" class="px-6 py-3">
                        NIS
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rayon
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Rombel
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data_siswas as $index => $student)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $student['name'] }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $student['nis'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $student['rayon'] }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $student['rombel'] }}
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.register.RegisterSiswa', $student['id']) }}">
                                <button type="button"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Default</button>
                            </a>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>

    
@endsection
