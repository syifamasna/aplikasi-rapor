<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    // Menampilkan daftar tahun ajar
    public function index(Request $request)
    {
        $keyword = $request->input('keyword', '');

        $schoolYears = SchoolYear::whereRaw("CONCAT(tahun_awal, '/', tahun_akhir) LIKE ?", ["%$keyword%"])
            ->orderBy('tahun_awal', 'asc')
            ->orderBy('semester', 'asc')
            ->get();

        return view('admin-pages.school_years.index', compact('schoolYears', 'keyword'));
    }

    // Menampilkan form untuk menambah tahun ajar baru
    public function create()
    {
        return view('admin-pages.school_years.create');
    }

    // Menyimpan tahun ajar baru
    public function store(Request $request)
    {
        $request->validate([
            'tahun_awal' => 'required|integer|min:2000|max:2100',
            'tahun_akhir' => 'required|integer|gt:tahun_awal',
            'semester' => 'required|in:Ganjil,Genap,"Tengah Semester Ganjil","Tengah Semester Genap"',
            'tempat_rapor' => 'nullable|string|max:255',
            'tanggal_rapor' => 'nullable|date',
        ]);

        try {
            SchoolYear::create($request->all());
            return redirect()->route('admin.school_years.index')->with('success', 'Tahun ajar berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('admin.school_years.index')->with('error', 'Terjadi kesalahan saat menambahkan data.');
        }
    }

    // Menampilkan form edit tahun ajar
    public function edit($id)
    {
        $schoolYear = SchoolYear::findOrFail($id);
        return view('admin-pages.school_years.edit', compact('schoolYear'));
    }

    // Memperbarui data tahun ajar
    public function update(Request $request, $id)
    {
        $request->validate([
            'tahun_awal' => 'required|integer|min:2000|max:2100',
            'tahun_akhir' => 'required|integer|gt:tahun_awal',
            'semester' => 'required|in:Ganjil,Genap,"Tengah Semester Ganjil","Tengah Semester Genap"',
            'tempat_rapor' => 'nullable|string|max:255',
            'tanggal_rapor' => 'nullable|date',
        ]);

        try {
            $schoolYear = SchoolYear::findOrFail($id);
            $schoolYear->update($request->all());

            return redirect()->route('admin.school_years.index')->with('success', 'Tahun ajar berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('admin.school_years.index')->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }

    // Menghapus tahun ajar
    public function destroy($id)
    {
        try {
            $schoolYear = SchoolYear::findOrFail($id);
            $schoolYear->delete();

            return redirect()->route('admin.school_years.index')->with('success', 'Tahun ajar berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.school_years.index')->with('error', 'Terjadi kesalahan saat menghapus data.');
        }
    }
}
