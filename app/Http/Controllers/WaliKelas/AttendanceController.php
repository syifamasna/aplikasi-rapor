<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\SchoolYear; 
use App\Models\StudentClass;
use App\Models\Student;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        // Ambil kelas yang hanya diampu oleh wali kelas yang sedang login
        $student_classes = StudentClass::where('wali_kelas_id', auth()->id())
            ->with('students') // Optimalkan query agar menghitung jumlah siswa lebih cepat
            ->orderBy('nama')
            ->get();

        return view('wali-kelas-pages.attendances.index', compact('student_classes'));
    }

    public function studentIndex(Request $request)
    {
        // Ambil daftar kelas yang diampu oleh wali kelas yang login
        $classes = StudentClass::where('wali_kelas_id', auth()->id())->get();
        
        // Ambil satu kelas pertama yang diampu wali kelas (jika hanya satu kelas)
        $class = $classes->first();

        // Ambil siswa berdasarkan kelas yang dipilih
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

        // Ambil tahun ajaran yang sedang dipilih (jika ada)
        $schoolYearId = $request->input('school_year_id', $schoolYears->first()->id ?? null);
        $schoolYear = $schoolYears->where('id', $schoolYearId)->first();

        // Ambil catatan berdasarkan tahun ajaran yang dipilih
        $attendances = Attendance::whereIn('student_id', $students->pluck('id'))
            ->where('school_year_id', $schoolYearId)
            ->get()
            ->keyBy('student_id');

        return view('wali-kelas-pages.attendances.students', compact('students', 'classes', 'class', 'schoolYears', 'schoolYear', 'attendances'));
    }

    public function update(Request $request)
    {
        // Debugging untuk melihat request
        // dd($request->all());

        // Validasi input
        $validated = $request->validate([
            'class_id' => 'required|exists:student_classes,id',
            'school_year_id' => 'required|exists:school_years,id',
            'attendances' => 'required|array',
            'attendances.*.student_id' => 'required|exists:students,id',
            'attendances.*.sakit' => 'nullable|integer|min:0',
            'attendances.*.izin' => 'nullable|integer|min:0',
            'attendances.*.alfa' => 'nullable|integer|min:0',
        ]);

        foreach ($validated['attendances'] as $data) {
            Attendance::updateOrCreate(
                [
                    'student_id' => $data['student_id'],
                    'school_year_id' => $validated['school_year_id']
                ],
                [
                    'sakit' => $data['sakit'] ?? 0,
                    'izin' => $data['izin'] ?? 0,
                    'alfa' => $data['alfa'] ?? 0
                ]
            );
        }

        return redirect()->back()->with('success', 'Data ketidakhadiran berhasil diperbarui!');
    }
}