<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\BerandaWebsite;
use Illuminate\Http\Request;

class DashboardWebController extends Controller
{
     public function dashboardWebsite()
    {
        $dt_beranda = BerandaWebsite::first();
        return view('website.dashboard-website', compact('dt_beranda'));
    }
}
