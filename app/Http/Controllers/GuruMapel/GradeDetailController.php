<?php

namespace App\Http\Controllers\GuruMapel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\GradeDetail;
use App\Models\SchoolYear;
use App\Models\Subject;
use App\Models\StudentClass;
use App\Models\Teaching;
use App\Models\User;
use App\Models\Student;

class GradeDetailController extends Controller
{
    public function index(Request $request)
    {
        $classId = $request->input('class_id') ?? StudentClass::first()?->id;
        $subjectId = $request->input('subject_id') ?? Subject::first()?->id;

        $class = StudentClass::find($classId);
        if (!$class) {
            return redirect()->back()->with('error', 'Kelas tidak ditemukan.');
        }

        $students = Student::where('class_id', $classId)->orderBy('nama')->get();

        $subjects = Subject::whereIn('id', function ($query) use ($classId) {
            $query->select('subject_id')->from('teachings')->where('class_id', $classId);
        })->orderBy('nama')->get();

        $teacher = Teaching::where('class_id', $classId)
            ->where('subject_id', $subjectId)
            ->where('user_id', auth()->id())
            ->first()?->teacher ?? auth()->user();

        // Ambil daftar tahun ajar
        $schoolYears = SchoolYear::orderBy('tahun_awal', 'desc')
            ->orderByRaw("FIELD(semester, 'II (Dua)', 'Tengah Semester II (Dua)', 'I (Satu)', 'Tengah Semester I (Satu)')")
            ->get();

        $schoolYearId = $request->input('school_year_id', $schoolYears->first()->id ?? null);
        $schoolYear = $schoolYears->where('id', $schoolYearId)->first();

        // Ambil nilai dari tabel grades berdasarkan student_id, school_year_id, dan subject_id
        $grades = Grade::whereIn('student_id', $students->pluck('id'))
            ->where('school_year_id', $schoolYearId)
            ->where('subject_id', $subjectId)
            ->get()
            ->keyBy('student_id');

        // Pastikan setiap siswa memiliki entry dalam $grades meskipun kosong
        foreach ($students as $student) {
            if (!isset($grades[$student->id])) {
                $grades[$student->id] = (object) ['id' => null, 'nilai' => '-'];
            }
        }

        // Ambil grade_id dari hasil query di atas
        $gradeIds = $grades->pluck('id')->filter(); // Filter untuk menghindari null ID

        // Ambil data dari grade_details berdasarkan grade_id
        $gradeDetails = GradeDetail::whereIn('grade_id', $gradeIds)
            ->get()
            ->keyBy('grade_id');

        return view('guru-mapel-pages.grades.competencies', compact(
            'students', 'class', 'subjects', 'schoolYears', 'schoolYear', 'grades', 'gradeDetails', 'teacher', 'subjectId'
        ));
    }

    public function update(Request $request, $classId)
    {
        $request->validate([
            'grade_details' => 'required|array',
        ]);

        foreach ($request->input('grade_details') as $studentId => $details) {
            $grade = Grade::where('student_id', $studentId)
                ->where('school_year_id', $request->input('school_year_id'))
                ->where('subject_id', $request->input('subject_id'))
                ->first();
        
            if ($grade) {
                GradeDetail::updateOrCreate(
                    [
                        'grade_id' => $grade->id,
                    ],
                    [
                        'target' => $details['target'] ?? null,
                        'capaian' => $details['capaian'] ?? null,
                        'aplikasi_program' => $details['aplikasi_program'] ?? null,
                    ]
                );
            }
        }        

        return redirect()->back()->with('success', 'Capaian berhasil diperbarui.');
    }
}