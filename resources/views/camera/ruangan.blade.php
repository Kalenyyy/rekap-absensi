<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Face Recognition</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .fade-in {
            animation: fadeIn 1.5s ease-in-out;
        }
    </style>
</head>
<body class="bg-[#667BC] h-screen flex items-center justify-center">

    <div class="bg-[#6779BC] w-full h-full rounded-lg p-8 text-white fade-in">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold">ABSENSI FACE RECOGNITION</h1>
            <p class="text-lg mt-2">SMK WIKRAMA BOGOR</p>
        </div>

        <!-- Content -->
        <div class="grid grid-cols-2 gap-8">
            <!-- Camera Section -->
            <div class="bg-black h-96 flex items-center justify-center transform transition-transform duration-500 hover:scale-105">
                <!-- Camera Feed -->
                <iframe src="http://{{ $camera->ip }}:8080" class="w-full h-full"></iframe>

            </div>

            <!-- Photo Result Section -->
            <div>
                <div class="bg-white h-96 flex items-center justify-center transform transition-transform duration-500 hover:scale-105">
                    <img src="" alt="Student Photo" class="w-full h-full object-cover"> <!-- Display student's photo -->
                </div>
                <div class="text-center mt-8 space-y-5 fade-in">
                    <p class="text-lg">Nama Siswa: {{ $latestStudent->nama}}</p>
                    <p class="text-lg">Rombel: {{ $latestStudent->id_rombel}}</p>
                    <p class="text-lg">Ruangan: {{ $latestStudent->nis}}</p>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="text-center mt-8">
            <button class="bg-[#5A6ABF] text-white py-2 px-4 rounded transform transition-transform duration-500 hover:scale-110 hover:animate-bounce" onclick="history.back()">Back</button>
        </div>
    </div>

</body>
</html>
