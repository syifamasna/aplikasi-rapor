<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentClass;
use App\Models\User;
use Illuminate\Http\Request;

class StudentClassController extends Controller
{
    public function index()
    {
        // Ambil semua kelas dengan relasi wali kelas, diurutkan berdasarkan nama kelas
        $student_classes = StudentClass::with('waliKelas')->orderBy('nama')->get();
        
        // Ambil daftar wali kelas, diurutkan berdasarkan nama
        $waliKelas = User::whereHas('roles', function ($query) {
            $query->whereIn('role', ['Wali Kelas', 'Guru Mapel', 'Pj Prestasi']);
        })->select('id', 'nama')->orderBy('nama', 'asc')->get();        

        return view('admin-pages.student_classes.index', compact('student_classes', 'waliKelas'));
    } 
      
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:student_classes,nama',
            'wali_kelas' => 'nullable|exists:users,id',
        ]);

        StudentClass::create([
            'nama' => $request->nama,
            'wali_kelas_id' => $request->wali_kelas
        ]);

        return redirect()->route('admin.student_classes.index')->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255|unique:student_classes,nama,' . $id,
            'wali_kelas' => 'nullable|exists:users,id',
        ]);

        $studentClass = StudentClass::findOrFail($id);
        $studentClass->update([
            'nama' => $request->nama,
            'wali_kelas_id' => $request->wali_kelas
        ]);

        return redirect()->route('admin.student_classes.index')->with('success', 'Kelas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $studentClass = StudentClass::findOrFail($id);
        $studentClass->delete();

        return redirect()->route('admin.student_classes.index')->with('success', 'Kelas berhasil dihapus!');
    }
}
