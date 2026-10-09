<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ClientProjectController;
use App\Http\Controllers\Admin\ArAssetController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
| Route yang bisa diakses tanpa login.
|--------------------------------------------------------------------------
*/

// HOME
Route::get('/', function () {
    return redirect()->route('login');
});


// TEST
Route::get('/test', function () {
    return 'RuangKita Website Aktif';
});

// =========================
// AUTH
// =========================

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');



/*
|--------------------------------------------------------------------------
| AUTHENTICATED ROUTES
|--------------------------------------------------------------------------
| Route di bawah ini hanya bisa diakses setelah login.
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/logout', function () {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('login');
    })->name('logout');

    // =========================
    // DASHBOARD
    // =========================

    Route::get(
        '/admin/dashboard',
        [DashboardController::class, 'admin']
    )->name('admin.dashboard');

    // =========================
    // ADMIN - AR ASSETS
    // =========================

    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {

            Route::resource(
                'ar-assets',
                ArAssetController::class
            )->except(['show']);
        });

    Route::get(
        '/client/dashboard',
        [DashboardController::class, 'client']
    )->name('client.dashboard');


    // =========================
    // CLIENT - JADWAL
    // Semua jadwal milik client
    // =========================

    Route::get(
        '/client/schedule',
        [ClientProjectController::class, 'allSchedules']
    )->name('client.schedule');


    // =========================
    // CLIENT - PROYEK
    // =========================

    Route::get(
        '/client/projects',
        [ClientProjectController::class, 'index']
    )->name('client.projects.index');


    Route::get(
        '/client/projects/{project}',
        [ClientProjectController::class, 'show']
    )->name('client.projects.show');


    // =========================
    // CLIENT - JADWAL PER PROYEK
    // =========================

    Route::get(
        '/client/projects/{project}/schedule',
        [ClientProjectController::class, 'schedule']
    )->name('client.projects.schedule');

    // =========================
    // CLIENT - PROGRESS
    // =========================

    Route::get(
        '/client/progress',
        [ClientProjectController::class, 'allProgress']
    )->name('client.progress');


    Route::get(
        '/client/projects/{project}/progress',
        [ClientProjectController::class, 'progress']
    )->name('client.projects.progress');

    // =========================
    // CLIENT - DOKUMENTASI
    // =========================

    Route::get(
        '/client/documentation',
        [ClientProjectController::class, 'documentation']
    )->name('client.documentation');

    Route::get(
        '/client/costs',
        [ClientProjectController::class, 'costs']
    )->name('client.costs');

    // =========================
    // CLIENT - PESAN
    // =========================

    Route::get(
        '/client/messages',
        [ClientProjectController::class, 'messages']
    )->name('client.messages');


    Route::post(
        '/client/messages',
        [ClientProjectController::class, 'sendMessage']
    )->name('client.messages.send');

    // =========================
    // CLIENT - AUGMENTED REALITY
    // =========================
    Route::get(
        '/client/ar',
        [ClientProjectController::class, 'ar']
    )->name('client.ar');

    // =========================
    // CLIENT - PENGATURAN
    // =========================

    Route::get(
        '/client/settings',
        [ClientProjectController::class, 'settings']
    )->name('client.settings');


    Route::put(
        '/client/settings/profile',
        [ClientProjectController::class, 'updateProfile']
    )->name('client.settings.profile');


    Route::put(
        '/client/settings/password',
        [ClientProjectController::class, 'updatePassword']
    )->name('client.settings.password');


    Route::put(
        '/client/settings/preferences',
        [ClientProjectController::class, 'updatePreferences']
    )->name('client.settings.preferences');
});
