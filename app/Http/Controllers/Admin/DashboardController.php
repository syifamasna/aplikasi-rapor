<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement;
use App\Models\User;
use App\Models\Student;
use App\Models\Subject;
use App\Models\StudentClass;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSiswa = Student::count();
        $totalMapel = Subject::count();
        $totalKelas = StudentClass::count();
        $totalPengguna = User::count();

        return view('admin-pages.dashboard.index', compact('totalSiswa', 'totalMapel', 'totalKelas', 'totalPengguna'));
    }
}