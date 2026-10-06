<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ProjectAreaController;
use App\Http\Controllers\Api\WorkController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\PersonalFundController;
use App\Http\Controllers\Api\ProgressUpdateController;
use App\Http\Controllers\Api\DocumentationController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ArAssetController;
use App\Http\Controllers\Api\ArDesignController;
use App\Http\Controllers\Api\ArDesignItemController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

// =========================
// TEST API
// =========================

Route::get('/test', function () {
    return response()->json([
        'success' => true,
        'message' => 'API RuangKita berhasil terhubung.',
    ]);
});

// =========================
// AUTHENTICATION
// =========================

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// =========================
// AUTHENTICATED API
// =========================

Route::middleware('auth:sanctum')->group(function () {

    // User
    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Projects
    Route::apiResource('projects', ProjectController::class);
    // Project Areas
    Route::apiResource('project-areas', ProjectAreaController::class);
    // Works
    Route::apiResource('works', WorkController::class);
    Route::get('works/{work}/download', [WorkController::class, 'download']);
    // Schedules
    Route::apiResource('schedules', ScheduleController::class);
    // Materials
    Route::apiResource('materials', MaterialController::class);
    // Expenses
    Route::apiResource('expenses', ExpenseController::class);
    // Personal Funds
    Route::apiResource('personal-funds', PersonalFundController::class);
    // Progress Updates
    Route::apiResource('progress-updates', ProgressUpdateController::class);
    // Documentation
    Route::apiResource('documentations', DocumentationController::class);
    // Messages
    Route::apiResource('messages', MessageController::class);
    // Notifications
    Route::apiResource('notifications', NotificationController::class);
    // AR Assets
    Route::apiResource('ar-assets', ArAssetController::class);
    // AR Designs
    Route::apiResource('ar-designs', ArDesignController::class);
    // AR Design Items
    Route::apiResource('ar-design-items', ArDesignItemController::class);
});
