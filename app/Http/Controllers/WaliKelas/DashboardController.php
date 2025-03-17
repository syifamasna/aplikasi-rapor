<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil semua ID kelas yang diampu oleh wali kelas yang sedang login
        $classIds = \App\Models\StudentClass::where('wali_kelas_id', auth()->id())
            ->pluck('id'); 

        // Hitung jumlah siswa yang ada di kelas-kelas tersebut
        $totalSiswa = \App\Models\Student::whereIn('class_id', $classIds)->count();

        return view('wali-kelas-pages.dashboard.index', compact('totalSiswa'));
    }
}
