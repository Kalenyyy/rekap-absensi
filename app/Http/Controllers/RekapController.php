<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;
use App\Models\siswa;
use App\Models\User;
use App\Models\absensi;

class RekapController extends Controller
{
    public function index(){
    
        return view('admin.rekap.index');
    }
    public function bulanan(){

        $rombels = siswa::distinct('rombel')->count('rombel');

        $siswa = siswa::count();
        $guru = User::count();
        $ruangan = Ruangan::all();

        $jumlah = absensi::whereDate('tanggal', today())
        ->where('status', 'Hadir')
        ->count();
        
        // return $jumlah;
    
        return view('admin.rekap.bulanan',compact('jumlah','rombels','siswa','guru','ruangan'));
    }
}
