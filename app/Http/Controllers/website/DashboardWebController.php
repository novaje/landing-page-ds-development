<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardWebController extends Controller
{
     public function dashboardWebsite()
    {
        return view('website.dashboard-website');
    }
}
