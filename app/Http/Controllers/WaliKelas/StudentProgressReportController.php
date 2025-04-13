<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\GradeDetail;
use App\Models\Note;
use App\Models\SchoolProfile;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class StudentProgressReportController extends Controller
{
    public function index()
    {
        $student_classes = StudentClass::where('wali_kelas_id', auth()->id())
            ->with('students')
            ->orderBy('nama')
            ->get();

        return view('wali-kelas-pages.student_progress_reports.index', compact('student_classes'));
    }

    public function students($class_id)
    {
        $class = StudentClass::where('id', $class_id)
            ->where('wali_kelas_id', auth()->id())
            ->with('students')
            ->firstOrFail();

        $students = $class->students;

        return view('wali-kelas-pages.student_progress_reports.students', compact('class', 'students'));
    }

    public function show($class_id, $student_id)
    {
        // Ambil kelas berdasarkan ID dan wali kelas yang sedang login
        $class = StudentClass::where('id', $class_id)
            ->where('wali_kelas_id', auth()->id())
            ->firstOrFail();

        // Ambil data siswa berdasarkan ID dan kelas yang sesuai
        $student = Student::where('id', $student_id)
            ->where('class_id', $class_id)
            ->firstOrFail();

        // Ambil daftar tahun ajaran yang tersedia
        $schoolYears = SchoolYear::whereIn('semester', ['Tengah Semester I (Satu)', 'Tengah Semester II (Dua)'])
            ->orderBy('tahun_awal', 'desc')
            ->get();

        $schoolYear = SchoolYear::where('id', request('school_year_id', optional($schoolYears->first())->id))
            ->first();

        // Ambil mata pelajaran yang masuk dalam kategori 'Mata Pelajaran Wajib' atau 'Muatan Lokal'
        $subjects = Subject::whereIn('kelompok_mapel', ['Mata Pelajaran Wajib', 'Muatan Lokal'])->get();

        // Ambil nilai dari siswa untuk setiap mata pelajaran yang diambil pada tahun ajaran tertentu
        $grades = Grade::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id ?? null)
            ->with('subject')
            ->get();

        // Ambil detail nilai (target, capaian, dan aplikasi_program) untuk grade tertentu
        $gradeDetails = GradeDetail::whereIn('grade_id', $grades->pluck('id'))->get();

        // Ambil data ketidakhadiran siswa untuk tahun ajaran yang dipilih
        $attendances = Attendance::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id ?? null)
            ->first();

        // Kembalikan view dengan data yang diperlukan
        return view('wali-kelas-pages.student_progress_reports.show', compact(
            'class', 'student', 'grades', 'subjects', 'gradeDetails',
            'schoolYears', 'schoolYear', 'attendances'
        ));        
    }
    
    public function exportPdf($class_id, $student_id, Request $request)
    {
        $class = StudentClass::findOrFail($class_id);
        $student = Student::findOrFail($student_id);
        $schoolProfile = SchoolProfile::first();

        // Ambil school_year_id dari request, atau fallback ke yang terbaru jika tidak ada
        $schoolYearId = $request->school_year_id;

        if ($schoolYearId) {
            $schoolYear = SchoolYear::findOrFail($schoolYearId);
        } else {
            // fallback: ambil yang tengah semester I atau II terbaru
            $schoolYear = SchoolYear::whereIn('semester', ['Tengah Semester I (Satu)', 'Tengah Semester II (Dua)'])
                ->orderBy('tahun_awal', 'desc')
                ->first();
        }

        $subjects = Subject::whereIn('kelompok_mapel', ['Mata Pelajaran Wajib', 'Muatan Lokal'])->get();

        $grades = Grade::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id)
            ->with('subject')
            ->get();

        $gradeDetails = GradeDetail::whereIn('grade_id', $grades->pluck('id'))->get();

        $attendances = Attendance::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id)
            ->first();

        $pdf = Pdf::loadView('wali-kelas-pages.student_progress_reports.show-pdf', compact(
            'class', 'student', 'grades', 'subjects', 'gradeDetails',
            'schoolYear', 'schoolProfile', 'attendances'
        ));

        $filename = 'LPS_' . Str::slug($student->nama) . '_' . $schoolYear->tahun_awal . '_' . $schoolYear->tahun_akhir . '_' . $schoolYear->semester . '.pdf';

        return $pdf->stream($filename);
    }

}