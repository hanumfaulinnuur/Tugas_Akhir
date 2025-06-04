<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\JenisSurat;
use App\Models\Admin\SuratMasuk;


class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // $suratMasuk = SuratMasuk::orderBy('tanggal', 'desc')->get();
    $jenisSurat = JenisSurat::all(); // ambil data jenis surat untuk dropdown
    $suratMasuk = SuratMasuk::with('jenisSurat')->get(); // ambil data surat masuk beserta jenis suratnya (pastikan relasi 'jenisSurat' ada di model SuratMasuk)

    return view('komponen.surat-masuk', compact('jenisSurat', 'suratMasuk'));
}

//     public function riwayat()
// {
//     $suratMasuk = SuratMasuk::with('jenisSurat')->orderBy('tanggal', 'desc')->get();
//     return view('riwayat.masuk', compact('suratMasuk'));
// }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $suratMasuk = SuratMasuk::create($request->all());
        return redirect()->route('surat-masuk')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'kode_surat' => 'required|string|max:255',
        'nomor_surat' => 'required|numeric',
        'id_jenis_surat' => 'required|exists:jenis_surats,id', // atau 'integer' jika id
        'judul_surat' => 'required|string|max:255',
        'tanggal_surat' => 'required|date',
        'deskripsi' => 'nullable|string',
    ]);

    SuratMasuk::create([
        'kode_surat' => $request->kode_surat,
        'nomor_surat' => $request->nomor_surat,
        'id_jenis_surat' => $request->id_jenis_surat,
        'judul_surat' => $request->judul_surat,
        'tanggal_surat' => $request->tanggal_surat,
        'deskripsi' => $request->deskripsi,
    ]);

    return redirect()->back()->with('success', 'Surat berhasil disimpan.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $suratMasuk = SuratMasuk::find($id);

        if (!$suratMasuk) {
            return redirect()->route('show')->with('error', 'data tidak ditemukan');
        }

        return view('komponen.detail-data', compact('suratMasuk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $validate = $request->validate([
            'kode_surat' => 'required',
            'nomor_surat' => 'required',
            'id_jenis_surat' => 'exists:jenis_surats,id',
            'judul_surat' => 'required',
            'tanggal_surat' => 'required',
            'deskripsi' => 'required'
        ]);
        $data = SuratMasuk::find($id);
        $data->update($validate);
        return redirect()->route('surat-masuk')->with('sukses', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = SuratMasuk::find($id);
        $data->delete();
        return redirect()->route('surat-masuk')->with('sukses', 'Data Berhasil Dihapus');
    }
}
