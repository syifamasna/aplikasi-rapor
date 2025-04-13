<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Admin\AchievementController as AdminAchievementController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\SchoolProfileController as AdminSchoolProfileController;
use App\Http\Controllers\Admin\SchoolYearController as AdminSchoolYearController;
use App\Http\Controllers\Admin\StudentClassController as AdminStudentClassController;
use App\Http\Controllers\Admin\StudentController as AdminStudentController;
use App\Http\Controllers\Admin\StudentProgressReportController as AdminStudentProgressReportController;
use App\Http\Controllers\Admin\ClassProgressReportController as AdminClassProgressReportController;
use App\Http\Controllers\Admin\StudentReportController as AdminStudentReportController;
use App\Http\Controllers\Admin\ClassReportController as AdminClassReportController;
use App\Http\Controllers\Admin\SubjectController as AdminSubjectController;
use App\Http\Controllers\Admin\TeachingController as AdminTeachingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

use App\Http\Controllers\WaliKelas\AttendanceController as WaliKelasAttendanceController;
use App\Http\Controllers\WaliKelas\DashboardController as WaliKelasDashboardController;
use App\Http\Controllers\WaliKelas\GraduationDecisionController as WaliKelasGraduationDecisionController;
use App\Http\Controllers\WaliKelas\NoteController as WaliKelasNoteController;
use App\Http\Controllers\WaliKelas\ProfileController as WaliKelasProfileController;
use App\Http\Controllers\WaliKelas\StudentController as WaliKelasStudentController;
use App\Http\Controllers\WaliKelas\StudentClassController as WaliKelasStudentClassController;
use App\Http\Controllers\WaliKelas\StudentProgressReportController as WaliKelasStudentProgressReportController;
use App\Http\Controllers\WaliKelas\ClassProgressReportController as WaliKelasClassProgressReportController;
use App\Http\Controllers\WaliKelas\StudentReportController as WaliKelasStudentReportController;
use App\Http\Controllers\WaliKelas\ClassReportController as WaliKelasClassReportController;

use App\Http\Controllers\GuruMapel\DashboardController as GuruMapelDashboardController;
use App\Http\Controllers\GuruMapel\ProfileController as GuruMapelProfileController;
use App\Http\Controllers\GuruMapel\GradeController as GuruMapelGradeController;
use App\Http\Controllers\GuruMapel\GradeDetailController as GuruMapelGradeDetailController;

use App\Http\Controllers\PjPrestasi\AchievementController as PjPrestasiAchievementController;
use App\Http\Controllers\PjPrestasi\DashboardController as PjPrestasiDashboardController;
use App\Http\Controllers\PjPrestasi\ProfileController as PjPrestasiProfileController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

//rute landing page
Route::get('/', [LandingPageController::class, 'index']);

