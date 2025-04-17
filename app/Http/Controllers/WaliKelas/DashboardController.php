<?php

namespace App\Http\Controllers\WaliKelas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentClass;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil daftar kelas yang diampu oleh wali kelas yang login
        $classes = StudentClass::where('wali_kelas_id', auth()->id())->get();
        
        // Ambil satu kelas pertama yang diampu wali kelas (jika hanya satu kelas)
        $class = $classes->first();

        $classIds = \App\Models\StudentClass::where('wali_kelas_id', auth()->id())
            ->pluck('id');

        $totalSiswa = \App\Models\Student::whereIn('class_id', $classIds)->count();

        $jumlahLaki = \App\Models\Student::whereIn('class_id', $classIds)
            ->where('jk', 'Laki-laki')->count();

        $jumlahPerempuan = \App\Models\Student::whereIn('class_id', $classIds)
            ->where('jk', 'Perempuan')->count();

        return view('wali-kelas-pages.dashboard.index', compact('classes', 'class', 'totalSiswa', 'jumlahLaki', 'jumlahPerempuan'));
    }
}
