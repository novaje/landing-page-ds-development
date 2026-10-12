<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard-sport', [DashboardController::class, 'DashboardAdmin'])->name('dashboard');