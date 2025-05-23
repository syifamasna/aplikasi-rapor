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

class StudentReportController extends Controller
{
    public function index()
    {
        $student_classes = StudentClass::with('students')
            ->orderBy('nama')
            ->get();

        return view('admin-pages.student_reports.index', compact('student_classes'));
    }

    public function students($class_id)
    {
        $class = StudentClass::findOrFail($class_id);
        $students = $class->students;

        return view('admin-pages.student_reports.students', compact('class', 'students'));
    }

    public function show($class_id, $student_id)
    {
        $class = StudentClass::findOrFail($class_id);

        // Ambil data siswa berdasarkan ID dan kelas yang sesuai
        $student = Student::where('id', $student_id)
            ->where('class_id', $class_id)
            ->firstOrFail();

        // Ambil daftar tahun ajaran yang tersedia
        $schoolYears = SchoolYear::whereIn('semester', ['I (Satu)', 'II (Dua)'])
            ->orderBy('tahun_awal', 'desc')
            ->get();

        $schoolYear = SchoolYear::where('id', request('school_year_id', optional($schoolYears->first())->id))
            ->first();

        // Ambil mata pelajaran yang masuk dalam kategori 'Mata Pelajaran Wajib' atau 'Muatan Lokal'
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

        // Ambil nilai dari siswa untuk setiap mata pelajaran yang diambil pada tahun ajaran tertentu
        $grades = Grade::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id ?? null)
            ->with('subject')
            ->get();

        // Ambil detail nilai (target, capaian, dan aplikasi_program) untuk grade tertentu
        $gradeDetails = GradeDetail::whereIn('grade_id', $grades->pluck('id'))->get();

        // Ambil data prestasi siswa untuk tahun ajaran yang dipilih
        $achievements = Achievement::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id ?? null)
            ->get();

        // Ambil data ketidakhadiran siswa untuk tahun ajaran yang dipilih
        $attendances = Attendance::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id ?? null)
            ->first();

        // Ambil catatan wali kelas (notes) untuk siswa dan tahun ajaran tertentu
        $notes = Note::where('student_id', $student->id)
        ->where('school_year_id', $schoolYear->id ?? null)
        ->first();

        // Kembalikan view dengan data yang diperlukan
        return view('admin-pages.student_reports.show', compact(
            'class', 'student', 'grades', 'subjects', 'gradeDetails',
            'schoolYears', 'schoolYear', 'attendances', 'achievements', 'notes'
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
            // fallback: ambil yang semester I atau II terbaru
            $schoolYear = SchoolYear::whereIn('semester', ['I (Satu)', 'II (Dua)'])
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

        $achievements = Achievement::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id)
            ->get();

        $attendances = Attendance::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id)
            ->first();

        $notes = Note::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id)
            ->first();

        $graduationDecision = \App\Models\GraduationDecision::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id)
            ->first();

            $pdf = Pdf::loadView('admin-pages.student_reports.show-pdf', compact(
                'class',
                'student',
                'grades',
                'subjects',
                'gradeDetails',
                'schoolYear',
                'schoolProfile',
                'attendances',
                'achievements',
                'notes',
                'graduationDecision'
            ) + ['isAll' => false]);            

        $filename = 'Rapor_' . Str::slug($student->nama) . '_' . $schoolYear->tahun_awal . '_' . $schoolYear->tahun_akhir . '_Semester ' . $schoolYear->semester . '.pdf';

        return $pdf->stream($filename);
    }
}
