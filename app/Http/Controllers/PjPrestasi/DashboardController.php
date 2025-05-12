<?php

namespace App\Http\Controllers\PjPrestasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\SchoolYear;
use App\Models\StudentClass;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{   
   public function index(Request $request)
    {
        // Ambil semua tahun ajaran
        $schoolYears = SchoolYear::orderByDesc('tahun_awal')->get();

        // Ambil ID tahun ajaran dari URL (GET), atau pakai yang pertama kalau belum dipilih
        $selectedSchoolYearId = $request->get('school_year_id') ?? optional($schoolYears->first())->id;

        // Hitung total prestasi di tahun ajaran terpilih
        $totalPrestasi = Achievement::where('school_year_id', $selectedSchoolYearId)->count();

        // Ambil jumlah prestasi per kelas berdasarkan tahun ajaran terpilih
        $prestasiPerKelas = DB::table('achievements')
            ->join('students', 'achievements.student_id', '=', 'students.id')
            ->join('student_classes', 'students.class_id', '=', 'student_classes.id')
            ->where('achievements.school_year_id', $selectedSchoolYearId)
            ->select('student_classes.nama as kelas', DB::raw('COUNT(*) as total'))
            ->groupBy('student_classes.nama')
            ->orderBy('student_classes.nama')
            ->get();

        // Kirim ke view
        return view('pj-prestasi-pages.dashboard.index', compact(
            'totalPrestasi',
            'prestasiPerKelas',
            'schoolYears',
            'selectedSchoolYearId'
        ));
    }
}
