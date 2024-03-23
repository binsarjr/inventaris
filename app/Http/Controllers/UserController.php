<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->view('pages.user.index', compact('users'));
    }

    public function create()
    {
        $roles = ['admin', 'manajemen', 'anggota'];
        return response()->view('pages.user.create', compact('roles'));
    }

    public function store(Request $request): RedirectResponse
    {

        $this->validate($request, [
            'nama_lengkap' => 'required',
            'username' => 'required|unique:user,username',
            'role' => 'required|in:admin,manajemen,anggota',
            'password' => 'required|min:8',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ], [
            'nama_lengkap.required' => 'Kolom nama lengkap wajib diisi.',
            'username.required' => 'Kolom username wajib diisi.',
            'username.unique' => 'Username sudah terdaftar.',
            'role.required' => 'Kolom role wajib diisi.',
            'role.in' => 'Role yang dipilih tidak valid.',
            'password.required' => 'Kolom password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format gambar tidak valid. Gunakan format JPG, JPEG, PNG, GIF, atau SVG.',
            'foto.max' => 'Ukuran gambar tidak boleh melebihi 2048 kilobita.',
        ]);

        try {
            $user = new User;
            $user->nama_lengkap = $request->input('nama_lengkap');
            $user->username = $request->input('username');
            $user->role = $request->input('role');
            $user->password = bcrypt($request->input('password'));
            $user->remember_token = Str::random(10);

            // Memeriksa apakah file foto diunggah
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('img/user'), $fotoName);
                $user->foto = $fotoName;
            }

            $user->save();

            return redirect()->route('user.index')->with('success', 'Data baru berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Terjadi kesalahan saat input data!');
        }
    }

    public function edit(User $user)
    {
        $roles = ['admin', 'manajemen', 'anggota'];
        $user = User::findOrFail($user->id);
        return response()->view('pages.user.edit', compact('roles', 'user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {

        $this->validate($request, [
            'nama_lengkap' => 'required',
            'username' => 'required|unique:user,username,' . $user->id,
            'role' => 'required|in:admin,manajemen,anggota',
            'password' => 'nullable|min:8',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ], [
            'nama_lengkap.required' => 'Kolom nama lengkap wajib diisi.',
            'username.required' => 'Kolom username wajib diisi.',
            'username.unique' => 'Username sudah terdaftar.',
            'role.required' => 'Kolom role wajib diisi.',
            'role.in' => 'Role yang dipilih tidak valid.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format gambar tidak valid. Gunakan format JPG, JPEG, PNG, GIF, atau SVG.',
            'foto.max' => 'Ukuran gambar tidak boleh melebihi 2048 kilobita.',
        ]);

        try {
            $user->nama_lengkap = $request->input('nama_lengkap');
            $user->username = $request->input('username');
            $user->role = $request->input('role');

            // Memeriksa apakah perlu mengupdate password
            if ($request->filled('password')) {
                $user->password = bcrypt($request->input('password'));
            }

            // Memeriksa apakah file foto diunggah
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('img/user'), $fotoName);
                $user->foto = $fotoName;
            }

            $user->save();

            return redirect()->route('user.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('user.index')->with('error', 'Terjadi kesalahan saat memperbarui data!');
        }
    }

    public function destroy(User $user): RedirectResponse
    {
        if ($user->foto) {
            unlink('img/user/' . $user->foto);
        }

        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
    }
}
