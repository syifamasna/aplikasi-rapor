<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with('roles')
            ->withCount('roles') // Hitung jumlah roles untuk sorting tambahan
            ->orderByRaw("
                CASE 
                    WHEN EXISTS (SELECT 1 FROM role_user WHERE role_user.user_id = users.id AND role_user.role_id = (SELECT id FROM roles WHERE role = 'admin')) THEN 1
                    WHEN EXISTS (SELECT 1 FROM role_user WHERE role_user.user_id = users.id AND role_user.role_id = (SELECT id FROM roles WHERE role = 'wali kelas')) THEN 2
                    WHEN EXISTS (SELECT 1 FROM role_user WHERE role_user.user_id = users.id AND role_user.role_id = (SELECT id FROM roles WHERE role = 'guru mapel')) THEN 3
                    WHEN EXISTS (SELECT 1 FROM role_user WHERE role_user.user_id = users.id AND role_user.role_id = (SELECT id FROM roles WHERE role = 'pj prestasi')) THEN 4
                    ELSE 5
                END
            ") // Urutkan berdasarkan role tertinggi
            ->orderBy('users.nama'); // Urutkan berdasarkan nama pengguna

        // Filter berdasarkan peran jika ada
        if ($request->has('role') && $request->role != '') {
            $query->whereHas('roles', function ($q) use ($request) {
                $q->where('roles.id', $request->role);
            });
        }

        $users = $query->get();
        $roles = Role::all();

        return view('admin-pages.users.index', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin-pages.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        try {
            Log::info('Data masuk:', $request->all());

            if (!$request->has('roles') || empty($request->roles)) {
                return back()->withErrors(['roles' => 'Harap pilih setidaknya satu tipe pengguna.'])->withInput();
            }
    
            $user = User::create([
                'nama' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nip' => $request->nip,
                'nuptk' => $request->nuptk,
                'telepon' => $request->telepon,
                'alamat' => $request->alamat,
                'jk' => $request->jk,
            ]);
    
            // Ambil ID dari role berdasarkan nama yang dikirim dari form
            Log::info('Roles dari request:', $request->roles);
            $roleIds = Role::whereIn('id', $request->roles)->pluck('id')->toArray();
            
            Log::info('Role IDs yang ditemukan:', $roleIds);
    
            // Simpan ke tabel pivot role_user
            $user->roles()->attach($roleIds);
            Log::info('Role berhasil ditambahkan ke role_user untuk user_id: ' . $user->id);
    
            return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Error saat menyimpan pengguna: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan pengguna.']);
        }
    }    
    
    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $roles = Role::all();
        return view('admin-pages.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        if (!$request->has('roles') || empty($request->roles)) {
            return back()->withErrors(['roles' => 'Harap pilih setidaknya satu tipe pengguna.'])->withInput();
        }

        $user = User::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'nip' => 'nullable|string|max:50|unique:users,nip,' . $id,
            'nuptk' => 'nullable|string|max:50|unique:users,nuptk,' . $id,
            'telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'jk' => 'required|string|in:Laki-Laki,Perempuan',
            'roles' => 'required|array|exists:roles,id',
        ]);

        $data = $request->except(['password', 'roles']);

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        $user->roles()->sync($request->roles);

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus!');
    }
}
