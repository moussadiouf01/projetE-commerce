<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return view('admin.login');
})->name('login');

// Routes Admin Auth
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [AuthController::class, 'dashboard'])->middleware('auth:admin')->name('dashboard');
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class);

    // Routes pour la gestion des commandes
    Route::middleware('auth:admin')->group(function () {
        Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
        Route::get('orders/{order}/invoice', [OrderController::class, 'downloadInvoice'])->name('orders.invoice');

        // Routes pour la gestion des utilisateurs
        Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::get('users/{user}', [\App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
        // Statistiques
        Route::get('stats', [\App\Http\Controllers\Admin\StatsController::class, 'index'])->name('stats.index');
        Route::get('notifications', function() {
            $notifications = auth('admin')->user()->notifications()->latest()->take(20)->get();
            return view('admin.notifications.index', compact('notifications'));
        })->name('notifications');
        Route::post('notifications/{id}/read', function($id) {
            $notification = auth('admin')->user()->notifications()->findOrFail($id);
            $notification->markAsRead();
            return back();
        })->name('notifications.read');
    });
});
