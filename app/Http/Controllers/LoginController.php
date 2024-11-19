<?php

namespace App\Http\Controllers;

use App\Models\login;
use App\Models\siswa;
use App\Models\rombel;
use App\Models\absensi;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        //menghapus sesion atau login (auth)
        Auth::logout();
        //setelah di hapus di arahkan ke login
        return redirect()->route('login');
    }
    public function loginAuth(Request $request)
    {
        //validasi
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        //ambil value dari input dan simpan sebuah variable
        $user = $request->only(['email', 'password']);

        if (Auth::attempt($user)) {
            return redirect()->route('index')->with('Success', 'Selamat Datang ' . Auth::user()->username);
        } else {
            return redirect()->back()->with('failed', 'Username dan Password tidak sesuai. Silahkan coba lagi');
        }
    }


    
}
