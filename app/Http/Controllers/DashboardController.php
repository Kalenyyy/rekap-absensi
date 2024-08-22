<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function gen20()
    {
        return view('admin.dashboard.gen20');
    }
    public function gen21()
    {
        return view('admin.dashboard.gen21');
    }
    public function gen22()
    {
        return view('admin.dashboard.gen22');
    }
}
