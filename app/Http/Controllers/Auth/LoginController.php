<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;

class LoginController extends Controller
{
    // Tampilkan form login dengan daftar role pengguna
    public function showLoginForm()
    {
        $roles = Role::all(); // Ambil semua role yang tersedia
        return view('auth.login', compact('roles'));
    }

    // Proses login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|exists:roles,id' // Pastikan role yang dipilih valid
        ]);

        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Periksa apakah user memiliki role yang dipilih
            if (!$user->roles->contains('id', $request->role)) {
                Auth::logout();
                return back()->with('error', 'Anda tidak memiliki akses ke peran yang dipilih.');
            }

            // Simpan role yang dipilih ke sesi
            session(['active_role' => $request->role]);

            // Redirect ke dashboard sesuai role
            return $this->redirectToDashboard($request->role);
        }

        return back()->with('error', 'Email atau password salah. Silakan coba lagi.');
    }

    private function redirectToDashboard($roleId)
    {
        // Ambil role berdasarkan ID
        $role = Role::find($roleId);
    
        return match ($role->role) {
            'Admin' => redirect()->route('admin.dashboard')->with('success', 'Berhasil login sebagai Admin.'),
            'Guru Mapel' => redirect()->route('guru_mapel.dashboard')->with('success', 'Berhasil login sebagai Guru Mapel.'),
            'Wali Kelas' => redirect()->route('wali_kelas.dashboard')->with('success', 'Berhasil login sebagai Wali Kelas.'),
            'Pj Prestasi' => redirect()->route('pj_prestasi.dashboard')->with('success', 'Berhasil login sebagai PJ Prestasi.'),
            default => redirect()->route('login')->with('error', 'Role tidak dikenali.'),
        };
    }    

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }
}