//rute kontak landing page
Route::post('/contact', [ContactController::class, 'sendContact'])->name('contact.send');


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
        // Rute untuk dashboard admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Rute untuk prestasi siswa
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

        // Rute untuk Laporan Perkembangan Siswa (tampilan per siswa)
        Route::get('student_progress_reports', [AdminStudentProgressReportController::class, 'index'])->name('admin.student_progress_reports.index');
        Route::get('student_progress_reports/{class_id}/students', [AdminStudentProgressReportController::class, 'students'])->name('admin.student_progress_reports.students');
        Route::get('student_progress_reports/{class_id}/students/{student_id}', [AdminStudentProgressReportController::class, 'show'])->name('admin.student_progress_reports.show');       
        Route::get('student_progress_reports/{class_id}/students/{student_id}/export-pdf', [AdminStudentProgressReportController::class, 'exportPdf'])->name('admin.student_progress_reports.export-pdf');
        
        // Rute untuk Laporan Perkembangan Siswa (tampilan per kelas)
        Route::get('class_progress_reports', [AdminClassProgressReportController::class, 'index'])->name('admin.class_progress_reports.index');
        Route::get('class_progress_reports/{class_id}', [AdminClassProgressReportController::class, 'show'])->name('admin.class_progress_reports.show');       
        Route::get('class_progress_reports/{class_id}/export-csv', [AdminClassProgressReportController::class, 'exportCsv'])->name('admin.class_progress_reports.export-csv');
        Route::get('class_progress_reports/{class_id}/export-pdf', [AdminClassProgressReportController::class, 'exportPdf'])->name('admin.class_progress_reports.export-pdf'); 

        // Rute untuk Laporan Hasil Belajar (Rapor) Peserta Didik (tampilan per siswa)
        Route::get('student_reports', [AdminStudentReportController::class, 'index'])->name('admin.student_reports.index');
        Route::get('student_reports/{class_id}/students', [AdminStudentReportController::class, 'students'])->name('admin.student_reports.students');
        Route::get('student_reports/{class_id}/students/{student_id}', [AdminStudentReportController::class, 'show'])->name('admin.student_reports.show');       
        Route::get('student_reports/{class_id}/students/{student_id}/export-pdf', [AdminStudentReportController::class, 'exportPdf'])->name('admin.student_reports.export-pdf');
        
        // Rute untuk Laporan Hasil Belajar (Rapor) Peserta Didik (tampilan per kelas)
        Route::get('class_reports', [AdminClassReportController::class, 'index'])->name('admin.class_reports.index');
        Route::get('class_reports/{class_id}', [AdminClassReportController::class, 'show'])->name('admin.class_reports.show');       
        Route::get('class_reports/{class_id}/export-csv', [AdminClassReportController::class, 'exportCsv'])->name('admin.class_reports.export-csv');
        Route::get('class_reports/{class_id}/export-pdf', [AdminClassReportController::class, 'exportPdf'])->name('admin.class_reports.export-pdf'); 
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
        // Rute untuk dashboard wali kelas
        Route::get('/dashboard', [WaliKelasDashboardController::class, 'index'])->name('wali_kelas.dashboard');

        // Rute untuk update ketidakhadiran
        Route::resource('attendances', WaliKelasAttendanceController::class)->names('wali_kelas.attendances')->except(['show']);
        Route::get('attendances/students', [WaliKelasAttendanceController::class, 'studentIndex'])->name('wali_kelas.attendances.students');

        // Rute untuk catatan wali kelas
        Route::resource('notes', WaliKelasNoteController::class)->names('wali_kelas.notes')->except(['show']);
        Route::get('notes/students', [WaliKelasNoteController::class, 'studentIndex'])->name('wali_kelas.notes.students');

        // Rute untuk keputusan kelulusan
        Route::resource('graduation_decisions', WaliKelasGraduationDecisionController::class)->names('wali_kelas.graduation_decisions')->except(['show']);
        Route::get('graduation_decisions/students', [WaliKelasGraduationDecisionController::class, 'studentIndex'])->name('wali_kelas.graduation_decisions.students');

        // Rute untuk data kelas & siswa
        Route::resource('student_classes', WaliKelasStudentClassController::class)->names('wali_kelas.student_classes')->except(['show']);
        Route::get('student_classes/students', [WaliKelasStudentClassController::class, 'studentIndex'])->name('wali_kelas.student_classes.students');
        Route::resource('students', WaliKelasStudentController::class)->names('wali_kelas.students');

        // Rute untuk Laporan Perkembangan Siswa (tampilan per siswa)
        Route::get('student_progress_reports', [WaliKelasStudentProgressReportController::class, 'index'])->name('wali_kelas.student_progress_reports.index');
        Route::get('student_progress_reports/{class_id}/students', [WaliKelasStudentProgressReportController::class, 'students'])->name('wali_kelas.student_progress_reports.students');
        Route::get('student_progress_reports/{class_id}/students/{student_id}', [WaliKelasStudentProgressReportController::class, 'show'])->name('wali_kelas.student_progress_reports.show');       
        Route::get('student_progress_reports/{class_id}/students/{student_id}/export-pdf', [WaliKelasStudentProgressReportController::class, 'exportPdf'])->name('wali_kelas.student_progress_reports.export-pdf');
        
        // Rute untuk Laporan Perkembangan Siswa (tampilan per kelas)
        Route::get('class_progress_reports', [WaliKelasClassProgressReportController::class, 'index'])->name('wali_kelas.class_progress_reports.index');
        Route::get('class_progress_reports/{class_id}', [WaliKelasClassProgressReportController::class, 'show'])->name('wali_kelas.class_progress_reports.show');       
        Route::get('class_progress_reports/{class_id}/export-csv', [WaliKelasClassProgressReportController::class, 'exportCsv'])->name('wali_kelas.class_progress_reports.export-csv');
        Route::get('class_progress_reports/{class_id}/export-pdf', [WaliKelasClassProgressReportController::class, 'exportPdf'])->name('wali_kelas.class_progress_reports.export-pdf'); 

        // Rute untuk Laporan Hasil Belajar (Rapor) Peserta Didik (tampilan per siswa)
        Route::get('student_reports', [WaliKelasStudentReportController::class, 'index'])->name('wali_kelas.student_reports.index');
        Route::get('student_reports/{class_id}/students', [WaliKelasStudentReportController::class, 'students'])->name('wali_kelas.student_reports.students');
        Route::get('student_reports/{class_id}/students/{student_id}', [WaliKelasStudentReportController::class, 'show'])->name('wali_kelas.student_reports.show');       
        Route::get('student_reports/{class_id}/students/{student_id}/export-pdf', [WaliKelasStudentReportController::class, 'exportPdf'])->name('wali_kelas.student_reports.export-pdf');
        
        // Rute untuk Laporan Hasil Belajar (Rapor) Peserta Didik (tampilan per kelas)
        Route::get('class_reports', [WaliKelasClassReportController::class, 'index'])->name('wali_kelas.class_reports.index');
        Route::get('class_reports/{class_id}', [WaliKelasClassReportController::class, 'show'])->name('wali_kelas.class_reports.show');       
        Route::get('class_reports/{class_id}/export-csv', [WaliKelasClassReportController::class, 'exportCsv'])->name('wali_kelas.class_reports.export-csv');
        Route::get('class_reports/{class_id}/export-pdf', [WaliKelasClassReportController::class, 'exportPdf'])->name('wali_kelas.class_reports.export-pdf'); 

        // Rute untuk update profil wali kelas
        Route::get('profile', [WaliKelasProfileController::class, 'index'])->name('wali_kelas.profile.index');
        Route::put('profile', [WaliKelasProfileController::class, 'update'])->name('wali_kelas.profile.update');
        Route::delete('profile/photo', [WaliKelasProfileController::class, 'destroyImage'])->name('wali_kelas.profile.destroyImage');        
    });
});



