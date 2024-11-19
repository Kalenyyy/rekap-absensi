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
    <li>
        <div class="flex items-center">
            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fillRule="evenodd"
                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                    clipRule="evenodd"></path>
            </svg>
            <a href=""
                class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 dark:text-gray-400 dark:hover:text-white">{{ $siswa['name'] }}</a>
        </div>
    </li>
@endsection

@section('content')
    <div class="max-w-5xl mx-auto p-10 bg-gray-50 rounded-lg shadow-lg">
        <h1 class="text-5xl font-semibold text-center mb-5 text-gray-700">Registrasi Wajah</h1>

        <div class="flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-16">
            <!-- Video Kamera -->
            <div class="relative">
                <img id="video" crossOrigin="anonymous" src="http://192.168.137.222:8080/video"
                    class="border-2 border-gray-200 rounded-md shadow-md" width="640" height="480" autoplay
                    style="transform: scaleX(-1);">
                <canvas id="overlay" class="absolute top-0 left-0" width="640" height="480"></canvas>
            </div>

            <!-- Form Registrasi -->
            <form id="registerForm" action="{{ route('admin.register.register-face') }}" method="POST"
                enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
                @csrf
                <div class="mb-6">
                    <label for="nama" class="block text-lg font-medium text-gray-600">Nama</label>
                    <input type="text" name="name" value="{{ $siswa['name'] }}" id="nama"
                        class="mt-2 block w-full border border-gray-300 rounded-md p-3 focus:ring-blue-400 focus:border-blue-400 transition ease-in-out duration-200"
                        required>
                </div>
                <div class="mb-6">
                    <label for="nis" class="block text-lg font-medium text-gray-600">NIS</label>
                    <input type="text" name="nis" value="{{ $siswa['nis'] }}" id="nis"
                        class="mt-2 block w-full border border-gray-300 rounded-md p-3 focus:ring-blue-400 focus:border-blue-400 transition ease-in-out duration-200"
                        required>
                </div>
                <div class="mb-6">
                    <label for="rayon" class="block text-lg font-medium text-gray-600">Rayon</label>
                    <input type="text" name="rayon" value="{{ $siswa['rayon'] }}" id="rayon"
                        class="mt-2 block w-full border border-gray-300 rounded-md p-3 focus:ring-blue-400 focus:border-blue-400 transition ease-in-out duration-200"
                        required>
                </div>
                <div class="mb-6">
                    <label for="rombel" class="block text-lg font-medium text-gray-600">Rombel</label>
                    <input type="text" name="rombel" value="{{ $siswa['rombel'] }}" id="rombel"
                        class="mt-2 block w-full border border-gray-300 rounded-md p-3 focus:ring-blue-400 focus:border-blue-400 transition ease-in-out duration-200"
                        required>
                </div>
                <input type="hidden" name="image" id="image">
                <button type="submit" id="register"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-3 px-4 rounded-md mt-6 shadow-md transition transform hover:scale-105">Register</button>
            </form>
        </div>
    </div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        const registerButton = document.getElementById('register');
        const imageInput = document.getElementById('image');

        registerButton.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default form submission

            // Set canvas size to match the video stream dimensions
            canvas.width = video.width;
            canvas.height = video.height;

            // Draw the current frame from the video (img) onto the canvas
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            const imageData = canvas.toDataURL('image/jpeg');

            if (imageData) {
                imageInput.value = imageData.split(',')[1]; // Ambil bagian setelah ','

                // Submit the form
                document.getElementById('registerForm').submit();
            } else {
                console.error("Gambar tidak berhasil ditangkap.");
            }
        });
    </script>
@endsection
