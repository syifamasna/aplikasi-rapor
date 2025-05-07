<?php

namespace App\Http\Controllers\GuruMapel;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $activeRoleId = session('active_role');
        $activeRole = Role::find($activeRoleId)?->role ?? 'Tidak ada peran aktif';

        return view('guru-mapel-pages.profile.index', compact('user', 'activeRole'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $id = $user->id; // ID user yang sedang login

        // Validasi hanya field yang dikirim
        $request->validate([
            'nama' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'sometimes|nullable|string|min:8',
            'nip' => 'sometimes|nullable|string|max:50|unique:users,nip,' . $id,
            'nuptk' => 'sometimes|nullable|string|max:50|unique:users,nuptk,' . $id,
            'telepon' => 'sometimes|nullable|string|max:20',
            'alamat' => 'sometimes|nullable|string|max:255',
            'jk' => 'sometimes|required|string|in:Laki-Laki,Perempuan',
            'image' => 'sometimes|nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        foreach (['nama', 'email', 'nip', 'nuptk', 'telepon', 'alamat', 'jk'] as $key) {
            if ($request->has($key)) {
                $user->$key = $request->input($key) !== '' ? $request->input($key) : null;
            }
        }        

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada
            if ($user->image && Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // Simpan foto baru
            $imagePath = $request->file('image')->store('images', 'public');
            $user->image = $imagePath;
        }

        $user->save();

        return redirect()->route('admin.profile.index')->with('success', 'Profil berhasil diperbarui.');
    }


    public function destroyImage()
    {
        $user = Auth::user();

        if ($user->image && Storage::disk('public')->exists($user->image)) {
            Storage::disk('public')->delete($user->image);
            $user->image = null;
            $user->save();
        }

        return redirect()->route('guru_mapel.profile.index')->with('success', 'Foto profil berhasil dihapus.');
    }
}
