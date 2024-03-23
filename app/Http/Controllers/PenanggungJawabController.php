<?php

namespace App\Http\Controllers;

use App\Models\PenanggungJawab;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class PenanggungJawabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $penanggungJawab = PenanggungJawab::all();
        return response()->view('pages.penanggung-jawab.index', compact('penanggungJawab'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return response()->view('pages.penanggung-jawab.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {

        $this->validate($request, [
            'nama_lengkap' => 'required',
            'no_hp' => 'required|unique:penanggung_jawab,no_hp|regex:/^\d{9,12}$/',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ], [
            'nama_lengkap.required' => 'Kolom nama lengkap wajib diisi.',
            'no_hp.required' => 'Kolom nomor handphone wajib diisi.',
            'no_hp.unique' => 'Nomor handphone sudah terdaftar.',
            'no_hp.regex' => 'Format nomor handphone tidak valid. Nomor handphone harus terdiri dari 9 hingga 12 digit angka.',
            'alamat.required' => 'Kolom alamat wajib diisi.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format gambar tidak valid. Gunakan format JPG, JPEG, PNG, GIF, atau SVG.',
            'foto.max' => 'Ukuran gambar tidak boleh melebihi 2048 kilobita.',
        ]);
        try {
            $penanggungJawab = new PenanggungJawab;
            $penanggungJawab->nama_lengkap = $request->input('nama_lengkap');
            $penanggungJawab->no_hp = $request->input('no_hp');
            $penanggungJawab->alamat = $request->input('alamat');


            // Memeriksa apakah file foto diunggah
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('img/penanggung-jawab'), $fotoName);
                $penanggungJawab->foto = $fotoName;
            }

            $penanggungJawab->save();

            return redirect()->route('penanggung-jawab.index')->with('success', 'Data baru berhasil disimpan');
        } catch (\Exception $e) {
            return redirect()->route('penanggung-jawab.index')->with('error', 'Terjadi kesalahan saat input data!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PenanggungJawab  $penanggungJawab
     * @return \Illuminate\Http\Response
     */
    public function show(PenanggungJawab $penanggungJawab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PenanggungJawab  $penanggungJawab
     * @return \Illuminate\Http\Response
     */
    public function edit(PenanggungJawab $penanggungJawab)
    {
        $penanggungJawab = PenanggungJawab::findOrFail($penanggungJawab->id);
        return response()->view('pages.penanggung-jawab.edit', compact('penanggungJawab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PenanggungJawab  $penanggungJawab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PenanggungJawab $penanggungJawab): RedirectResponse
    {
        $this->validate($request, [
            'nama_lengkap' => 'required',
            'no_hp' => 'required|unique:penanggung_jawab,no_hp,' . $penanggungJawab->id . '|regex:/^\d{9,12}$/',
            'alamat' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ], [
            'nama_lengkap.required' => 'Kolom nama lengkap wajib diisi.',
            'no_hp.required' => 'Kolom nomor handphone wajib diisi.',
            'no_hp.unique' => 'Nomor handphone sudah terdaftar.',
            'no_hp.regex' => 'Format nomor handphone tidak valid. Nomor handphone harus terdiri dari 9 hingga 12 digit angka.',
            'alamat.required' => 'Kolom alamat wajib diisi.',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Format gambar tidak valid. Gunakan format JPG, JPEG, PNG, GIF, atau SVG.',
            'foto.max' => 'Ukuran gambar tidak boleh melebihi 2048 kilobita.',
        ]);

        try {
            // Update data penanggung jawab
            $penanggungJawab->nama_lengkap = $request->input('nama_lengkap');
            $penanggungJawab->no_hp = $request->input('no_hp');
            $penanggungJawab->alamat = $request->input('alamat');

            // Memeriksa apakah file foto diunggah
            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $fotoName = time() . '.' . $foto->getClientOriginalExtension();
                $foto->move(public_path('img/penanggung-jawab'), $fotoName);
                $penanggungJawab->foto = $fotoName;
            }

            $penanggungJawab->save();

            return redirect()->route('penanggung-jawab.index')->with('success', 'Data berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('penanggung-jawab.index')->with('error', 'Terjadi kesalahan saat memperbarui data!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PenanggungJawab  $penanggungJawab
     * @return \Illuminate\Http\Response
     */
    public function destroy(PenanggungJawab $penanggungJawab): RedirectResponse
    {
        if ($penanggungJawab->foto) {
            unlink('img/penanggung-jawab/' . $penanggungJawab->foto);
        }

        $penanggungJawab->delete();

        return redirect()->route('penanggung-jawab.index')->with('success', 'Data berhasil dihapus');
    }
}
