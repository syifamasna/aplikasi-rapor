<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\User;
use App\Models\Student;
use App\Models\Subject;
use App\Models\StudentClass;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Student::count();
        $totalMapel = Subject::count();
        $totalKelas = StudentClass::count();
        $totalPengguna = User::count();

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

        return view('admin-pages.dashboard.index', compact(
            'totalSiswa', 'totalMapel', 'totalKelas', 'totalPengguna', 'siswaPerKelas'
        ));
    }
}