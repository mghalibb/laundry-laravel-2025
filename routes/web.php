<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\PickupController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/auth.php';

Route::middleware(['auth'])->group(function () {
    // --- USERS ---
    Route::resource('users', UserController::class);
    // --- USERS ---

    // --- LEVEL ---
    Route::resource('levels', LevelController::class);
    // --- LEVEL ---

    // --- ASSIGN ROLE ---
    Route::post('levels/assign/{user}', [LevelController::class, 'assignLevel'])->name('levels.assign');
    // --- ASSIGN ROLE ---

    // --- RECYCLE BIN ---
    Route::get('users-trash', [UserController::class, 'trash'])->name('users.trash');
    Route::put('users/{id}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::delete('users/{id}/force-delete', [UserController::class, 'forceDelete'])->name('users.forceDelete');
    // --- RECYCLE BIN ---

    // --- CUSTOMERS ---
    Route::resource('customers', CustomerController::class);
    // --- CUSTOMERS ---

    // --- SERVICES ---
    Route::resource('services', ServiceController::class);
    // --- SERVICES ---

    // --- TRANSACTION ---
    Route::resource('transactions', TransactionController::class);
    // --- TRANSACTION ---

    // --- PICKUP ---
    Route::resource('pickups', PickupController::class)->only(['index', 'store']);
    // --- PICKUP ---

    // --- REPORTS ---
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/print', [ReportController::class, 'print'])->name('reports.print');
    // --- REPORTS ---

    // --- MENUS ---
    Route::resource('menus', MenuController::class);
    // --- MENUS ---
});

// --- GRUP ROUTING CONTROLLER ---
Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get('', [RoutingController::class, 'index'])->name('root');
    Route::get('/index', [DashboardController::class, 'index'])->name('index');
    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class, 'root'])->name('any');
});
// --- GRUP ROUTING CONTROLLER ---
