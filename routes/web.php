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

// For storage link
Route::get('/link', function () {
    $targetFolder = storage_path('app/public');
    $linkFolder = $_SERVER['DOCUMENT_ROOT'] . '/storage';
    symlink($targetFolder, $linkFolder);
});

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
    Route::get('rapports/gestions_rapports_groupes/{id}/download', [App\Http\Controllers\RapportGroupeController::class, 'download'])->name('gestions_rapports_groupes.download');

    // Gestion des rapports KA
    Route::resource('rapports/gestions_rapports_ka', RapportKasController::class);
    Route::get('rapports/gestions_rapports_ka/{id}/download', [App\Http\Controllers\RapportKasController::class, 'download'])->name('gestions_rapports_ka.download');

    // Gestion des rapports MA
    Route::resource('rapports/gestions_rapports_ma', App\Http\Controllers\RapportMasController::class);
    Route::get('rapports/gestions_rapports_ma/{id}/download', [App\Http\Controllers\RapportMasController::class, 'download'])->name('gestions_rapports_ma.download');

    Route::resource('rapports/gestions_rapports_fp', App\Http\Controllers\RapportFpsController::class);
    Route::get('rapports/gestions_rapports_fp/{id}/download', [App\Http\Controllers\RapportFpsController::class, 'download'])->name('gestions_rapports_fp.download');

    Route::get('users/gestions_utilisateurs/{id}/ma-rapports', [UserController::class, 'showMa'])->name('gestions_utilisateurs.show_ma');

    Route::get('users/gestions_utilisateurs/{id}/ka-rapports', [UserController::class, 'showKa'])->name('gestions_utilisateurs.show_ka');

    Route::get('users/gestions_utilisateurs/{id}/fp-rapports', [UserController::class, 'showFp'])->name('gestions_utilisateurs.show_fp');

    // Gestion des utilisateurs
    Route::resource('users/gestions_utilisateurs', UserController::class);

    // profils utilisateurs kas, mas, fp
    Route::get('profile/{id}/admin_profile', [PageController::class, 'admin_profile'])->name('admin_profile');
    Route::get('profile/{id}/ka_profile', [PageController::class, 'ka_profile'])->name('ka_profile');
    Route::get('profile/{id}/ma_profile', [PageController::class, 'ma_profile'])->name('ma_profile');
    Route::get('profile/{id}/fp_profile', [PageController::class, 'fp_profile'])->name('fp_profile');
    Route::put('profile/{id}/update-password', [UserController::class, 'updatePassword'])->name('profile.update-password');

    // Routes de recherche par plage de dates
    Route::post('profile/{id}/search-rapports-groupes', [PageController::class, 'searchRapportsGroupes'])->name('search-rapports-groupes');
    Route::post('profile/search-rapports-ka', [PageController::class, 'searchRapportsKa'])->name('search-rapports-ka');
    Route::post('profile/search-rapports-ma', [PageController::class, 'searchRapportsMa'])->name('search-rapports-ma');
    Route::post('profile/search-rapports-fp', [PageController::class, 'searchRapportsFp'])->name('search-rapports-fp');

    Route::post(
    'fp/search-rapports',
    [PageController::class, 'searchRapportsFp']
)->name('fp.search-rapports');
Route::post(
    'ka/search-rapports',
    [PageController::class, 'searchRapportsKa']
)->name('ka.search-rapports');
Route::post(
    'ma/search-rapports',
    [PageController::class, 'searchRapportsMa']
)->name('ma.search-rapports');

});
