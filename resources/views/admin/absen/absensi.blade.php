@extends('layouts.template_fix')

@section('content')
    <div class="max-w-4xl mx-auto px-4 bg-white rounded-lg shadow-lg">
        @if (Session::get('success'))
            <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Success alert!</span> {{ Session::get('success') }}
                </div>
            </div>
        @elseif (Session::get('error'))
            <div class="flex items-center p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 1 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Info alert!</span> {{ Session::get('error') }}
                </div>
            </div>
        @endif
        <h1 class="text-4xl font-bold text-center mb-8 text-gray-800">Absensi Face dengan IP Webcam</h1>
        <div class="flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-8">
            <!-- Video Kamera dari IP Webcam -->
            <img id="cameraStream" crossOrigin="anonymous" width="640" height="480"
                src="http://192.168.100.52:8080/video" alt="IP Webcam Stream" style="transform: scaleX(-1);">

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
        document.getElementById('detect').addEventListener('click', () => {
            const videoElement = document.getElementById('cameraStream');

            // Buat elemen canvas untuk mengambil snapshot dari video IP Webcam
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');

            // Set ukuran canvas sesuai dengan ukuran video (640x480)
            canvas.width = 640;
            canvas.height = 480;

            // Gambar frame video ke canvas
            context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);

            // Konversi canvas ke data URL (base64)
            const imageData = canvas.toDataURL('image/jpeg');
            const base64Image = imageData.split(',')[1];

            console.log("Sending image to server for recognition...");

            // Kirim gambar ke Flask untuk deteksi wajah
            fetch('http://localhost:5001/recognize_face', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        image: base64Image
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log("Response from server:", data); // Menampilkan hasil respons di console

                    if (data.status === 'found') {
                        // Isi form dengan data dari server
                        document.getElementById('nama').value = data.name;
                        document.getElementById('nis').value = data.nis;
                        document.getElementById('rayon').value = data.rayon;
                        document.getElementById('rombel').value = data.rombel;

                        // Simpan gambar yang sudah diambil ke input hidden
                        document.getElementById('image').value = base64Image;

                        // Tampilkan tombol simpan
                        document.getElementById('saveButton').classList.remove('hidden');
                    } else {
                        alert('Wajah tidak ditemukan');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
@endsection