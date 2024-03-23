<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JenisTransaksi;
use Illuminate\Http\Request;

class JenisTransaksiController extends Controller
{

    public function index()
    {
        $jenis = JenisTransaksi::all();
        return response()->view('pages.jenis-transaksi.index', compact('jenis'));
    }

    public function create()
    {
        return response()->view('pages.jenis-transaksi.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'jenis' => 'required',
        ], [
            'jenis.required' => 'Kolom jenis transaksi wajib diisi.',
        ]);

        try {
            $jenis = new JenisTransaksi();
            $jenis->jenis = $request->jenis;
            $jenis->save();

            return redirect()->route('jenis-transaksi.index')->with('success', 'Data baru berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->route('jenis-transaksi.create')->with('error', 'Terjadi kesalahan saat input data!');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $jenis = JenisTransaksi::findOrFail($id);
        return response()->view('pages.jenis-transaksi.edit', compact('jenis'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'jenis' => 'required',
        ], [
            'jenis.required' => 'Kolom jenis transaksi wajib diisi.',
        ]);

        try {
            $jenis = JenisTransaksi::findOrFail($id);
            $jenis->fill($request->all());
            $jenis->save();

            return redirect()->route('jenis-transaksi.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('jenis-transaksi.edit')->with('error', 'Terjadi kesalahan saat memeperbarui data!');
        }
    }

    public function destroy($id)
    {
        try {
            $jenis = JenisTransaksi::findOrFail($id);
            $jenis->delete();

            return redirect()->route('jenis-transaksi.index')->with('success', 'Data berhasil dihapus');
        } catch (\Throwable $th) {
            return redirect()->route('jenis-transaksi.index')->with('error', 'Terjadi kesalahan saat menghapus data!');
        }
    }
}
