<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CampaignController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('campaigns', CampaignController::class);
