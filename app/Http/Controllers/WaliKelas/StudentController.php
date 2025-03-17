<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:students',
            'nisn' => 'required',
            'nama' => 'required',
            'class_id' => 'required|exists:student_classes,id',
            'jk' => 'required|in:Laki-Laki,Perempuan', // Sesuaikan dengan Blade
        ]);

        Student::create($validated);

        return redirect()->route('wali_kelas.student_classes.students', ['class_id' => $request->class_id])
            ->with('success', 'Data siswa berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {        
        $request->validate([
            'nis' => 'required',
            'nisn' => 'required',
            'nama' => 'required',
            'class_id' => 'required',
        ]);
    
        $student = Student::findOrFail($id);
        $student->nis = $request->nis;
        $student->nisn = $request->nisn;
        $student->nama = $request->nama;
        $student->class_id = $request->class_id;
        $student->jk = $request->jk ?? $student->jk;
        $student->save();
    
        return redirect()->route('wali_kelas.student_classes.students')->with('success', 'Data siswa berhasil diperbarui');
    }    

    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        // Pastikan setelah penghapusan, Anda mengarahkan kembali dengan parameter pencarian yang ada
        return redirect()->route('wali_kelas.student_classes.students', [
            'class_id' => request('class_id'),
            'keyword' => request('keyword')
        ])->with('success', 'Data siswa berhasil dihapus');
    }
}
