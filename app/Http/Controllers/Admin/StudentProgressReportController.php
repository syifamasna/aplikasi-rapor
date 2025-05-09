<?php

namespace App\Http\Controllers\Admin;

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
        $student_classes = StudentClass::with('students')
            ->orderBy('nama')
            ->get();

        return view('admin-pages.student_progress_reports.index', compact('student_classes'));
    }

    public function students($class_id)
    {
        // Ambil data kelas tanpa filter wali_kelas_id
        $class = StudentClass::where('id', $class_id)
            ->with('students')
            ->firstOrFail();

        $students = $class->students;

        return view('admin-pages.student_progress_reports.students', compact('class', 'students'));
    }

    public function show($class_id, $student_id)
    {
        // Ambil data kelas tanpa filter wali_kelas_id
        $class = StudentClass::findOrFail($class_id);

        // Ambil data siswa berdasarkan ID dan class_id
        $student = Student::where('id', $student_id)
            ->where('class_id', $class_id)
            ->firstOrFail();

        $schoolYears = SchoolYear::whereIn('semester', ['Tengah Semester I (Satu)', 'Tengah Semester II (Dua)'])
            ->orderBy('tahun_awal', 'desc')
            ->get();

        $schoolYear = SchoolYear::where('id', request('school_year_id', optional($schoolYears->first())->id))
            ->first();

        $kelas_3_6 = ['III', 'IV', 'V', 'VI'];
        $isKelas3Sampai6 = Str::startsWith($class->nama, $kelas_3_6);
            
        if ($isKelas3Sampai6) {
            $subjects = Subject::whereIn('kelompok_mapel', [
                'Mata Pelajaran Wajib (Kelas 1-6)',
                'Mata Pelajaran Wajib (Kelas 3-6)',
                'Muatan Lokal'
            ])->get();
        } else {
            $subjects = Subject::whereIn('kelompok_mapel', [
                'Mata Pelajaran Wajib (Kelas 1-6)',
                'Muatan Lokal'
            ])->get();
        }

        $grades = Grade::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id ?? null)
            ->with('subject')
            ->get();

        $gradeDetails = GradeDetail::whereIn('grade_id', $grades->pluck('id'))->get();

        $attendances = Attendance::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id ?? null)
            ->first();

        return view('admin-pages.student_progress_reports.show', compact(
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

        $kelas_3_6 = ['III', 'IV', 'V', 'VI'];
        $isKelas3Sampai6 = Str::startsWith($class->nama, $kelas_3_6);
            
        if ($isKelas3Sampai6) {
            $subjects = Subject::whereIn('kelompok_mapel', [
                'Mata Pelajaran Wajib (Kelas 1-6)',
                'Mata Pelajaran Wajib (Kelas 3-6)',
                'Muatan Lokal'
            ])->get();
        } else {
            $subjects = Subject::whereIn('kelompok_mapel', [
                'Mata Pelajaran Wajib (Kelas 1-6)',
                'Muatan Lokal'
            ])->get();
        }

        $grades = Grade::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id)
            ->with('subject')
            ->get();

        $gradeDetails = GradeDetail::whereIn('grade_id', $grades->pluck('id'))->get();

        $attendances = Attendance::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id)
            ->first();

        $pdf = Pdf::loadView('admin-pages.student_progress_reports.show-pdf', compact(
            'class', 'student', 'grades', 'subjects', 'gradeDetails',
            'schoolYear', 'schoolProfile', 'attendances'
        ) + ['isAll' => false]);

        $filename = 'LPS_' . Str::slug($student->nama) . '_' . $schoolYear->tahun_awal . '_' . $schoolYear->tahun_akhir . '_' . $schoolYear->semester . '.pdf';

        return $pdf->stream($filename);
    }
}
