<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\RapportGroupeController;
use App\Http\Controllers\RapportKasController;

Route::get('/', [PageController::class, 'auth'])->name('login');
Route::post('connexion', [AuthController::class, 'login_admin'])->name('login_admin');
Route::post('deconnexion', [AuthController::class, 'logout'])->name('logout');

// Routes protégées
Route::middleware('auth')->group(function () {
    Route::get('dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('dashboard_ka', [PageController::class, 'dashboard_ka'])->name('dashboard_ka');
    Route::get('dashboard_ma', [PageController::class, 'dashboard_ma'])->name('dashboard_ma');
    Route::get('dashboard_fp', [PageController::class, 'dashboard_fp'])->name('dashboard_fp');

    // Groupes details
    Route::get('groupes/details_groupes', [PageController::class, 'detail_groupes'])->name('groupes.detail_groupes');

    // Gestion des groupes
    Route::resource('groupes/gestions_groupes', GroupeController::class);

    // Gestion des rapports des groupes
    Route::resource('rapports/gestions_rapports_groupes', RapportGroupeController::class);

    // Gestion des rapports KA
    Route::resource('rapports/gestions_rapports_ka', RapportKasController::class);
});

