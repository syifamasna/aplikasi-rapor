<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\GradeDetail;
use App\Models\Note;
use App\Models\SchoolProfile;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\StudentClass;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;

class ClassProgressReportController extends Controller
{
    public function index()
    {
        $student_classes = StudentClass::with('students')
            ->orderBy('nama')
            ->get();

        return view('admin-pages.class_progress_reports.index', compact('student_classes'));
    }

    public function show($class_id)
    {
        $class = StudentClass::findOrFail($class_id);

        // Ambil daftar tahun ajaran yang tersedia
        $schoolYears = SchoolYear::whereIn('semester', ['Tengah Semester I (Satu)', 'Tengah Semester II (Dua)'])
            ->orderBy('tahun_awal', 'desc')
            ->get();

        // Ambil tahun ajaran yang dipilih (atau default ke yang pertama)
        $schoolYear = SchoolYear::where('id', request('school_year_id', optional($schoolYears->first())->id))
            ->first();

        // Ambil semua mata pelajaran
       $kelas_3_6 = ['III', 'IV', 'V', 'VI'];
        $isKelas3Sampai6 = Str::startsWith($class->nama, $kelas_3_6);
            
        if ($isKelas3Sampai6) {
            $subjects = Subject::whereIn('kelompok_mapel', [
                'Mata Pelajaran Wajib (Kelas 1-6)',
                'Mata Pelajaran Wajib (Kelas 3-6)',
                'Muatan Lokal'
            ])->get();
        } else {
            $subjects = Subject::whereIn('kelompok_mapel', [
                'Mata Pelajaran Wajib (Kelas 1-6)',
                'Muatan Lokal'
            ])->get();
        }

        // Ambil ID siswa dalam kelas
        $studentIds = Student::where('class_id', $class_id)->pluck('id');

        // Ambil semua nilai siswa dan kelompokkan per siswa
        $grades = Grade::whereIn('student_id', $studentIds)
            ->where('school_year_id', $schoolYear->id ?? null)
            ->with('subject')
            ->get()
            ->groupBy('student_id');

        // Ambil data absensi dan kelompokkan per siswa
        $attendances = Attendance::whereIn('student_id', $studentIds)
            ->where('school_year_id', $schoolYear->id ?? null)
            ->get()
            ->keyBy('student_id');

        // Ambil semua siswa lalu tambahkan grades dan absensi ke masing-masing siswa
        $students = Student::where('class_id', $class_id)
            ->orderBy('nama')
            ->get()
            ->map(function ($student) use ($grades, $attendances) {
                $student->grades = $grades[$student->id] ?? collect();
                $student->absensi = $attendances[$student->id] ?? ['sakit' => 0, 'izin' => 0, 'alfa' => 0];
                return $student;
            });

        return view('admin-pages.class_progress_reports.show', compact(
            'class',
            'students',
            'grades',
            'subjects',
            'schoolYears',
            'schoolYear',
            'attendances'
        ));
    }
    
