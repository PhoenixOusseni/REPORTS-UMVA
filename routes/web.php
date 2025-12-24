<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GroupeController;
use App\Http\Controllers\RapportGroupeController;
use App\Http\Controllers\RapportKasController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RapportMaController;

Route::get('/', [PageController::class, 'auth'])->name('login');
Route::post('connexion', [AuthController::class, 'login_admin'])->name('login_admin');
Route::post('deconnexion', [AuthController::class, 'logout'])->name('logout');

// Routes protégées
Route::middleware('auth')->group(function () {
    Route::get('admin_dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('dashboard_ka', [PageController::class, 'dashboard_ka'])->name('dashboard_ka');
    Route::get('dashboard_ma', [PageController::class, 'dashboard_ma'])->name('dashboard_ma');
    Route::get('dashboard_fp', [PageController::class, 'dashboard_fp'])->name('dashboard_fp');

    // Groupes details
    Route::get('groupes/details_groupes', [PageController::class, 'detail_groupes'])->name('groupes.detail_groupes');
    Route::get('kas/details_kas', [PageController::class, 'detail_kas'])->name('ka.detail_kas');
    Route::get('mas/details_mas', [PageController::class, 'detail_mas'])->name('ma.detail_mas');

    // Gestion des groupes
    Route::resource('groupes/gestions_groupes', GroupeController::class);

    // Gestion des rapports des groupes
    Route::resource('rapports/gestions_rapports_groupes', RapportGroupeController::class);

    // Gestion des rapports KA
    Route::resource('rapports/gestions_rapports_ka', RapportKasController::class);

    // Gestion des rapports MA
    Route::resource('rapports/gestions_rapports_ma', App\Http\Controllers\RapportMasController::class);
    Route::resource('rapports/gestions_rapports_fp', App\Http\Controllers\RapportFpsController::class);

    Route::get(
        'users/gestions_utilisateurs/{id}/ma-rapports',
        [UserController::class, 'showMa']
    )->name('gestions_utilisateurs.show_ma');

    Route::get(
        'users/gestions_utilisateurs/{id}/ka-rapports',
        [UserController::class, 'showKa']
    )->name('gestions_utilisateurs.show_ka');

    Route::get('users/gestions_utilisateurs/{id}/fp-rapports', [UserController::class, 'showFp'])->name('gestions_utilisateurs.show_fp');

    // Gestion des utilisateurs
    Route::resource('users/gestions_utilisateurs', UserController::class);
});
