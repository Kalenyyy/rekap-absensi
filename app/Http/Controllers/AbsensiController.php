<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\rombel;
use App\Models\absensi;
use Illuminate\Support\Str;
use App\Imports\SiswaImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class AbsensiController extends Controller
{
    public function indexRegister(Request $request)
    {
        $search = $request->input('search');
        $rombel = $request->input('rombel');

        // Query dasar
        $query = siswa::query();

        // Jika ada pencarian nama
        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        // Jika ada filter rombel
        if ($rombel && $rombel !== '') {
            $query->where('rombel', $rombel);
        }

        // Mengurutkan data berdasarkan rombel dan nama
        $query->orderBy('rombel', 'asc')->orderBy('name', 'asc');

        $data_siswas = $query->paginate(8);

        $rombels = rombel::all();
        return view('admin.absen.index', ['data_siswas' => $data_siswas, 'rombels' => $rombels]);
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $rombel = $request->input('rombel');

        // Query dasar
        $query = siswa::query();

        // Jika ada pencarian nama
        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        // Jika ada filter rombel
        if ($rombel && $rombel !== '') {
            $query->where('rombel', $rombel);
        }

        // Mengurutkan data berdasarkan rombel dan nama
        $query->orderBy('rombel', 'asc')->orderBy('name', 'asc');

        // Ambil hasil query
        $data_siswas = $query->paginate(8);

        // Kirim response sebagai JSON
        
        return response()->json([
            'data' => view('partials.students_list', compact('data_siswas'))->render(),
        ]);
    }

    public function importSiswa(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data imported successfully');
    }

    public function RegisterSiswa($id)
    {
        $siswa = siswa::where('id', $id)->first();
        return view('admin.absen.register', ['siswa' => $siswa]);
    }

    public function registerFace(Request $request)
    {
        $response = Http::post('http://localhost:5000/register_face', [
            'name' => $request->input('name'),
            'nis' => $request->input('nis'),
            'rayon' => $request->input('rayon'),
            'rombel' => $request->input('rombel'),
            'image' => $request->input('image')
        ]);

        return redirect()->route('admin.register.index')->with('status', $response->json('message'));
    }

    public function indexAbsen()
    {
        return view('admin.absen.absensi');
    }

    public function recognizeFace(Request $request)
    {
        // Mengirim request ke Flask
        $client = new \GuzzleHttp\Client();
        $response = $client->post('http://localhost:5001/recognize_face', [
            'json' => ['image' => $request->image]
        ]);

        return response()->json(json_decode($response->getBody(), true));
    }

    public function absenSiswa(Request $request)
    {

        // Decode the base64 image
        $imageData = $request->input('image');
        $image = base64_decode($imageData);

        // Generate a unique name for the image file
        $imageName = Str::random(10) . '.jpg';

        // Store the image in the public directory (storage/app/public)
        Storage::disk('public')->put('absensi/' . $imageName, $image);

        // Cari siswa berdasarkan NIS
        $siswa = siswa::where('nis', $request->input('nis'))->first();

        // Jika siswa ditemukan
        if ($siswa) {
            // Cek apakah sudah absen hari ini
            $today = now()->format('Y-m-d');
            $absenHariIni = Absensi::where('id_siswa', $siswa->id)
                ->whereDate('tanggal', $today)
                ->exists();

            // Jika sudah absen hari ini, kembalikan dengan pesan error
            if ($absenHariIni) {
                return redirect()->back()->with('error', 'Siswa sudah melakukan absensi hari ini.');
            }

            // Jika belum absen, buat data absensi
            absensi::create([
                'name' => $request->input('name'),
                'id_siswa' => $siswa->id,
                'tanggal' => now(),
                'status' => 'Hadir',
                'foto_siswa' => $imageName, // Simpan nama file gambar
            ]);

            return redirect()->back()->with('success', 'Absensi berhasil disimpan.');
        } else {
            return redirect()->back()->with('error', 'Siswa dengan NIS tersebut tidak ditemukan.');
        }
    }
}
