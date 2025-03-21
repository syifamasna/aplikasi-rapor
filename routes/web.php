<?php

use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\AchievementController as AdminAchievementController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\SchoolProfileController as AdminSchoolProfileController;
use App\Http\Controllers\Admin\SchoolYearController as AdminSchoolYearController;
use App\Http\Controllers\Admin\StudentClassController as AdminStudentClassController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\SubjectController as AdminSubjectController;
use App\Http\Controllers\Admin\TeachingController as AdminTeachingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

use App\Http\Controllers\WaliKelas\AttendanceController as WaliKelasAttendanceController;
use App\Http\Controllers\WaliKelas\DashboardController as WaliKelasDashboardController;
use App\Http\Controllers\WaliKelas\ProfileController as WaliKelasProfileController;
use App\Http\Controllers\WaliKelas\StudentClassController as WaliKelasStudentClassController;
use App\Http\Controllers\WaliKelas\StudentController as WaliKelasStudentController;

use App\Http\Controllers\PjPrestasi\AchievementController as PjPrestasiAchievementController;
use App\Http\Controllers\PjPrestasi\DashboardController as PjPrestasiDashboardController;
use App\Http\Controllers\PjPrestasi\ProfileController as PjPrestasiProfileController;

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

        Route::resource('achievements', AdminAchievementController::class)->names('admin.achievements');
        Route::get('achievements/class/{class_id}/student/{student_id}', [AdminAchievementController::class, 'show'])->name('admin.achievements.show');
        Route::get('achievements/students/{class_id}', [AdminAchievementController::class, 'studentIndex'])->name('admin.achievements.students');
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



// ===========================================
// Rute Wali Kelas
// ===========================================
Route::middleware(['auth'])->prefix('wali')->group(function () {
    Route::group(['middleware' => function ($request, $next) {
        if (!Auth::user()->roles->contains('role', 'Wali Kelas')) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }], function () {
        Route::get('/dashboard', [WaliKelasDashboardController::class, 'index'])->name('wali_kelas.dashboard');

        Route::resource('attendances', WaliKelasAttendanceController::class)->names('wali_kelas.attendances')->except(['show']);
        Route::get('attendances/students', [WaliKelasAttendanceController::class, 'studentIndex'])->name('wali_kelas.attendances.students');
        Route::resource('student_classes', WaliKelasStudentClassController::class)->names('wali_kelas.student_classes')->except(['show']);
        Route::get('student_classes/students', [WaliKelasStudentClassController::class, 'studentIndex'])->name('wali_kelas.student_classes.students');
        Route::resource('students', WaliKelasStudentController::class)->names('wali_kelas.students');

        // Rute untuk update profil wali kelas
        Route::get('profile', [WaliKelasProfileController::class, 'index'])->name('wali_kelas.profile.index');
        Route::put('profile', [WaliKelasProfileController::class, 'update'])->name('wali_kelas.profile.update');
        Route::delete('profile/photo', [WaliKelasProfileController::class, 'destroyImage'])->name('wali_kelas.profile.destroyImage');        
    });
});



// ===========================================
// Rute Pj Prestasi
// ===========================================

Route::middleware(['auth'])->prefix('pj')->group(function () {
    Route::group(['middleware' => function ($request, $next) {
        if (!Auth::user()->roles->contains('role', 'Pj Prestasi')) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }], function () {
        Route::get('/dashboard', [PjPrestasiDashboardController::class, 'index'])->name('pj_prestasi.dashboard');

        Route::resource('achievements', PjPrestasiAchievementController::class)->names('pj_prestasi.achievements');
        Route::get('achievements/class/{class_id}/student/{student_id}', [PjPrestasiAchievementController::class, 'show'])->name('pj_prestasi.achievements.show');
        Route::get('achievements/students/{class_id}', [PjPrestasiAchievementController::class, 'studentIndex'])->name('pj_prestasi.achievements.students');
    
        // Rute untuk update profil pj prestasi
        Route::get('profile', [PjPrestasiProfileController::class, 'index'])->name('pj_prestasi.profile.index');
        Route::put('profile', [PjPrestasiProfileController::class, 'update'])->name('pj_prestasi.profile.update');
        Route::delete('profile/photo', [PjPrestasiProfileController::class, 'destroyImage'])->name('pj_prestasi.profile.destroyImage');        
    });
});

// Guru Mapel Dashboard
Route::middleware(['auth'])->prefix('guru')->group(function () {
    Route::get('/dashboard', function () {
        return view('guru_mapel.dashboard');
    })->name('guru_mapel.dashboard');
});
