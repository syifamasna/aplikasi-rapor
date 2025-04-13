<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Note;
use App\Models\SchoolYear; 
use App\Models\StudentClass;
use App\Models\Student;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $student_classes = StudentClass::where('wali_kelas_id', auth()->id())
            ->with('students')
            ->orderBy('nama')
            ->get();

        return view('wali-kelas-pages.notes.index', compact('student_classes'));
    }

    public function studentIndex(Request $request)
    {
        // Ambil daftar kelas yang diampu oleh wali kelas
        $classes = StudentClass::where('wali_kelas_id', auth()->id())->get();
        
        // Ambil satu kelas pertama yang diampu wali kelas (jika hanya satu kelas)
        $class = $classes->first();

        // Ambil ID kelas dari request atau default ke kelas pertama
        $classId = $request->input('class_id', $class->id ?? null);
        $students = Student::where('class_id', $classId)
            ->whereHas('class', function ($query) {
                $query->where('wali_kelas_id', auth()->id());
            })
            ->orderBy('nama')
            ->get();

        $schoolYears = SchoolYear::orderBy('tahun_awal', 'desc')
            ->orderByRaw("FIELD(semester, 'II (Dua)', 'Tengah Semester II (Dua)', 'I (Satu)', 'Tengah Semester I (Satu)')")
            ->get();

        // Ambil tahun ajaran yang dipilih, default ke tahun terbaru jika tidak ada
        $schoolYearId = $request->input('school_year_id', $schoolYears->first()->id ?? null);
        $schoolYear = $schoolYears->where('id', $schoolYearId)->first();

        // Ambil catatan berdasarkan tahun ajaran yang dipilih
        $notes = Note::whereIn('student_id', $students->pluck('id'))
            ->where('school_year_id', $schoolYearId)
            ->get()
            ->keyBy('student_id');

        return view('wali-kelas-pages.notes.students', compact(
            'students', 'classes', 'class', 'schoolYears', 'schoolYear', 'notes'
        ));
    }

    public function update(Request $request, $classId)
    {
        $validated = $request->validate([
            'class_id' => 'required|exists:student_classes,id',
            'school_year_id' => 'required|exists:school_years,id',
            'notes.*.student_id' => 'required|exists:students,id',
            'notes.*.catatan' => 'nullable|string|max:255',
        ]);

        foreach ($validated['notes'] as $data) {
            Note::updateOrCreate(
                [
                    'student_id' => $data['student_id'],
                    'school_year_id' => $validated['school_year_id']
                ],
                [
                    'catatan' => $data['catatan'] ?? ''
                ]
            );
        }        
        return redirect()->back()->with('success', 'Catatan berhasil diperbarui!');
    }
}
