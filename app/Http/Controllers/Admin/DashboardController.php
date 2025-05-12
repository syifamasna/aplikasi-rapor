<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\Grade;
use App\Models\User;
use App\Models\Student;
use App\Models\Subject;
use App\Models\SchoolYear;
use App\Models\StudentClass;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalSiswa = Student::count();
        $totalMapel = Subject::count();
        $totalKelas = StudentClass::count();
        $totalPengguna = User::count();
        $totalPrestasi = Achievement::count();

        $siswaPerKelas = Student::select('class_id', DB::raw('count(*) as total'))
            ->groupBy('class_id')
            ->with('class') // relasi ke StudentClass
            ->get()
            ->map(function ($item) {
                return [
                    'kelas' => $item->class->nama ?? 'Tidak diketahui',
                    'total' => $item->total
                ];
            })
            ->sortBy('kelas') // urutkan berdasarkan nama kelas
            ->values(); // reset ulang index agar rapi saat dikirim ke view

               // Ambil semua tahun ajaran
        $schoolYears = SchoolYear::orderByDesc('tahun_awal')->get();

        // Ambil ID tahun ajaran dari URL (GET), atau pakai yang pertama kalau belum dipilih
        $selectedSchoolYearId = $request->get('school_year_id') ?? optional($schoolYears->first())->id;

        $selectedClassId = $request->get('class_id');

        // Ambil daftar semua kelas
        $classes = StudentClass::orderBy('nama')->get();

        // Ambil ranking siswa hanya jika ada class_id yang dipilih
        $rankingTertinggi = [];

        if ($selectedClassId) {
            $rankingTertinggi = Student::with(['grades' => function ($query) use ($selectedSchoolYearId) {
                $query->where('school_year_id', $selectedSchoolYearId);
            }])
            ->where('class_id', $selectedClassId)
            ->get()
            ->map(function ($student) {
                $avg = $student->grades->avg('nilai');
                return [
                    'nama' => $student->nama,
                    'average_nilai' => round($avg, 1),
                ];
            })
            ->sortByDesc('average_nilai')
            ->take(10)
            ->values();
        }

    return view('admin-pages.dashboard.index', compact(
        'totalSiswa', 'totalMapel', 'totalKelas', 'totalPengguna', 'totalPrestasi', 'siswaPerKelas', 'schoolYears', 'selectedSchoolYearId',
        'rankingTertinggi', 'classes', 'selectedClassId'
    ));
    }
}