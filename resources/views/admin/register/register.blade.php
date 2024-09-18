@extends('layouts.template_fix')

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
        <h1 class="text-3xl font-bold text-center mb-6">Register Face dengan Kamera</h1>
        @if (session('status'))
            <div class="bg-green-500 text-white p-4 rounded mb-6">
                {{ session('status') }}
            </div>
        @endif
        <div class="flex flex-col md:flex-row justify-center items-center space-y-6 md:space-y-0 md:space-x-6">
            <video id="video" class="border-4 border-gray-300 rounded-lg shadow-lg" width="640" height="480"
                autoplay></video>
            <canvas id="overlay" class="absolute top-0 left-0" width="640" height="480"></canvas>
            <form id="registerForm" action="{{ route('admin.register.register-face') }}" method="POST"
                enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
                @csrf
                <div class="mb-4">
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                    <input type="text" name="name" value="{{ $siswa['name'] }}" id="nama"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                </div>
                <div class="mb-4">
                    <label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
                    <input type="text" name="nis" value="{{ $siswa['nis'] }}" id="nis"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                </div>
                <div class="mb-4">
                    <label for="rayon" class="block text-sm font-medium text-gray-700">Rayon</label>
                    <input type="text" name="rayon" value="{{ $siswa['rayon'] }}" id="rayon"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                </div>
                <div class="mb-4">
                    <label for="rombel" class="block text-sm font-medium text-gray-700">Rombel</label>
                    <input type="text" name="rombel" value="{{ $siswa['rombel'] }}" id="rombel"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2" required>
                </div>
                <input type="hidden" name="image" id="image">
                <button type="submit" id="register"
                    class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mt-4">Register</button>
            </form>
        </div>
    </div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        const registerButton = document.getElementById('register');
        const imageInput = document.getElementById('image');

        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    video.srcObject = stream;
                })
                .catch(function(error) {
                    console.error("Error accessing the camera: ", error);
                });
        }

        registerButton.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent default form submission

            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = canvas.toDataURL('image/jpeg');
            imageInput.value = imageData.split(',')[1]; // Ambil bagian setelah ','

            // Submit the form
            document.getElementById('registerForm').submit();
        });
    </script>
@endsection
