<?php

namespace App\Http\Controllers\PjPrestasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Achievement;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPrestasi = Achievement::count();

        return view('pj-prestasi-pages.dashboard.index', compact('totalPrestasi'));
    }
}