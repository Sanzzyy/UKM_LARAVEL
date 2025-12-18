<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.post');

    // Register
    Route::get('/register', [RegisterController::class, 'show'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'store'])
        ->name('register.post');
});

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Dashboard (admin & kasir)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Menu Management (admin only)
    Route::middleware('role:admin')->group(function () {
        Route::resource('menus', MenuController::class);
    });

    // Transactions (admin & kasir)
    Route::middleware('role:admin,kasir')->group(function () {
        Route::resource('transactions', TransactionController::class)
            ->only(['index', 'create', 'store', 'show']);
    });
});
