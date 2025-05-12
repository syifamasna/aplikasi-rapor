<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\SchoolYear;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $schoolYears = SchoolYear::orderByDesc('tahun_awal')->get();
        $selectedSchoolYearId = $request->get('school_year_id') ?? optional($schoolYears->first())->id;

        $classes = StudentClass::where('wali_kelas_id', auth()->id())->get();
        $class = $classes->first();
        $classIds = StudentClass::where('wali_kelas_id', auth()->id())->pluck('id');

        $totalSiswa = Student::whereIn('class_id', $classIds)->count();
        $jumlahLaki = Student::whereIn('class_id', $classIds)->where('jk', 'Laki-laki')->count();
        $jumlahPerempuan = Student::whereIn('class_id', $classIds)->where('jk', 'Perempuan')->count();

        $rankingTertinggi = Student::with(['grades' => function ($query) use ($selectedSchoolYearId) {
            $query->where('school_year_id', $selectedSchoolYearId);
        }])
        ->whereIn('class_id', $classIds)
        ->get()
        ->map(function ($student) {
            // Hitung rata-rata nilai, jika tidak ada nilai, rata-rata tetap 0
            $averageNilai = $student->grades->avg('nilai');
            return [
                'nama' => $student->nama,
                'average_nilai' => $averageNilai,
            ];
        })
        ->sortByDesc('average_nilai')
        ->take(5)
        ->values();

        return view('wali-kelas-pages.dashboard.index', compact(
            'classes', 'class', 'totalSiswa', 'jumlahLaki', 'jumlahPerempuan',
            'schoolYears', 'selectedSchoolYearId', 'rankingTertinggi'
        ));
    }
}

