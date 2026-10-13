<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\ClientProjectController;
use App\Http\Controllers\Admin\ArAssetController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\WorkController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\MaterialController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\PersonalFundController;

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
    // ADMIN - MENU CLIENT
    // =========================

    Route::get(
        '/admin/clients',
        [ClientController::class, 'index']
    )->name('admin.clients.index');

    Route::get(
        '/admin/clients/create',
        [ClientController::class, 'create']
    )->name('admin.clients.create');

    Route::post(
        '/admin/clients',
        [ClientController::class, 'store']
    )->name('admin.clients.store');

    Route::get(
        '/admin/clients/{client}',
        [ClientController::class, 'show']
    )->name('admin.clients.show');

    Route::get(
        '/admin/clients/{client}/edit',
        [ClientController::class, 'edit']
    )->name('admin.clients.edit');

    Route::put(
        '/admin/clients/{client}',
        [ClientController::class, 'update']
    )->name('admin.clients.update');

    Route::patch(
        '/admin/clients/{client}/toggle-status',
        [ClientController::class, 'toggleStatus']
    )->name('admin.clients.toggle-status');

    // =========================
    // ADMIN - MENU PROYEK
    // =========================

    Route::get(
        '/admin/projects',
        [ProjectController::class, 'index']
    )
        ->name('admin.projects.index');

    Route::get(
        '/admin/projects/create',
        [ProjectController::class, 'create']
    )
        ->name('admin.projects.create');

    Route::post(
        '/admin/projects',
        [ProjectController::class, 'store']
    )
        ->name('admin.projects.store');

    Route::get(
        '/admin/projects/{project}',
        [ProjectController::class, 'show']
    )
        ->name('admin.projects.show');

    Route::get(
        '/admin/projects/{project}/edit',
        [ProjectController::class, 'edit']
    )
        ->name('admin.projects.edit');

    Route::put(
        '/admin/projects/{project}',
        [ProjectController::class, 'update']
    )
        ->name('admin.projects.update');


    // =========================
    // ADMIN - MENU PEKERJAAN
    // =========================

    Route::get(
        '/admin/works',
        [WorkController::class, 'index']
    )
        ->name('admin.works.index');

    Route::get(
        '/admin/works/create',
        [WorkController::class, 'create']
    )
        ->name('admin.works.create');

    Route::post(
        '/admin/works',
        [WorkController::class, 'store']
    )
        ->name('admin.works.store');

    Route::get(
        '/admin/works/{work}',
        [WorkController::class, 'show']
    )
        ->name('admin.works.show');

    Route::get(
        '/admin/works/{work}/edit',
        [WorkController::class, 'edit']
    )
        ->name('admin.works.edit');

    Route::put(
        '/admin/works/{work}',
        [WorkController::class, 'update']
    )
        ->name('admin.works.update');

    // =========================
    // ADMIN - MENU JADWAL
    // =========================
    Route::get(
        '/admin/schedules',
        [ScheduleController::class, 'index']
    )
        ->name('admin.schedules.index');

    Route::get(
        '/admin/schedules/create',
        [ScheduleController::class, 'create']
    )
        ->name('admin.schedules.create');

    Route::post(
        '/admin/schedules',
        [ScheduleController::class, 'store']
    )
        ->name('admin.schedules.store');

    Route::get(
        '/admin/schedules/{schedule}',
        [ScheduleController::class, 'show']
    )
        ->name('admin.schedules.show');

    Route::get(
        '/admin/schedules/{schedule}/edit',
        [ScheduleController::class, 'edit']
    )
        ->name('admin.schedules.edit');

    Route::put(
        '/admin/schedules/{schedule}',
        [ScheduleController::class, 'update']
    )
        ->name('admin.schedules.update');

    // =========================
    // ADMIN - MENU MATERIAL    
    // =========================
    Route::get('/admin/materials', [MaterialController::class, 'index'])
        ->name('admin.materials.index');

    Route::get('/admin/materials/create', [MaterialController::class, 'create'])
        ->name('admin.materials.create');

    Route::post('/admin/materials', [MaterialController::class, 'store'])
        ->name('admin.materials.store');

    Route::get('/admin/materials/{material}', [MaterialController::class, 'show'])
        ->name('admin.materials.show');

    Route::get('/admin/materials/{material}/edit', [MaterialController::class, 'edit'])
        ->name('admin.materials.edit');

    Route::put('/admin/materials/{material}', [MaterialController::class, 'update'])
        ->name('admin.materials.update');

    // =========================
    //  ADMIN - PENGELUARAN
    // =========================
    Route::get('/admin/expenses', [ExpenseController::class, 'index'])
        ->name('admin.expenses.index');

    Route::get('/admin/expenses/create', [ExpenseController::class, 'create'])
        ->name('admin.expenses.create');

    Route::post('/admin/expenses', [ExpenseController::class, 'store'])
        ->name('admin.expenses.store');


    /* EXPORT - pdf} */

    Route::get('/admin/expenses/export/excel', [ExpenseController::class, 'exportExcel'])
        ->name('admin.expenses.export.excel');

    Route::get('/admin/expenses/export/pdf', [ExpenseController::class, 'exportPdf'])
        ->name('admin.expenses.export.pdf');

    Route::get('/admin/expenses/{expense}', [ExpenseController::class, 'show'])
        ->name('admin.expenses.show');

    Route::get('/admin/expenses/{expense}/edit', [ExpenseController::class, 'edit'])
        ->name('admin.expenses.edit');

    Route::put('/admin/expenses/{expense}', [ExpenseController::class, 'update'])
        ->name('admin.expenses.update');

    Route::delete('/admin/expenses/{expense}', [ExpenseController::class, 'destroy'])
        ->name('admin.expenses.destroy');



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

    // =========================
    // ADMIN - UANG PRIBADI
    // =========================

    Route::get(
        '/admin/personal-funds',
        [PersonalFundController::class, 'index']
    )->name('admin.personal-funds.index');

    Route::get(
        '/admin/personal-funds/export/excel',
        [PersonalFundController::class, 'exportExcel']
    )->name('admin.personal-funds.export.excel');

    Route::get(
        '/admin/personal-funds/export/pdf',
        [PersonalFundController::class, 'exportPdf']
    )->name('admin.personal-funds.export.pdf');

    Route::get(
        '/admin/personal-funds/{personalFund}',
        [PersonalFundController::class, 'show']
    )->name('admin.personal-funds.show');


    Route::patch(
        '/admin/personal-funds/{personalFund}/paid',
        [PersonalFundController::class, 'markAsPaid']
    )->name('admin.personal-funds.paid');


    Route::patch(
        '/admin/personal-funds/{personalFund}/unpaid',
        [PersonalFundController::class, 'markAsUnpaid']
    )->name('admin.personal-funds.unpaid');
});
