<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\absensi;
use Illuminate\Support\Facades\DB;

class PersentasiController extends Controller
{
    public function index(){

      $siswa = absensi::select(DB::raw('DATE(tanggal) as date'), DB::raw('count(*) as count'))
            ->where('status', 'Hadir')  // Filter to include only 'hadir' status
            ->groupBy('date')
            ->get();
      return view('admin.persentasi.index',compact('siswa'));
    }
}
