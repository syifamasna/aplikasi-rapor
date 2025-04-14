<?php

namespace App\Http\Controllers\PjPrestasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\StudentClass;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{   
    public function index()
    {
        $totalPrestasi = Achievement::count();

        $prestasiPerKelas = DB::table('achievements')
            ->join('students', 'achievements.student_id', '=', 'students.id')
            ->join('student_classes', 'students.class_id', '=', 'student_classes.id')
            ->select('student_classes.nama as kelas', DB::raw('COUNT(*) as total'))
            ->groupBy('student_classes.nama')
            ->orderBy('student_classes.nama')
            ->get();

        return view('pj-prestasi-pages.dashboard.index', compact('totalPrestasi', 'prestasiPerKelas'));
    }
}