// ===========================================
// Rute Guru Mapel
// ===========================================
Route::middleware(['auth'])->prefix('guru')->group(function () {
    Route::group(['middleware' => function ($request, $next) {
        if (!Auth::user()->roles->contains('role', 'Guru Mapel')) {
            abort(403, 'Unauthorized action.');
        }
        return $next($request);
    }], function () {
        // Rute untuk dashboard guru mapel
        Route::get('/dashboard', [GuruMapelDashboardController::class, 'index'])->name('guru_mapel.dashboard');

        // Rute untuk input nilai siswa
        Route::resource('grades', GuruMapelGradeController::class)->names('guru_mapel.grades')->except(['show']);
        Route::get('grades/students', [GuruMapelGradeController::class, 'studentIndex'])->name('guru_mapel.grades.students');
        Route::resource('grade_details', GuruMapelGradeDetailController::class)->names('guru_mapel.grade_details')->except(['show']);
        
        // Rute untuk update profil guru mapel
        Route::get('profile', [GuruMapelProfileController::class, 'index'])->name('guru_mapel.profile.index');
        Route::put('profile', [GuruMapelProfileController::class, 'update'])->name('guru_mapel.profile.update');
        Route::delete('profile/photo', [GuruMapelProfileController::class, 'destroyImage'])->name('guru_mapel.profile.destroyImage');        
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

        // Rute untuk prestasi siswa
        Route::resource('achievements', PjPrestasiAchievementController::class)->names('pj_prestasi.achievements');
        Route::get('achievements/class/{class_id}/student/{student_id}', [PjPrestasiAchievementController::class, 'show'])->name('pj_prestasi.achievements.show');
        Route::get('achievements/students/{class_id}', [PjPrestasiAchievementController::class, 'studentIndex'])->name('pj_prestasi.achievements.students');
    
        // Rute untuk update profil pj prestasi
        Route::get('profile', [PjPrestasiProfileController::class, 'index'])->name('pj_prestasi.profile.index');
        Route::put('profile', [PjPrestasiProfileController::class, 'update'])->name('pj_prestasi.profile.update');
        Route::delete('profile/photo', [PjPrestasiProfileController::class, 'destroyImage'])->name('pj_prestasi.profile.destroyImage');        
    });
});

