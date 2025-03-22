<?php

namespace App\Http\Controllers\GuruMapel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Teaching;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user(); 

        // Data pembelajaran yang diajar oleh guru login
        $teachings = Teaching::with(['subject', 'class', 'teacher'])
            ->where('user_id', $user->id)
            ->orderBy('subject_id')
            ->get();

        $totalPembelajaran = $teachings->count(); // Hitung dari $teachings, bukan Grade::count()

        // Ambil daftar mata pelajaran & kelas yang diajar oleh guru login
        $subjects = \App\Models\Subject::whereIn('id', $teachings->pluck('subject_id'))->orderBy('nama')->get();
        $classes = \App\Models\StudentClass::whereIn('id', $teachings->pluck('class_id'))->orderBy('nama')->get();

        return view('guru-mapel-pages.dashboard.index', compact('teachings', 'subjects', 'classes', 'totalPembelajaran'));
    }
}