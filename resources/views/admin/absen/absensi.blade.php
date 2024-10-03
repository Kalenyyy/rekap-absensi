@extends('layouts.template_fix')

@section('content')
    <div class="max-w-4xl mx-auto p-8 bg-white rounded-lg shadow-lg">
        <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Absensi Face dengan Kamera</h1>
        <div class="flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-8">
            <!-- Video Kamera -->
            <div class="relative">
                <video id="video" autoplay playsinline
                    class="border-4 border-gray-300 rounded-lg shadow-lg transform scale-x-[-1]" width="640"
                    height="480"></video>
                <canvas id="overlay" class="absolute top-0 left-0 w-full h-full"></canvas>
            </div>

            <!-- Form Registrasi -->
            <form id="absenForm" action="{{ route('admin.absen.absenSiswa') }}" method="POST" enctype="multipart/form-data"
                class="bg-white p-6 rounded-lg shadow-lg w-full max-w-sm">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                        <input type="text" name="name" id="nama" readonly
                            class="mt-1 block w-full border-gray-300 rounded-md pointer-events-none shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Nama Siswa">
                    </div>
                    <div>
                        <label for="nis" class="block text-sm font-medium text-gray-700">NIS</label>
                        <input type="text" name="nis" id="nis" readonly
                            class="mt-1 block w-full border-gray-300 rounded-md pointer-events-none shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Nomor Induk Siswa">
                    </div>
                    <div>
                        <label for="rayon" class="block text-sm font-medium text-gray-700">Rayon</label>
                        <input type="text" name="rayon" id="rayon" readonly
                            class="mt-1 block w-full border-gray-300 rounded-md pointer-events-none shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Rayon">
                    </div>
                    <div>
                        <label for="rombel" class="block text-sm font-medium text-gray-700">Rombel</label>
                        <input type="text" name="rombel" id="rombel" readonly
                            class="mt-1 block w-full border-gray-300 rounded-md pointer-events-none shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Rombel">
                    </div>
                    <input type="hidden" name="image" id="image">
                </div>
                <div class="space-y-4">
                    <button type="button" id="detect"
                        class="w-full bg-gradient-to-r from-green-400 to-green-500 hover:from-green-500 hover:to-green-600 text-white font-bold py-2 px-4 rounded shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Detect</button>

                    <button type="submit" id="saveButton"
                        class="w-full bg-gradient-to-r from-blue-400 to-blue-500 hover:from-blue-500 hover:to-blue-600 text-white font-bold py-2 px-4 rounded shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 hidden">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        const detectButton = document.getElementById('detect');
        const saveButton = document.getElementById('saveButton');
        const imageInput = document.getElementById('image');

        // Mendapatkan akses ke kamera
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(function(stream) {
                    video.srcObject = stream;
                    video.play();
                })
                .catch(function(error) {
                    console.error('Error accessing the camera:', error);
                    alert('Tidak dapat mengakses kamera. Pastikan izin diberikan.');
                });
        } else {
            alert('Browser Anda tidak mendukung akses kamera.');
        }

        detectButton.addEventListener('click', (event) => {
            event.preventDefault();
            canvas.width = video.videoWidth * 0.5;
            canvas.height = video.videoHeight * 0.5;

            if (video.videoWidth > 0 && video.videoHeight > 0) {
                context.drawImage(video, 0, 0, canvas.width, canvas.height);
                const imageData = canvas.toDataURL('image/jpeg');
                const base64Image = imageData.split(',')[1];

                console.log("Sending image to server for recognition...");

                // Kirim gambar ke Flask untuk deteksi wajah
                fetch('http://localhost:5000/recognize_face', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            image: base64Image
                        })
                    })
                    .then(response => {
                        console.log("Server response:", response);
                        return response.json();
                    })
                    .then(data => {
                        console.log("Data received:", data);
                        if (data.status === 'found') {
                            document.getElementById('nama').value = data.name;
                            document.getElementById('nis').value = data.nis;
                            document.getElementById('rayon').value = data.rayon;
                            document.getElementById('rombel').value = data.rombel;

                            // Masukkan base64 image ke input hidden
                            document.getElementById('image').value = base64Image;

                            saveButton.classList.remove('hidden');
                        } else {
                            alert('Wajah tidak ditemukan');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghubungi server.');
                    });
            } else {
                alert('Video tidak tersedia, pastikan kamera berfungsi dengan baik.');
            }
        });
    </script>
@endsection
