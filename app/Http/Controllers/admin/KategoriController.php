<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{

    public function index()
    {
        $kategori = Kategori::all();
        return response()->view('pages.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return response()->view('pages.kategori.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
        ], [
            'nama.required' => 'Kolom nama kategori wajib diisi.',
        ]);

        try {
            $kategori = new Kategori;
            $kategori->nama = $request->nama;
            $kategori->save();

            return redirect()->route('kategori.index')->with('success', 'Data baru berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->route('kategori.create')->with('error', 'Terjadi kesalahan saat input data!');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $kategori = Kategori::findOrFail($id);
        return response()->view('pages.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
        ], [
            'nama.required' => 'Kolom nama kategori wajib diisi.',
        ]);

        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->fill($request->all());
            $kategori->save();

            return redirect()->route('kategori.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('kategori.edit')->with('error', 'Terjadi kesalahan saat memeperbarui data!');
        }
    }

    public function destroy($id)
    {
        try {
            $kategori = Kategori::findOrFail($id);
            $kategori->delete();

            return redirect()->route('kategori.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('kategori.index')->with('error', 'Terjadi kesalahan saat menghapus data!');
        }
    }
}
