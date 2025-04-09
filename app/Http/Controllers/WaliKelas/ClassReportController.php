<?php

namespace App\Http\Controllers\WaliKelas;

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

class ClassReportController extends Controller
{
    public function index()
    {
        $student_classes = StudentClass::where('wali_kelas_id', auth()->id())
            ->with('students')
            ->orderBy('nama')
            ->get();

        return view('wali-kelas-pages.class_reports.index', compact('student_classes'));
    }

    public function show($class_id)
    {
        // Ambil kelas berdasarkan ID dan wali kelas yang sedang login
        $class = StudentClass::where('id', $class_id)
            ->where('wali_kelas_id', auth()->id())
            ->firstOrFail();

        // Ambil daftar tahun ajaran yang tersedia
        $schoolYears = SchoolYear::whereIn('semester', ['Ganjil', 'Genap'])
            ->orderBy('tahun_awal', 'desc')
            ->get();

        // Ambil tahun ajaran yang dipilih (atau default ke yang pertama)
        $schoolYear = SchoolYear::where('id', request('school_year_id', optional($schoolYears->first())->id))
            ->first();

        // Ambil semua mata pelajaran
        $subjects = Subject::whereIn('kelompok_mapel', ['Mata Pelajaran Wajib', 'Muatan Lokal'])->get();

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

        return view('wali-kelas-pages.class_reports.show', compact(
            'class',
            'students',
            'grades',
            'subjects',
            'schoolYears',
            'schoolYear',
            'attendances'
        ));
    }
    
    public function exportCsv(Request $request, $class_id)
    {
        $class = StudentClass::where('id', $class_id)
            ->where('wali_kelas_id', auth()->id())
            ->firstOrFail();

        $schoolYear = SchoolYear::findOrFail($request->school_year_id);

        $subjects = Subject::whereIn('kelompok_mapel', ['Mata Pelajaran Wajib', 'Muatan Lokal'])->get();

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

        $filename = 'Rapor ' . $class->nama . ' Semester ' 
            . ($schoolYear->semester === 'Ganjil' ? 'I (Satu)' : 'II (Dua)') 
            . ' Tahun Ajar ' . $schoolYear->tahun_awal . '-' . $schoolYear->tahun_akhir . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($students, $subjects, $class, $schoolYear) {
            $handle = fopen('php://output', 'w');
        
            // Header Judul
            fputcsv($handle, ['LEGGER NILAI RAPOR KELAS ' . strtoupper($class->nama)]);
            $semesterRomawi = $schoolYear->semester === 'Ganjil' ? 'I (Satu)' : 'II (Dua)';
            $tahunPelajaran = $schoolYear->tahun_awal . ' / ' . $schoolYear->tahun_akhir;
            fputcsv($handle, ["Semester $semesterRomawi Tahun Pelajaran $tahunPelajaran"]);
            fputcsv($handle, []);
        
            // Header kolom
            $columns = ['Nama Lengkap'];
            foreach ($subjects as $subject) {
                $columns[] = $subject->singkatan ?? $subject->nama;
            }
            $columns = array_merge($columns, ['Sakit', 'Izin', 'Alfa', 'Jumlah', 'Rata-Rata']);
            fputcsv($handle, $columns);
        
            // Untuk menghitung rata-rata tiap kolom
            $nilaiTotalPerMapel = array_fill_keys($subjects->pluck('id')->toArray(), 0);
            $jumlahNilaiPerMapel = array_fill_keys($subjects->pluck('id')->toArray(), 0);
            $totalSakit = $totalIzin = $totalAlfa = $totalJumlah = $totalRataRata = 0;
            $totalSiswaDenganNilai = 0;
        
            foreach ($students as $student) {
                $row = [$student->nama];
                $nilaiArray = [];
        
                foreach ($subjects as $subject) {
                    $nilai = optional($student->grades->firstWhere('subject_id', $subject->id))->nilai;
                    $row[] = $nilai ?? '-';
        
                    if (is_numeric($nilai)) {
                        $nilaiArray[] = floatval($nilai);
                        $nilaiTotalPerMapel[$subject->id] += floatval($nilai);
                        $jumlahNilaiPerMapel[$subject->id]++;
                    }
                }
        
                $sakit = $student->absensi['sakit'] ?? 0;
                $izin = $student->absensi['izin'] ?? 0;
                $alfa = $student->absensi['alfa'] ?? 0;
        
                $row[] = $sakit;
                $row[] = $izin;
                $row[] = $alfa;
        
                $jumlah = array_sum($nilaiArray);
                $rata = count($nilaiArray) > 0 ? round($jumlah / count($nilaiArray), 2) : '-';
        
                $row[] = $jumlah;
                $row[] = $rata;
        
                // Akumulasi absensi & jumlah/rata-rata
                $totalSakit += $sakit;
                $totalIzin += $izin;
                $totalAlfa += $alfa;
        
                if ($rata !== '-') {
                    $totalJumlah += $jumlah;
                    $totalRataRata += $rata;
                    $totalSiswaDenganNilai++;
                }
        
                fputcsv($handle, $row);
            }
        
            // Baris Nilai Rata-rata
            $averageRow = ['Nilai Rata-Rata'];
            foreach ($subjects as $subject) {
                $count = $jumlahNilaiPerMapel[$subject->id];
                $total = $nilaiTotalPerMapel[$subject->id];
                $averageRow[] = $count > 0 ? round($total / $count, 2) : '-';
            }
        
            // Rata-rata absensi dan nilai total
            $jumlahSiswa = count($students);
            $averageRow[] = $jumlahSiswa > 0 ? round($totalSakit / $jumlahSiswa, 2) : '-';
            $averageRow[] = $jumlahSiswa > 0 ? round($totalIzin / $jumlahSiswa, 2) : '-';
            $averageRow[] = $jumlahSiswa > 0 ? round($totalAlfa / $jumlahSiswa, 2) : '-';
            $averageRow[] = $totalSiswaDenganNilai > 0 ? round($totalJumlah / $totalSiswaDenganNilai, 2) : '-';
            $averageRow[] = $totalSiswaDenganNilai > 0 ? round($totalRataRata / $totalSiswaDenganNilai, 2) : '-';
        
            fputcsv($handle, $averageRow);
        
            fclose($handle);
        };        

        return response()->stream($callback, 200, $headers);
    }
}
