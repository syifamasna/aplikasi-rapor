<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        // Ambil keyword pencarian (jika ada)
        $keyword = $request->input('keyword', '');
    
        // Ambil filter kelompok_mapel (jika ada)
        $kelompokMapel = $request->input('kelompok_mapel', '');
    
        // Query awal
        $query = Subject::query();
    
        // Filter berdasarkan keyword nama mata pelajaran
        if (!empty($keyword)) {
            $query->where('nama', 'like', "%$keyword%");
        }
    
        // Filter berdasarkan kelompok_mapel
        if (!empty($kelompokMapel)) {
            $query->where('kelompok_mapel', $kelompokMapel);
        }
    
        // Ambil data tanpa pagination
        $subjects = $query->get();
    
        return view('admin-pages.subjects.index', compact('subjects', 'keyword', 'kelompokMapel'));
    }    

    public function store(Request $request)
    {
        Log::info('Menerima data tambah:', $request->all()); // Debugging

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'singkatan' => 'nullable|string|max:255',
            'kelompok_mapel' => 'required|in:Mata Pelajaran Wajib,Muatan Lokal,Seni dan Budaya'
        ]);

        Subject::create($validated);

        return redirect()->route('admin.subjects.index')->with('success', 'Mata Pelajaran berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        Log::info('Menerima data update:', $request->all()); // Debugging
    
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'singkatan' => 'nullable|string|max:255',
            'kelompok_mapel' => 'required|in:Mata Pelajaran Wajib,Muatan Lokal,Seni dan Budaya'
        ]);
    
        $subject = Subject::findOrFail($id);
        $subject->update($validated);
    
        return redirect()->route('admin.subjects.index')->with('success', 'Mata Pelajaran berhasil diperbarui');
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id); // Mencari mata pelajaran berdasarkan id
        $subject->delete(); // Menghapus mata pelajaran

        return redirect()->route('admin.subjects.index')->with('success', 'Mata Pelajaran berhasil dihapus'); // Mengarahkan kembali ke halaman daftar mata pelajaran
    }
}
