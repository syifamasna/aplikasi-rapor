<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\SchoolProfileController as AdminSchoolProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// ===========================================
// Rute Login (umum untuk semua pengguna)
// ===========================================
Route::middleware('web')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

// ===========================================
// Rute Admin
// ===========================================
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::group(['middleware' => function ($request, $next) {
        if (Auth::user()->role !== 'Admin') {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }], function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Rute untuk update data sekolah
        Route::get('school_profiles', [AdminSchoolProfileController::class, 'index'])->name('admin.school_profiles.index');
        Route::get('school_profiles/{id}/edit', [AdminSchoolProfileController::class, 'edit'])->name('admin.school_profiles.edit');
        Route::put('school_profiles/{id}', [AdminSchoolProfileController::class, 'update'])->name('admin.school_profiles.update');
        Route::post('school_profiles/{id}/upload-logo', [AdminSchoolProfileController::class, 'uploadLogo'])->name('admin.school_profiles.uploadLogo');
        Route::delete('school_profiles/{id}/delete-logo', [AdminSchoolProfileController::class, 'deleteLogo'])->name('admin.school_profiles.deleteLogo');
    });
});