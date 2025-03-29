<?php

namespace App\Http\Controllers\GuruMapel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\SchoolYear;
use App\Models\Subject;
use App\Models\StudentClass;
use App\Models\Teaching;
use App\Models\User;
use App\Models\Student;

class GradeController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        // Ambil filter dari request
        $classId = $request->input('class_id');
        $subjectId = $request->input('subject_id');

        // Ambil semua pengajaran yang diampu oleh guru yang sedang login
        $teachings = Teaching::with(['subject', 'class', 'teacher'])
            ->where('user_id', $user->id)
            ->when($classId, function ($query) use ($classId) {
                return $query->where('class_id', $classId);
            })
            ->when($subjectId, function ($query) use ($subjectId) {
                return $query->where('subject_id', $subjectId);
            })
            ->orderBy('subject_id')
            ->join('student_classes', 'student_classes.id', '=', 'teachings.class_id')
            ->orderBy('student_classes.nama')
            ->select('teachings.*')
            ->get();

        // Ambil data filter (mata pelajaran & kelas)
        $subjects = Subject::whereIn('id', $teachings->pluck('subject_id'))->orderBy('nama')->get();
        $classes = StudentClass::whereIn('id', $teachings->pluck('class_id'))->orderBy('nama')->get();
        
        // Ambil kelas pertama sebagai default
        $class = $classes->first();

        return view('guru-mapel-pages.grades.index', compact('teachings', 'subjects', 'classes', 'user', 'class'));
    }

    public function studentIndex(Request $request)
    {
        // Ambil class_id dan subject_id dari request, gunakan default jika kosong
        $classId = $request->input('class_id') ?? StudentClass::first()?->id;
        $subjectId = $request->input('subject_id') ?? Subject::first()?->id;
    
        // Ambil kelas berdasarkan ID
        $class = StudentClass::find($classId);
        if (!$class) {
            return redirect()->back()->with('error', 'Kelas tidak ditemukan.');
        }
    
        // Ambil daftar siswa di kelas yang dipilih
        $students = Student::where('class_id', $classId)->orderBy('nama')->get();
    
        // Ambil daftar mata pelajaran yang diajarkan di kelas ini
        $subjects = Subject::whereIn('id', function ($query) use ($classId) {
            $query->select('subject_id')->from('teachings')->where('class_id', $classId);
        })->orderBy('nama')->get();
    
        // Ambil Guru Pengampu berdasarkan kelas & mata pelajaran
        $teacher = Teaching::where('class_id', $classId)
        ->where('subject_id', $subjectId)
        ->where('user_id', auth()->id())
        ->first()?->teacher ?? auth()->user(); 
    
        // Ambil daftar tahun ajar
        $schoolYears = SchoolYear::orderBy('tahun_awal', 'desc')
            ->orderBy('semester', 'desc')
            ->get();
        
        $schoolYearId = $request->input('school_year_id', $schoolYears->first()->id ?? null);
        $schoolYear = $schoolYears->where('id', $schoolYearId)->first();
    
        // Ambil nilai siswa berdasarkan tahun ajar & mata pelajaran
        $grades = Grade::whereIn('student_id', $students->pluck('id'))
            ->where('school_year_id', $schoolYearId)
            ->where('subject_id', $subjectId)
            ->get()
            ->keyBy('student_id');
    
        return view('guru-mapel-pages.grades.students', compact(
            'students', 'class', 'subjects', 'schoolYears', 'schoolYear', 'grades', 'teacher', 'subjectId'
        ));
    }    

    public function update(Request $request)
    {

        $validated = $request->validate([
            'class_id' => 'required|exists:student_classes,id',
            'school_year_id' => 'required|exists:school_years,id',
            'subject_id' => 'required|exists:subjects,id',
            'grades' => 'required|array',
            'grades.*.nilai' => 'nullable|numeric|min:75|max:100',
        ]);

        foreach ($validated['grades'] as $student_id => $data) {
            Grade::updateOrCreate(
                [
                    'student_id' => $student_id, // Ambil dari key array
                    'school_year_id' => $validated['school_year_id'],
                    'subject_id' => $validated['subject_id'],
                ],
                [
                    'nilai' => $data['nilai'] ?? null,
                ]
            );
        }

        return redirect()->back()->with('success', 'Nilai berhasil diperbarui!');
    }
}
