<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\SchoolYear;
use App\Models\StudentClass;
use App\Models\Student;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function index()
    {
        $student_classes = StudentClass::with('waliKelas')->orderBy('nama')->get();
        return view('admin-pages.achievements.index', compact('student_classes'));
    }
    
    public function studentIndex($class_id)
    {
        $class = StudentClass::findOrFail($class_id);
        $students = Student::where('class_id', $class_id)->orderBy('nama')->get();
        return view('admin-pages.achievements.students', compact('students', 'class'));
    }
    
    public function show($class_id, $student_id)
    {
        $class = StudentClass::findOrFail($class_id);
        $student = Student::findOrFail($student_id);
        $achievements = Achievement::where('student_id', $student_id)->get();
        $schoolYears = SchoolYear::orderBy('tahun_awal', 'desc')->get();

        return view('admin-pages.achievements.show', compact('class', 'student', 'achievements', 'schoolYears'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'school_year_id' => 'required|exists:school_years,id',
            'jenis_prestasi' => 'required|in:Akademik,Non-Akademik',
            'keterangan' => 'required|string|max:255',
        ]);

        Achievement::create([
            'student_id' => $request->student_id,
            'school_year_id' => $request->school_year_id,
            'jenis_prestasi' => $request->jenis_prestasi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Prestasi berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'school_year_id' => 'required|exists:school_years,id',
            'jenis_prestasi' => 'required|in:Akademik,Non-Akademik',
            'keterangan' => 'required|string|max:255',
        ]);

        $achievement = Achievement::findOrFail($id);
        $achievement->update([
            'school_year_id' => $request->school_year_id,
            'jenis_prestasi' => $request->jenis_prestasi,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->back()->with('success', 'Prestasi berhasil diperbarui');
    }
    
    public function destroy($id)
    {
        $achievement = Achievement::findOrFail($id);
        $achievement->delete();
    
        return redirect()->back()->with('success', 'Prestasi berhasil dihapus');
    }
}