<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;

class StudentController extends Controller
{

    public function index(Request $request)
    {
        $classId = $request->input('class_id');

        // Ambil daftar kelas yang sudah diurutkan abjad
        $classes = StudentClass::orderBy('nama', 'asc')->get();

        // Ambil siswa dengan filter kelas (jika ada), dan urutkan berdasarkan nama kelas lalu nama siswa
        $students = Student::when($classId, function ($query) use ($classId) {
                return $query->where('class_id', $classId);
            })
            ->with('class') // Pastikan mengambil data kelas
            ->join('student_classes', 'students.class_id', '=', 'student_classes.id') // Join untuk mengurutkan berdasarkan nama kelas
            ->orderBy('student_classes.nama', 'asc') // Urutkan berdasarkan nama kelas (bukan ID)
            ->orderBy('students.nama', 'asc') // Lalu urutkan berdasarkan nama siswa
            ->select('students.*') // Pastikan hanya memilih kolom dari tabel students agar tidak bentrok
            ->get();

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
        try {
            // Validasi input file
            $request->validate([
                'importFile' => 'required|mimes:xlsx,xls',
            ]);

            // Ambil file yang diupload
            $file = $request->file('importFile');
            if (!$file) {
                return back()->with('error', 'File tidak ditemukan dalam request!');
            }

            // Simpan file sementara di storage/temp (agar bisa diakses PhpSpreadsheet)
            $path = $file->move(storage_path('app/temp'), $file->getClientOriginalName());
            $fullPath = $path->getRealPath(); // Ambil path absolut

            // Debugging Path File
            Log::info("File Path: " . $fullPath);
            sleep(1); // Tunggu 1 detik agar file benar-benar tersimpan

            if (!file_exists($fullPath)) {
                return back()->with('error', "File tidak ditemukan di: " . $fullPath);
            }

            // Load file dengan PhpSpreadsheet
            $spreadsheet = IOFactory::load($fullPath);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true);

            // Debug isi Excel
            Log::info("Isi Excel: ", $rows);

            // Ubah array agar indeks mulai dari 0 tanpa loncatan
            $rows = array_values($rows);

            foreach ($rows as $key => $row) {
                // Lewati baris pertama (judul) dan kedua (header)
                if ($key < 2) {
                    continue;
                }
            
                // Jika baris kosong, lanjutkan loop
                if (empty($row['B']) || empty($row['C'])) {
                    Log::warning("Baris {$key} kosong, dilewati.");
                    continue;
                }
            
                // Ambil class_id berdasarkan nama kelas
                $class = StudentClass::where('nama', $row['C'])->first();
                $class_id = $class ? $class->id : null;
            
                // Konversi jenis kelamin
                $jk = ($row['D'] == 'P') ? 'Perempuan' : (($row['D'] == 'L') ? 'Laki-laki' : null);
            
                // Simpan data ke database (NISN boleh kosong)
                Student::create([
                    'nama' => $row['B'],
                    'class_id' => $class_id,
                    'jk' => $jk,
                    'nis' => $row['E'] ?? null,  // Boleh kosong
                    'nisn' => $row['F'] ?? null, // Sekarang tetap disimpan walaupun kosong
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            
                Log::info("Siswa berhasil diimport: {$row['B']}");
            }            

            return redirect()->back()->with('success', 'Data siswa berhasil diimpor!');
        } catch (\Exception $e) {
            Log::error("Error saat import: " . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
