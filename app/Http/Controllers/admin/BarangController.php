<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::with('kategori')->orderBy('created_at', 'DESC')->get();
        return response()->view('pages.barang.index', compact('barang'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return response()->view('pages.barang.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_barang' => 'required|max:100',
            'deskripsi' => 'required',
            'stok' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ], [
            'nama_barang.required' => 'Kolom nama barng wajib diisi.',
            'nama_barang.max' => 'Kolom nama barang maksimal 100 karakter.',
            'deskripsi.required' => 'Kolom deskripsi wajib diisi.',
            'stok.required' => 'Kolom stok wajib diisi.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format gambar tidak valid. Gunakan format JPG, JPEG, PNG, GIF, atau SVG.',
            'foto.max' => 'Ukuran gambar tidak boleh melebihi 2048 kilobita.',
        ]);

        try {
            $char = 'KB';
            $random_digits = mt_rand(1000, 9999);
            $kode_barang = $char . $random_digits;

            $newBarang = new Barang();
            $newBarang->nama_barang = $request->nama_barang;
            $newBarang->deskripsi = $request->deskripsi;
            $newBarang->id_kategori = $request->id_kategori;
            $newBarang->kode_barang = $kode_barang;
            $newBarang->stok = $request->stok;
            $newBarang->kondisi = $request->kondisi;

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('img/barang'), $fotoName);
                $newBarang->foto = $fotoName;
            }
            // dd($newBarang);
            $newBarang->save();
            return redirect()->route('barang.index')->with('success', 'Data berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('barang.create')->with('error', 'terjadi gagal ditambahkan');
        }
    }

    public function show($id)
    {
        $barang = Barang::findOrFail($id);
        return response()->view('pages.barang.detail', compact('barang'));
    }

    public function edit($id)
    {
        $barang = Barang::findOrFail($id);
        $kategori = Kategori::all();
        return response()->view('pages.barang.edit', compact('kategori', 'barang'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_barang' => 'required|max:100',
            'deskripsi' => 'required',
            'stok' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ], [
            'nama_barang.required' => 'Kolom nama barng wajib diisi.',
            'nama_barang.max' => 'Kolom nama barang maksimal 100 karakter.',
            'deskripsi.required' => 'Kolom deskripsi wajib diisi.',
            'stok.required' => 'Kolom stok wajib diisi.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format gambar tidak valid. Gunakan format JPG, JPEG, PNG, GIF, atau SVG.',
            'foto.max' => 'Ukuran gambar tidak boleh melebihi 2048 kilobita.',
        ]);

        try {
            $newBarang = Barang::findOrFail($id);
            $newBarang->nama_barang = $request->nama_barang;
            $newBarang->deskripsi = $request->deskripsi;
            $newBarang->id_kategori = $request->id_kategori;
            $newBarang->stok = $request->stok;
            $newBarang->kondisi = $request->kondisi;

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('img/barang'), $fotoName);
                $newBarang->foto = $fotoName;
            }
            // dd($newBarang);
            $newBarang->save();
            return redirect()->route('barang.index')->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            return redirect()->route('barang.edit')->with('error', 'terjadi gagal diupdate');
        }
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        if ($barang->foto) {
            unlink('img/barang/' . $barang->foto);
        }

        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Data barang berhasil dihapus');
    }
}
