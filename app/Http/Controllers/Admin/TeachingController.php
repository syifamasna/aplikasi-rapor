<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teaching;
use App\Models\Subject;
use App\Models\StudentClass;
use App\Models\User;

class TeachingController extends Controller
{
    /**
     * Menampilkan daftar pembelajaran dengan filter.
     */
    public function index(Request $request)
    {
        // Query dengan eager loading, diurutkan berdasarkan ID mata pelajaran dan nama kelas
        $query = Teaching::with(['subject', 'class', 'teacher'])
            ->join('student_classes', 'teachings.class_id', '=', 'student_classes.id')
            ->orderBy('teachings.subject_id')
            ->orderBy('student_classes.nama');

        // Filter berdasarkan kelas
        if ($request->has('class_id') && $request->class_id != '') {
            $query->where('teachings.class_id', $request->class_id);
        }

        // Filter berdasarkan mata pelajaran
        if ($request->has('subject_id') && $request->subject_id != '') {
            $query->where('teachings.subject_id', $request->subject_id);
        }

        // Filter berdasarkan guru
        if ($request->has('user_id') && $request->user_id != '') {
            $query->where('teachings.user_id', $request->user_id);
        }

        // Ambil data yang sudah difilter
        $teachings = $query->select('teachings.*')->get();

        // Ambil semua mata pelajaran (diurutkan berdasarkan ID)
        $subjects = Subject::orderBy('id')->get();

        // Ambil semua kelas (diurutkan berdasarkan abjad)
        $classes = StudentClass::orderBy('nama')->get();

        // Ambil semua guru (diurutkan berdasarkan abjad)
        $teachers = User::whereHas('roles', function ($query) {
            $query->whereIn('role', ['Wali Kelas', 'Guru Mapel']);
        })->orderBy('nama')->get();

        // Kirim data ke view
        return view('admin-pages.teachings.index', compact('teachings', 'subjects', 'classes', 'teachers'));
    }

    /**
     * Menyimpan data pembelajaran baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:student_classes,id',
            'user_id' => 'required|exists:users,id',
        ]);

        Teaching::create([
            'subject_id' => $request->subject_id,
            'class_id' => $request->class_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin.teachings.index')->with('success', 'Pembelajaran berhasil ditambahkan.');
    }

    /**
     * Memperbarui data pembelajaran.
     */
    public function update(Request $request, $id)
    {
        $teaching = Teaching::findOrFail($id);

        $request->validate([
            'subject_id' => 'required|exists:subjects,id',
            'class_id' => 'required|exists:student_classes,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $teaching->update([
            'subject_id' => $request->subject_id,
            'class_id' => $request->class_id,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('admin.teachings.index')->with('success', 'Pembelajaran berhasil diperbarui.');
    }

    /**
     * Menghapus data pembelajaran.
     */
    public function destroy($id)
    {
        $teaching = Teaching::findOrFail($id);
        $teaching->delete();

        return redirect()->route('admin.teachings.index')->with('success', 'Pembelajaran berhasil dihapus.');
    }
}
