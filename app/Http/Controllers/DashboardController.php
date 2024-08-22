<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rombel;

class DashboardController extends Controller
{
    public function gen20()
    {
        $rombel = rombel::all();
        return view('admin.dashboard.gen20',compact('rombel'),compact('rombel'));
    }
    public function gen21()
    {
        $rombel = rombel::all();
        return view('admin.dashboard.gen21',compact('rombel'));
    }
    public function gen22()
    {
        $rombel = rombel::all();
        return view('admin.dashboard.gen22',compact('rombel'));
    }
}
