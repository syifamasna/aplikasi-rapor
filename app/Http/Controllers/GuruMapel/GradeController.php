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
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

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
            ->join('student_classes', 'student_classes.id', '=', 'teachings.class_id')
            ->where('teachings.user_id', $user->id)
            ->when($classId, function ($query) use ($classId) {
                return $query->where('teachings.class_id', $classId);
            })
            ->when($subjectId, function ($query) use ($subjectId) {
                return $query->where('teachings.subject_id', $subjectId);
            })
            ->orderBy('student_classes.nama')     // 1. Kelas
            ->orderBy('teachings.subject_id')     // 2. Mapel
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
    
        $schoolYears = SchoolYear::orderBy('tahun_awal', 'desc')
            ->orderByRaw("FIELD(semester, 'II (Dua)', 'Tengah Semester II (Dua)', 'I (Satu)', 'Tengah Semester I (Satu)')")
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
            'grades.*.nilai' => 'nullable|numeric|min:0|max:100',
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

    
    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|mimes:xlsx,xls',
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:student_classes,id',
            'school_year_id' => 'required|exists:school_years,id'
        ]);
    
        try {
            $file = $request->file('import_file');
            $spreadsheet = IOFactory::load($file->getRealPath());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();
    
            DB::beginTransaction();
    
            foreach ($rows as $key => $row) {
                // Skip header row
                if ($key === 0) {
                    continue;
                }
    
                // Pastikan row adalah array dan memiliki cukup elemen
                if (!is_array($row) || count($row) < 5) {
                    Log::warning("Baris {$key} tidak valid - format tidak sesuai");
                    continue;
                }
    
                $nis = $row[2] ?? null; // Kolom NIS (indeks 2)
                $nilai = $row[4] ?? null; // Kolom Nilai (indeks 4)
    
                // Validasi data wajib
                if (empty($nis) || empty($nilai)) {
                    Log::warning("Baris {$key} - NIS atau Nilai kosong");
                    continue;
                }
    
                // Cari siswa di kelas yang sesuai
                $student = Student::where('nis', $nis)
                            ->where('class_id', $request->class_id)
                            ->first();
    
                if (!$student) {
                    Log::warning("Siswa dengan NIS {$nis} tidak ditemukan di kelas ini");
                    continue;
                }
    
                // Update atau create nilai
                Grade::updateOrCreate(
                    [
                        'student_id' => $student->id,
                        'subject_id' => $request->subject_id,
                        'school_year_id' => $request->school_year_id
                    ],
                    [
                        'nilai' => $nilai,
                        'updated_at' => now()
                    ]
                );
            }
    
            DB::commit();
            return back()->with('success', 'Data nilai berhasil diimpor!');
    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Import Error: " . $e->getMessage());
            return back()->with('error', 'Gagal mengimpor: ' . $e->getMessage());
        }
    }
    
    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // Tambahkan judul utama
        $sheet->mergeCells('A1:E1');
        $sheet->setCellValue('A1', 'TEMPLATE IMPOR NILAI SISWA');
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
            ['No', 'Nama Siswa', 'NIS', 'Jenis Kelamin', 'Nilai (0-100)'],
            null,
            'A2' // Mulai dari baris 2
        );
    
        // Styling header tabel
        $sheet->getStyle('A2:E2')->applyFromArray([
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
                [1, 'Contoh Siswa 1', '12345', 'L', 85]
     
            ],
            null,
            'A3' // Mulai dari baris 3
        );

        $sheet->getStyle('A3:E3')->applyFromArray([
        
            'borders' => [
                'allBorders' => [
                    'borderStyle' => 'thin'
                ]
            ]
        ]);
    
        // Auto size column
        foreach(range('A','E') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }
    
        // Tinggi baris judul
        $sheet->getRowDimension(1)->setRowHeight(25);
    
        $writer = new Xlsx($spreadsheet);
        $fileName = 'template_impor_nilai.xlsx';
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);
    
        return response()->download($tempFile, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }
}
