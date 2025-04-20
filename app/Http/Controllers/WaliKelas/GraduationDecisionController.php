<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\GraduationDecision; 
use App\Models\SchoolYear; 
use App\Models\StudentClass;
use App\Models\Student;
use Illuminate\Http\Request;

class GraduationDecisionController extends Controller
{
    public function index()
    {
        $student_classes = StudentClass::where('wali_kelas_id', auth()->id())
            ->with('students')
            ->orderBy('nama')
            ->get();

        return view('wali-kelas-pages.graduation_decisions.index', compact('student_classes'));
    }

    public function studentIndex(Request $request)
    {
        // Ambil daftar kelas yang diampu oleh wali kelas
        $classes = StudentClass::where('wali_kelas_id', auth()->id())->get();

        // Ambil satu kelas pertama yang diampu wali kelas (jika hanya satu kelas)
        $class = $classes->first();

        // Ambil ID kelas dari request atau default ke kelas pertama
        $classId = $request->input('class_id', $class->id ?? null);

        // Ambil tahun ajar yang aktif untuk semester II (Dua)
        $schoolYears = SchoolYear::where('semester', 'II (Dua)')
        ->orderBy('tahun_awal', 'desc')
        ->get();    

        // Ambil tahun ajaran yang dipilih, default ke tahun terbaru jika tidak ada
        $schoolYearId = $request->input('school_year_id', $schoolYears->first()->id ?? null);
        $schoolYear = $schoolYears->where('id', $schoolYearId)->first();

        // Ambil semua siswa dalam kelas yang dipilih, dengan data keputusan kelulusan
        $students = Student::where('class_id', $classId)
            ->whereHas('class', function ($query) {
                $query->where('wali_kelas_id', auth()->id());
            })
            ->with(['graduationDecisions' => function ($query) use ($schoolYearId) {
                $query->where('school_year_id', $schoolYearId);
            }])
            ->orderBy('nama')
            ->get();

        // Menyusun array untuk akses cepat per student_id
        $graduation_decisions = [];
        foreach ($students as $student) {
            $decision = $student->graduationDecisions->first();
            if ($decision) {
                $graduation_decisions[$student->id] = $decision;
            }
        }

        return view('wali-kelas-pages.graduation_decisions.students', compact(
            'students', 'classes', 'class', 'schoolYears', 'schoolYear', 'graduation_decisions'
        ));
    }

    public function update(Request $request, $classId)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:student_classes,id',
            'school_year_id' => 'required|exists:school_years,id',
            'graduation_decisions.*.student_id' => 'required|exists:students,id',
            'graduation_decisions.*.status' => 'required|in:"naik/lulus","tidak naik/lulus"',
        ]);

        foreach ($validated['graduation_decisions'] as $data) {
            \App\Models\GraduationDecision::updateOrCreate(
                [
                    'student_id' => $data['student_id'],
                    'school_year_id' => $validated['school_year_id'],
                ],
                [
                    'status' => $data['status'],
                ]
            );
        }

        return redirect()->back()->with('success', 'Keputusan kelulusan berhasil diperbarui!');
    }
}
