<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\SchoolProfileController as AdminSchoolProfileController;
use App\Http\Controllers\Admin\SchoolYearController as AdminSchoolYearController;
use App\Http\Controllers\Admin\StudentClassController as AdminStudentClassController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\SubjectController as AdminSubjectController;
use App\Http\Controllers\Admin\TeachingController as AdminTeachingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
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
        if (!Auth::user()->roles->contains('role', 'Admin')) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }], function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::resource('school_years', AdminSchoolYearController::class)->names('admin.school_years');
        Route::resource('student_classes', AdminStudentClassController::class)->names('admin.student_classes');
        Route::resource('students', AdminStudentController::class)->names('admin.students');
        Route::post('students/import', [AdminStudentController::class, 'import'])->name('admin.students.import');
        Route::resource('subjects', AdminSubjectController::class)->names('admin.subjects');
        Route::resource('teachings', AdminTeachingController::class)->names('admin.teachings');
        Route::resource('users', AdminUserController::class)->names('admin.users');

        // Rute untuk update profil admin
        Route::get('profile', [AdminProfileController::class, 'index'])->name('admin.profile.index');
        Route::put('profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
        Route::delete('profile/photo', [AdminProfileController::class, 'destroyImage'])->name('admin.profile.destroyImage');        

        // Rute untuk update data sekolah
        Route::get('school_profiles', [AdminSchoolProfileController::class, 'index'])->name('admin.school_profiles.index');
        Route::get('school_profiles/{id}/edit', [AdminSchoolProfileController::class, 'edit'])->name('admin.school_profiles.edit');
        Route::put('school_profiles/{id}', [AdminSchoolProfileController::class, 'update'])->name('admin.school_profiles.update');
        Route::post('school_profiles/{id}/upload-logo', [AdminSchoolProfileController::class, 'uploadLogo'])->name('admin.school_profiles.uploadLogo');
        Route::delete('school_profiles/{id}/delete-logo', [AdminSchoolProfileController::class, 'deleteLogo'])->name('admin.school_profiles.deleteLogo');
    });
});

// Guru Mapel Dashboard
Route::middleware(['auth'])->prefix('guru')->group(function () {
    Route::get('/dashboard', function () {
        return view('guru_mapel.dashboard');
    })->name('guru_mapel.dashboard');
});

// Wali Kelas Dashboard
Route::middleware(['auth'])->prefix('wali')->group(function () {
    Route::get('/dashboard', function () {
        return view('wali_kelas.dashboard');
    })->name('wali_kelas.dashboard');
});

// PJ Prestasi Dashboard
Route::middleware(['auth'])->prefix('pj')->group(function () {
    Route::get('/dashboard', function () {
        return view('pj_prestasi.dashboard');
    })->name('pj_prestasi.dashboard');
});