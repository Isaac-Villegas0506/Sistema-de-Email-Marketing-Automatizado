<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CampaignController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Rutas de campañas con protección de tasa: máximo 10 por hora
Route::resource('campaigns', CampaignController::class)
    ->middleware('throttle:10,60');
