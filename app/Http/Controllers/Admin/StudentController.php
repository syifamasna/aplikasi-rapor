<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class StudentController extends Controller
{

    public function index(Request $request)
    {
        $classId = $request->input('class_id');
    
        // Jika class_id kosong, tampilkan semua siswa
        $students = Student::when($classId, function ($query) use ($classId) {
            return $query->where('class_id', $classId);
        })->get();
    
        $classes = StudentClass::all(); // Ambil semua kelas untuk dropdown
    
        return view('admin-pages.students.index', compact('students', 'classes'));
    }    

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nis' => 'required|unique:students',
            'nisn' => 'required',
            'nama' => 'required',
            'class_id' => 'required',
            'jk' => 'required|in:Laki-laki,Perempuan', // Validasi jk
            
        ]);

        $student = new Student();
        $student->nis = $request->nis;
        $student->nisn = $request->nisn;
        $student->nama = $request->nama;
        $student->class_id = $request->class_id;
        $student->jk = $request->jk; // Simpan jk
        $student->save();

        return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil ditambahkan');
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
        $student->jk = $request->jk ?? $student->jk; // Jika tidak ada input, tetap pakai data lama
        $student->save();

        return redirect()->route('admin.students.index')->with('success', 'Data siswa berhasil diperbarui');
    }


    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        // Pastikan setelah penghapusan, Anda mengarahkan kembali dengan parameter pencarian yang ada
        return redirect()->route('admin.students.index', [
            'class_id' => request('class_id'),
            'keyword' => request('keyword')
        ])->with('success', 'Data siswa berhasil dihapus');
    }

    public function import(Request $request)
    {
        // Validasi input file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        $file = $request->file('file')->getPathname();
        $spreadsheet = IOFactory::load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        foreach ($rows as $key => $row) {
            // Skip header row (key = 1)
            if ($key == 1) continue;

            // Proses untuk mengganti 'P' dan 'L' dengan 'Perempuan' dan 'Laki-laki'
            $jk = $row['C'];  // Kolom C adalah jenis kelamin
            if ($jk == 'P') {
                $jk = 'Perempuan';
            } elseif ($jk == 'L') {
                $jk = 'Laki-laki';
            }

            // Simpan data ke tabel students
            Student::create([
                'nama' => $row['A'],  // Kolom A untuk nama
                'kelas' => $row['B'], // Kolom B untuk kelas
                'jk' => $jk,          // Simpan jenis kelamin yang sudah diproses
                'nis' => $row['D'],   // Kolom D untuk NIS
                'nisn' => $row['E'],  // Kolom E untuk NISN
                'ttl' => $row['F']    // Kolom F untuk TTL
            ]);
        }

        return redirect()->back()->with('success', 'Data siswa berhasil diimpor');
    }
}
