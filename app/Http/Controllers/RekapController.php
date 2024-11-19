<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\rombel;
use App\Models\absensi;
use App\Models\siswa;
use Illuminate\Http\Request;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $rombels = rombel::all();

        // Cek apakah ada parameter tanggal di URL
        $tanggal = $request->query('tanggal');

        // Pastikan format awal sesuai dengan input datepicker dan ubah ke format database
        $tanggalParsed = $tanggal
            ? Carbon::createFromFormat('m/d/Y', $tanggal)->format('Y-m-d')
            : Carbon::today()->format('Y-m-d');

        // Format ulang ke format teks yang diinginkan
        $tanggalTeks = Carbon::parse($tanggalParsed)->format('d F Y'); // Contoh: 17 November 2024

        // Dapatkan data siswa yang sudah absen pada tanggal yang ditentukan
        $siswaAbsens = absensi::with('siswa')->whereDate('tanggal', $tanggalParsed)->orderBy('name', 'asc')->get();

        // Ambil ID siswa yang sudah absen pada tanggal yang ditentukan
        $siswaSudahAbsenIds = absensi::whereDate('tanggal', $tanggalParsed)->pluck('id_siswa')->toArray();

        // Ambil data siswa yang belum absen dan urutkan berdasarkan name
        $getSiswaBelumAbsen = siswa::whereNotIn('id', $siswaSudahAbsenIds)
            ->orderBy('name', 'asc')
            ->get();

        // Dapatkan data jumlah siswa yang absen per rombel
        $absensiByRombel = absensi::with('siswa')
            ->whereDate('tanggal', $tanggalParsed)
            ->get()
            ->groupBy('siswa.rombel')
            ->map(function ($absensi) {
                return $absensi->count();
            });

        return view('admin.rekap.index', compact('rombels', 'siswaAbsens', 'tanggalTeks', 'getSiswaBelumAbsen', 'absensiByRombel'));
    }
}