    public function exportExcel(Request $request, $class_id)
    {
        $class = StudentClass::findOrFail($class_id);
        $schoolYear = SchoolYear::findOrFail($request->school_year_id);
        $schoolProfile = SchoolProfile::first();
    
        $kelas_3_6 = ['III', 'IV', 'V', 'VI'];
        $isKelas3Sampai6 = Str::startsWith($class->nama, $kelas_3_6);
    
        $subjects = Subject::whereIn('kelompok_mapel', $isKelas3Sampai6
            ? ['Mata Pelajaran Wajib (Kelas 1-6)', 'Mata Pelajaran Wajib (Kelas 3-6)', 'Muatan Lokal']
            : ['Mata Pelajaran Wajib (Kelas 1-6)', 'Muatan Lokal']
        )->get();
    
        $studentIds = Student::where('class_id', $class_id)->pluck('id');
    
        $grades = Grade::whereIn('student_id', $studentIds)
            ->where('school_year_id', $schoolYear->id)
            ->get()
            ->groupBy('student_id');
    
        $attendances = Attendance::whereIn('student_id', $studentIds)
            ->where('school_year_id', $schoolYear->id)
            ->get()
            ->keyBy('student_id');
    
        $students = Student::where('class_id', $class_id)
            ->orderBy('nama')
            ->get()
            ->map(function ($student) use ($grades, $attendances) {
                $student->grades = $grades[$student->id] ?? collect();
                $student->absensi = $attendances[$student->id] ?? ['sakit' => 0, 'izin' => 0, 'alfa' => 0];
                return $student;
            });
    
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Header
        $sheet->mergeCells('A1:U1');
        $sheet->setCellValue('A1', 'LAPORAN PERKEMBANGAN PESERTA DIDIK KELAS ' . strtoupper($class->nama));
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
    
        $sheet->mergeCells('A2:U2');
        $semester = strtoupper($schoolYear->semester);
        $sheet->setCellValue('A2', "$semester TAHUN PELAJARAN {$schoolYear->tahun_awal}/{$schoolYear->tahun_akhir}");
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
    
        // Header Kolom
        $mapelCount = $subjects->count();
        $startRow = 4;
        $rowNilai = $startRow + 1;
    
        $sheet->setCellValue('A4', 'No')->mergeCells("A4:A5");
        $sheet->setCellValue('B4', 'Nama Lengkap')->mergeCells("B4:B5");
        $nilaiEndCol = Coordinate::stringFromColumnIndex(2 + $mapelCount);
        $sheet->setCellValue("C4", 'Nilai')->mergeCells("C4:$nilaiEndCol" . '4');
    
        foreach ($subjects as $i => $subject) {
            $col = Coordinate::stringFromColumnIndex(3 + $i); // Mulai dari C
            $sheet->setCellValue($col . '5', $subject->singkatan ?? $subject->nama);
        }
    
        // Absensi
        $absensiStartCol = Coordinate::stringFromColumnIndex(3 + $mapelCount);
        $absensiEndCol = Coordinate::stringFromColumnIndex(3 + $mapelCount + 2);
        $sheet->setCellValue($absensiStartCol . '4', 'Absensi')->mergeCells("{$absensiStartCol}4:{$absensiEndCol}4");
        $sheet->setCellValue($absensiStartCol . '5', 'S');
        $sheet->setCellValue(Coordinate::stringFromColumnIndex(3 + $mapelCount + 1) . '5', 'I');
        $sheet->setCellValue(Coordinate::stringFromColumnIndex(3 + $mapelCount + 2) . '5', 'A');
    
        // Jumlah & Rata-rata
        $colJumlah = Coordinate::stringFromColumnIndex(3 + $mapelCount + 3);
        $colRata2 = Coordinate::stringFromColumnIndex(3 + $mapelCount + 4);
        $sheet->setCellValue($colJumlah . '4', 'Jumlah')->mergeCells("$colJumlah" . "4:$colJumlah" . "5");
        $sheet->setCellValue($colRata2 . '4', 'Rata-rata')->mergeCells("$colRata2" . "4:$colRata2" . "5");
    
        // Isi Data Siswa
        $row = 6;
        foreach ($students as $index => $student) {
            $sheet->setCellValue("A$row", $index + 1);
            $sheet->setCellValue("B$row", $student->nama);
    
            $nilaiArray = [];
            foreach ($subjects as $i => $subject) {
                $col = Coordinate::stringFromColumnIndex(3 + $i);
                $nilai = optional($student->grades->firstWhere('subject_id', $subject->id))->nilai;
                $sheet->setCellValue("$col$row", $nilai ?? '-');
                if (is_numeric($nilai) && $nilai <= 70) {
                    $sheet->getStyle("$col$row")->getFill()->setFillType(Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('FF7E7E');
                }
                if (is_numeric($nilai)) $nilaiArray[] = $nilai;
            }
    
            $absen = $student->absensi;
            $sheet->setCellValue(Coordinate::stringFromColumnIndex(3 + $mapelCount) . $row, $absen['sakit']);
            $sheet->setCellValue(Coordinate::stringFromColumnIndex(3 + $mapelCount + 1) . $row, $absen['izin']);
            $sheet->setCellValue(Coordinate::stringFromColumnIndex(3 + $mapelCount + 2) . $row, $absen['alfa']);
    
            $jumlah = array_sum($nilaiArray);
            $rata = count($nilaiArray) ? round($jumlah / count($nilaiArray), 2) : '-';
            $sheet->setCellValue("$colJumlah$row", $jumlah);
            $sheet->setCellValue("$colRata2$row", $rata);
            $row++;
        }
    
        // Footer: Rata-rata
        $sheet->mergeCells("A$row:B$row");
        $sheet->setCellValue("A$row", "Nilai rata-rata");

        // 🌕 Terapkan warna kuning ke seluruh baris sampai kolom terakhir
        $lastCol = $colRata2; // Ini kolom paling akhir dari data
        $sheet->getStyle("A$row:$lastCol$row")->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setRGB('FFF27E');
    
        foreach ($subjects as $i => $subject) {
            $col = Coordinate::stringFromColumnIndex(3 + $i);
            $nilaiPerMapel = $students->map(fn($s) => optional($s->grades->firstWhere('subject_id', $subject->id))->nilai)
                ->filter(fn($n) => is_numeric($n));
            $sheet->setCellValue("$col$row", $nilaiPerMapel->count() ? round($nilaiPerMapel->avg(), 2) : '-');
        }
    
        $sheet->setCellValue(Coordinate::stringFromColumnIndex(3 + $mapelCount) . $row, round($students->avg('absensi.sakit'), 2));
        $sheet->setCellValue(Coordinate::stringFromColumnIndex(3 + $mapelCount + 1) . $row, round($students->avg('absensi.izin'), 2));
        $sheet->setCellValue(Coordinate::stringFromColumnIndex(3 + $mapelCount + 2) . $row, round($students->avg('absensi.alfa'), 2));
    
        $jumlahSemua = $students->map(fn($s) =>
            $subjects->map(fn($sub) =>
                optional($s->grades->firstWhere('subject_id', $sub->id))->nilai
            )->filter(fn($n) => is_numeric($n))->sum()
        )->filter();
    
        $rataRataSemua = $students->map(fn($s) =>
            $subjects->map(fn($sub) =>
                optional($s->grades->firstWhere('subject_id', $sub->id))->nilai
            )->filter(fn($n) => is_numeric($n))->avg()
        )->filter();
    
        $sheet->setCellValue("$colJumlah$row", round($jumlahSemua->avg(), 2));
        $sheet->setCellValue("$colRata2$row", round($rataRataSemua->avg(), 2));
    
        // Style semua border + center
        $lastCol = $colRata2;
        $sheet->getStyle("A4:$lastCol$row")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle("A4:$lastCol$row")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle("B6:B" . ($row - 1))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
    
        // Tanda Tangan
        $ttdRow = $row + 3;
        $sheet->setCellValue("A$ttdRow", 'Kepala Sekolah');
        $sheet->setCellValue("R$ttdRow", 'Wali Kelas');
        $sheet->setCellValue("A" . ($ttdRow + 4), $schoolProfile->kepsek ?? '..........................');
        $sheet->setCellValue("R" . ($ttdRow + 4), $class->waliKelas->nama ?? '..........................');
    
        // Output
        $writer = new Xlsx($spreadsheet);
        $filename = 'Legger LPS Kelas ' . $class->nama
            . ( $schoolYear->semester === ' Tengah Semester I (Satu) ' ? ' Tengah Semester I (Satu) ' : ' Tengah Semester II (Dua)') 
            . ' Tahun Ajar ' . $schoolYear->tahun_awal . '-' . $schoolYear->tahun_akhir . '.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $writer->save('php://output');
        exit;
    }

    public function exportPdf($class_id)
    {
        $class = StudentClass::findOrFail($class_id);

        // Ambil daftar tahun ajaran yang tersedia
        $schoolYears = SchoolYear::whereIn('semester', ['Tengah Semester I (Satu)', 'Tengah Semester II (Dua)'])
            ->orderBy('tahun_awal', 'desc')
            ->get();

        // Ambil tahun ajaran yang dipilih (atau default ke yang pertama)
        $schoolYear = SchoolYear::where('id', request('school_year_id', optional($schoolYears->first())->id))
            ->first();

        // Ambil semua mata pelajaran
       $kelas_3_6 = ['III', 'IV', 'V', 'VI'];
        $isKelas3Sampai6 = Str::startsWith($class->nama, $kelas_3_6);
            
        if ($isKelas3Sampai6) {
            $subjects = Subject::whereIn('kelompok_mapel', [
                'Mata Pelajaran Wajib (Kelas 1-6)',
                'Mata Pelajaran Wajib (Kelas 3-6)',
                'Muatan Lokal'
            ])->get();
        } else {
            $subjects = Subject::whereIn('kelompok_mapel', [
                'Mata Pelajaran Wajib (Kelas 1-6)',
                'Muatan Lokal'
            ])->get();
        }

        // Ambil ID siswa dalam kelas
        $studentIds = Student::where('class_id', $class_id)->pluck('id');

        // Ambil semua nilai siswa dan kelompokkan per siswa
        $grades = Grade::whereIn('student_id', $studentIds)
            ->where('school_year_id', $schoolYear->id ?? null)
            ->with('subject')
            ->get()
            ->groupBy('student_id');

        // Ambil data absensi dan kelompokkan per siswa
        $attendances = Attendance::whereIn('student_id', $studentIds)
            ->where('school_year_id', $schoolYear->id ?? null)
            ->get()
            ->keyBy('student_id');

        // Ambil semua siswa lalu tambahkan grades dan absensi ke masing-masing siswa
        $students = Student::where('class_id', $class_id)
            ->orderBy('nama')
            ->get()
            ->map(function ($student) use ($grades, $attendances) {
                $student->grades = $grades[$student->id] ?? collect();
                $student->absensi = $attendances[$student->id] ?? ['sakit' => 0, 'izin' => 0, 'alfa' => 0];
                return $student;
            });

        $schoolProfile = SchoolProfile::first();

        // 🔍 Cek apakah ini mode cetak (print)
        if (request('mode') === 'print') {
            return view('admin-pages.class_progress_reports.show-pdf', compact(
                'class',
                'students',
                'grades',
                'subjects',
                'schoolYears',
                'schoolYear',
                'attendances',
                'schoolProfile'
            ));
        }

        // Default: generate PDF
        $pdf = Pdf::loadView('admin-pages.class_progress_reports.show-pdf', compact(
            'class',
            'students',
            'grades',
            'subjects',
            'schoolYears',
            'schoolYear',
            'attendances',
            'schoolProfile'
        ))->setPaper('A4', 'landscape');

        $filename = 'Legger_LPS_' . Str::slug($class->nama) . '_' . $schoolYear->tahun_awal . '_' . $schoolYear->tahun_akhir . '_' . $schoolYear->semester . '.pdf';

        return $pdf->stream($filename);
    }

    public function exportAllPdf($class_id, Request $request)
    {
        $class = StudentClass::findOrFail($class_id);
        $schoolProfile = SchoolProfile::first();

        // Ambil school_year_id dari request, atau fallback ke yang terbaru jika tidak ada
        $schoolYearId = $request->school_year_id;

        if ($schoolYearId) {
            $schoolYear = SchoolYear::findOrFail($schoolYearId);
        } else {
            // fallback: ambil yang tengah semester I atau II terbaru
            $schoolYear = SchoolYear::whereIn('semester', ['Tengah Semester I (Satu)', 'Tengah Semester II (Dua)'])
                ->orderBy('tahun_awal', 'desc')
                ->first();
        }

       $kelas_3_6 = ['III', 'IV', 'V', 'VI'];
        $isKelas3Sampai6 = Str::startsWith($class->nama, $kelas_3_6);
            
        if ($isKelas3Sampai6) {
            $subjects = Subject::whereIn('kelompok_mapel', [
                'Mata Pelajaran Wajib (Kelas 1-6)',
                'Mata Pelajaran Wajib (Kelas 3-6)',
                'Muatan Lokal'
            ])->get();
        } else {
            $subjects = Subject::whereIn('kelompok_mapel', [
                'Mata Pelajaran Wajib (Kelas 1-6)',
                'Muatan Lokal'
            ])->get();
        }

        $students = Student::where('class_id', $class_id)->orderBy('nama')->get();

        $mergedHtml = '';

        foreach ($students as $index => $student) {
        $grades = Grade::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id)
            ->with('subject')
            ->get();

        $gradeDetails = GradeDetail::whereIn('grade_id', $grades->pluck('id'))->get();

        $attendances = Attendance::where('student_id', $student->id)
            ->where('school_year_id', $schoolYear->id)
            ->first();

        // Render tampilan untuk setiap siswa
        $html = View::make('admin-pages.student_progress_reports.show-pdf', compact(
            'class',
            'student',
            'grades',
            'subjects',
            'gradeDetails',
            'schoolYear',
            'schoolProfile',
            'attendances',
        ) + ['isAll' => true])->render();            

        $mergedHtml .= $html;
    }

        $finalPdf = Pdf::loadHTML($mergedHtml);
        $filename = 'LPS_Kelas_' . Str::slug($class->nama) . '_' . $schoolYear->tahun_awal . '_' . $schoolYear->tahun_akhir . '_' . $schoolYear->semester . '.pdf';

        return $finalPdf->stream($filename);
    }
}
