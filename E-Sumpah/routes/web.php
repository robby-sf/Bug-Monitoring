<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController; 
use App\Http\Controllers\Auth\RegisterController; 
use App\Http\Controllers\ObjekBaruController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController; 


Route::redirect('/', '/login');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['role:user'])->group(function () {
        Route::get('/pendaftaran', [ObjekBaruController::class, 'create'])->name('pendaftaran.create');
        Route::post('/pendaftaran', [ObjekBaruController::class, 'store'])->name('pendaftaran.store');
        
        Route::get('/pendaftaran-data-baru', [ObjekBaruController::class, 'create'])->name('pendaftaran.baru');
    });

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/detail/{id}', [AdminController::class, 'show'])->name('admin.detail');
        Route::post('/admin/verifikasi/{id}', [AdminController::class, 'updateStatus'])->name('admin.verifikasi');
    });

});


// Route untuk testing error monitoring
Route::get('/tes-error-monitoring', function () {
    return $data_rahasia_bapenda; 
});

Route::get('/test-db', [DashboardController::class, 'testDb']);

Route::get('/test-bug/null', function () {
    $user = null;
    return $user->name; 
});
