<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function index()
    {
        // Ambil kelas yang hanya diampu oleh wali kelas yang sedang login
        $student_classes = StudentClass::where('wali_kelas_id', auth()->id())
        ->with('students') // Optimalkan query agar menghitung jumlah siswa lebih cepat
        ->orderBy('nama')
        ->get();

        return view('wali-kelas-pages.student_classes.index', compact('student_classes'));
    }

    public function studentIndex(Request $request)
    {
        // Ambil daftar kelas yang diampu oleh wali kelas yang login
        $classes = StudentClass::where('wali_kelas_id', auth()->id())->get();
        
        // Ambil satu kelas pertama yang diampu wali kelas (jika hanya satu kelas)
        $class = $classes->first();

        // Ambil siswa berdasarkan kelas yang dipilih (default ke kelas pertama wali kelas)
        $classId = $request->input('class_id', $class->id ?? null);
        $students = Student::where('class_id', $classId)
            ->whereHas('class', function ($query) {
                $query->where('wali_kelas_id', auth()->id());
            })
            ->orderBy('nama') // Urutkan berdasarkan nama siswa
            ->get();

        return view('wali-kelas-pages.student_classes.students', compact('students', 'classes', 'class'));
    }
}
