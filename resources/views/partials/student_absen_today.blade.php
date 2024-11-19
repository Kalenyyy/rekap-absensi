@foreach ($getAllSiswaAbsenToday as $siswa)
    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden mt-4">
        <!-- Tombol Collapse -->
        <button
            class="w-full p-4 text-left text-purple-700 font-semibold flex justify-between items-center bg-purple-100 hover:bg-purple-200 transition duration-300"
            onclick="toggleCollapsible('{{ $siswa['id'] }}')">
            <span>{{ $siswa['name'] }} / {{ $siswa['siswa']['rombel'] }} / {{ $siswa['siswa']['rayon'] }}</span>
            <span>&#9660;</span> <!-- Dropdown Arrow -->
        </button>
        <!-- Collapsible Content -->
        <div id="{{ $siswa['id'] }}"
            class="px-6 pb-4 overflow-hidden transition-[max-height] duration-500 ease-in-out max-h-0">
            <div class="flex items-start mt-4 space-x-4">
                <!-- Informasi Siswa -->
                <div class="text-gray-600 flex-1 space-y-2">
                    <p><strong class="text-gray-900">NIS:</strong> {{ $siswa['siswa']['nis'] }}</p>
                    <p><strong class="text-gray-900">Rayon:</strong> {{ $siswa['siswa']['rayon'] }}</p>
                    <p><strong class="text-gray-900">Rombel:</strong> {{ $siswa['siswa']['rombel'] }}</p>
                </div>
                <!-- Gambar Siswa -->
                <div class="w-32 h-32">
                    <img class="w-full h-full object-cover rounded-md border border-gray-300"
                        src="{{ asset('storage/absensi/' . $siswa['foto_siswa']) }}" alt="Foto Siswa">
                </div>
            </div>
        </div>
    </div>
@endforeach
