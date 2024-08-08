<?php

namespace App\Http\Controllers;

use App\Models\login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(){
        //menghapus sesion atau login (auth)
        Auth::logout();
        //setelah di hapus di arahkan ke login
        return redirect()->route('login');
    }
    public function loginAuth(Request $request)
    {
        //validasi
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            ]);
            //ambil value dari input dan simpan sebuah variable
            $user = $request->only(['username','password']);
    
    
            //
            if (Auth::attempt($user)) {
                return redirect('index');
            }else{
                return redirect()->back()->with('failed', 'username dan Password tidak sesuai. silahkan coba lagi');
            }
    }

    public function index()
    {
        //panggil data yang mau di tampilkan 
        

        //html yang di munculkan di index.balde.php folder user, lalu kirim data yang di ambil malalui (isi compact dengan nama variabel)
        return view('welcome');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\login  $login
     * @return \Illuminate\Http\Response
     */
    public function show(login $login)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\login  $login
     * @return \Illuminate\Http\Response
     */
    public function edit(login $login)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\login  $login
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, login $login)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\login  $login
     * @return \Illuminate\Http\Response
     */
    public function destroy(login $login)
    {
        //
    }
}
