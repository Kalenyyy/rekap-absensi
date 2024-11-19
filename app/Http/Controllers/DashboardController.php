<?php

namespace App\Http\Controllers;

use App\Models\siswa;
use App\Models\rombel;
use App\Models\absensi;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard()
    {

        $rombels = rombel::all();

        // Mendapatkan total count dari seluruh siswa
        $totalSiswa = siswa::count();

        // Mendapatkan count siswa yang sudah absen hari ini
        $countSiswaAbsenToday = absensi::whereDate('tanggal', now()->format('Y-m-d'))->count();

        // Menghitung siswa yang belum absen hari ini
        $countSiswaBelumAbsenToday = $totalSiswa - $countSiswaAbsenToday;

        // Mendefinisikan range tanggal (4 hari kebelakang dan 2 hari kedepan)
        $startDate = now()->subDays(4)->startOfDay();
        $endDate = now()->addDays(2)->endOfDay();

        // Ambil data absensi dan hitung jumlah per tanggal
        $absensiData = absensi::whereBetween('tanggal', [$startDate, $endDate])
            ->selectRaw('DATE(tanggal) as tanggal, COUNT(id) as jumlah_absen')
            ->groupByRaw('DATE(tanggal)')
            ->orderBy('tanggal', 'ASC')
            ->get();



        //dd($absensiData);

        // Ubah data menjadi array key-value: tanggal => jumlah_absen
        $absensiDataByDate = $absensiData->pluck('jumlah_absen', 'tanggal')->toArray();

        // dd($absensiData);


        return view('dashboard.index', compact(
            'totalSiswa',
            'rombels',
            'countSiswaAbsenToday',
            'countSiswaBelumAbsenToday',
            'absensiData' // kirim data absensi ke view
        ));
    }

    public function getDataSiswaBelumAbsen(Request $request)
    {
        $search = $request->input('search');
        $rombel = $request->input('rombel');

        // Dapatkan tanggal hari ini
        $today = now();

        // Query dasar untuk siswa
        $query = siswa::query();

        // Filter pencarian nama siswa
        if ($search) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
        }

        // Filter berdasarkan rombel
        if ($rombel && $rombel !== '') {
            $query->where('rombel', $rombel);
        }

        // Ambil ID siswa yang sudah absen hari ini
        $siswaSudahAbsen = absensi::whereDate('tanggal', $today)->pluck('id_siswa')->toArray();

        // Saring siswa yang belum absen
        $query->whereNotIn('id', $siswaSudahAbsen);

        // Mengurutkan data berdasarkan rombel dan nama
        $query->orderBy('rombel', 'asc')->orderBy('name', 'asc');

        // Paginate hasilnya
        $data_siswas = $query->paginate(8);

        // Dapatkan semua data rombel untuk filter
        $rombels = rombel::all();

        return view('dashboard.belum-absen', [
            'data_siswas' => $data_siswas,
            'rombels' => $rombels,
        ]);
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
            'data' => view('partials.student_not_absen', compact('data_siswas'))->render(),
        ]);
    }

    public function dataAbsen(Request $request)
    {
        $rombels = rombel::all();

        // Ambil input pencarian
        $search = $request->input('search');
        $rombel = $request->input('rombel');

        // Query untuk mendapatkan data absensi hari ini
        $query = absensi::whereDate('tanggal', now()->format('Y-m-d'));

        // Jika ada input 'search', filter berdasarkan nama siswa dengan case-insensitive
        if ($search) {
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
            });
        }

        // Jika ada input 'rombel', filter berdasarkan rombel dengan case-insensitive
        if ($rombel) {
            $query->whereHas('siswa', function ($q) use ($rombel) {
                $q->whereRaw('LOWER(rombel) = ?', [strtolower($rombel)]);
            });
        }

        // Ambil data dengan pagination
        $getAllSiswaAbsenToday = $query->paginate(5);

        // Kirim data ke view
        return view('dashboard.absen-today', compact('rombels', 'getAllSiswaAbsenToday'));
    }

    public function searchAbsenToday(Request $request)
    {
        $search = $request->input('search');
        $rombel = $request->input('rombel');

        // Query untuk mendapatkan data absensi hari ini
        $query = absensi::whereDate('tanggal', now()->format('Y-m-d'));

        if ($search) {
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($search) . '%']);
            });
        }

        if ($rombel) {
            $query->whereHas('siswa', function ($q) use ($rombel) {
                $q->whereRaw('LOWER(rombel) = ?', [strtolower($rombel)]);
            });
        }

        $getAllSiswaAbsenToday = $query->get();

        // Kembalikan partial view dengan data yang difilter
        return view('partials.student_absen_today', compact('getAllSiswaAbsenToday'))->render();
    }
}
