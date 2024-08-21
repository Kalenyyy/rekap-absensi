<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Face Recognition</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.css" rel="stylesheet" />
    <style>
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .fade-in {
            animation: fadeIn 1.5s ease-in-out;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-gray-100 fade-in">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-screen-lg h-[90vh] flex flex-col">
        <div class="text-center border-b-2 border-[#667BC3] pb-4">
            <h1 class="text-4xl font-bold text-[#667BC3]">ABSENSI FACE RECOGNITION</h1>
            <p class="text-xl font-medium text-[#667BC3]">SMK WIKRAMA BOGOR</p>
        </div>
        <div class="text-center mt-6 mb-4">
            <h2 class="text-2xl font-bold text-[#667BC3]">LABORATORIUM PPLG</h2>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 flex-grow">
            @foreach($ip_camera->take(6) as $camera)
            <a href="{{ route('camera.ruangan', ['id' => $camera->id]) }}" class="bg-[#667BC3] text-white text-3xl font-bold rounded-lg flex items-center justify-center h-40 transform transition-transform duration-300 hover:scale-105">
                {{ $camera->nama_ruangan }}
            </a>
            @endforeach
        </div>
    </div>
</body>
</html>
