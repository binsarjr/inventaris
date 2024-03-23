<?php

namespace App\Http\Controllers\anggota;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;

class AnggotaController extends Controller
{
    public function update(Request $request, User $user)
    {

        $this->validate($request, [
            'nama_lengkap' => 'required',
            'username' => 'required' . $user->id,
            'role' => 'required|in:admin,manajemen,anggota',
            'password' => 'nullable|min:8',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ], [
            'nama_lengkap.required' => 'Kolom nama lengkap wajib diisi.',
            'username.required' => 'Kolom username wajib diisi.',
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

            return redirect()->route('pages.anggota.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('pages.anggota.index')->with('error', 'Terjadi kesalahan saat memperbarui data!');
        }
    }

    public function barang()
    {
        $barang = Barang::with('kategori')
            ->whereNotIn('kondisi', ['Rusak'])
            ->where('stok', '>', 0)
            ->orderBy('created_at', 'DESC')
            ->get();
        return response()->view('pages.barang.index', compact('barang'));
    }

    public function riwayat()
    {
        $user = Auth::user();
        $transaksi = Transaksi::where('id_user', $user->id)
            ->whereIn('id_jenis_transaksi', [3, 4])
            ->orderBy('updated_at', 'desc')->get();

        return response()->view('pages.transaksi.index', compact('transaksi'));
    }
}
