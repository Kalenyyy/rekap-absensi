<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\ruangan;


class CameraController extends Controller
{
    public function index()
    {
        $ip_camera = Ruangan::all();
    
        return view('camera.index',compact('ip_camera'));
    }
  
    public function ruangan($id)
    {
        // Fetch the specific camera based on the selected room
        $camera = Ruangan::findOrFail($id);
    
        // Fetch the latest student record with the matching id_rombel (assuming you have a way to determine the id_rombel related to the room)
        $latestStudent = Siswa::where('id_rombel', 1)->latest()->first();
    
        // Return the view with the latestStudent and camera data
        return view('camera.ruangan', compact('latestStudent', 'camera'));
    }
    
    
    
    
    public function ruangan206()
    {
        $latestStudent = Siswa::where('id_rombel', 1)->latest()->first();
        return view('camera.ruangan206',compact('latestStudent'));
    }
    public function ruangan207()
    {
        $latestStudent = Siswa::where('id_rombel', 1)->latest()->first();
        return view('camera.ruangan207',compact('latestStudent'));
    }
    public function ruangan320()
    {
        $latestStudent = Siswa::where('id_rombel', 1)->latest()->first();
        return view('camera.ruangan320',compact('latestStudent'));
    }
    public function ruangan322()
    {
        $latestStudent = Siswa::where('id_rombel', 1)->latest()->first();
        return view('camera.ruangan322',compact('latestStudent'));
    }
    public function ruangan323()
    {
        $latestStudent = Siswa::where('id_rombel', 1)->latest()->first();
        return view('camera.ruangan323',compact('latestStudent'));
    }
}
