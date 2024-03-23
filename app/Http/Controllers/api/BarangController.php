<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Illuminate\Http\Request;
use App\Http\Resources\BarangResource;
use Illuminate\Support\Facades\Validator;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): BarangResource
    {
        $barang = Barang::all();
        return new BarangResource(true, 'Data barang berhasil diambil', $barang);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): BarangResource
    {
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required|integer',
            'kode_barang' => 'required|max:10',
            'nama_barang' => 'required|max:100',
            'deskripsi' => 'required',
            'stok' => 'required|integer',
            'kondisi' => 'required|in:Baik,Rusak',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data barang gagal ditambahkan',
                'data' => $validator->errors()
            ], 400);
        }

        $barang = Barang::create([
            'id_kategori' => $request->id_kategori,
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'kondisi' => $request->kondisi,
        ]);

        return new BarangResource(true, 'Data barang berhasil ditambahkan', $barang);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang): BarangResource
    {
        $barang = Barang::find($barang->id);
        return new BarangResource(true, 'Data barang berhasil diambil', $barang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Barang $barang): BarangResource
    {
        $validator = Validator::make($request->all(), [
            'id_kategori' => 'required|integer',
            'kode_barang' => 'required|max:10',
            'nama_barang' => 'required|max:100',
            'deskripsi' => 'required',
            'stok' => 'required|integer',
            'kondisi' => 'required|in:Baik,Rusak',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Data barang gagal diubah',
                'data' => $validator->errors()
            ], 400);
        }

        $barang->update([
            'id_kategori' => $request->id_kategori,
            'kode_barang' => $request->kode_barang,
            'nama_barang' => $request->nama_barang,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
            'kondisi' => $request->kondisi,
        ]);

        return new BarangResource(true, 'Data barang berhasil diubah', $barang);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Barang $barang): BarangResource
    {
        try {
            $barang->delete();
            return new BarangResource(true, 'Data barang berhasil dihapus', $barang);
        } catch (\Exception $e) {
            return new BarangResource(false, 'Data barang gagal dihapus', $barang);
        }
    }
}
