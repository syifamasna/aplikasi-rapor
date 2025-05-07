<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

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

    public function bulkDelete(Request $request)
    {
        $ids = $request->input('student_ids');
    
        if (is_array($ids) && count($ids) > 0) {
            Student::whereIn('id', $ids)->delete();
    
            return redirect()->back()->with('success', count($ids) . ' Siswa berhasil dihapus');
        }
    
        return redirect()->back()->with('error', 'Tidak ada siswa yang dipilih untuk dihapus');
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

    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Tambahkan judul utama
        $sheet->mergeCells('A1:F1');
        $sheet->setCellValue('A1', 'TEMPLATE IMPOR DATA SISWA');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 14,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '4472C4']
            ],
            'alignment' => [
                'horizontal' => 'center'
            ]
        ]);
    
        // Header tabel
        $sheet->fromArray(
            ['No', 'Nama Siswa', 'Kelas', 'Jenis Kelamin', 'NIS', 'NISN'],
            null,
            'A2' // Mulai dari baris 2
        );
    
        // Styling header tabel
        $sheet->getStyle('A2:F2')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => 'D9E1F2']
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin'
                ]
            ]
        ]);
    
        // Contoh data
        $sheet->fromArray(
            [
                [1, 'Contoh Siswa 1', 'I (Satu) A', 'L', '123456', '7236930']
        
            ],
            null,
            'A3' // Mulai dari baris 3
        );

        $sheet->getStyle('A3:F3')->applyFromArray([

            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin'
                ]
            ]
        ]);
    
        // Auto size column
        foreach(range('A','F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    
        // Tinggi baris judul
        $sheet->getRowDimension(1)->setRowHeight(25);
    
        $writer = new Xlsx($spreadsheet);
        $fileName = 'template_impor_siswa.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);
    
        return response()->download($tempFile, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }
}
