<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\SuratMasuk;
use App\Http\Controllers\Controller;
use App\Models\Admin\JenisSurat;
use App\Models\Admin\SuratKeluarEksternal;
use App\Models\Admin\SuratKeluarInternal;
use Illuminate\Http\Request;

class RiwayatSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
    {
        $suratMasuk = SuratMasuk::with('jenisSurat')->latest()->get();
        $ski = SuratKeluarInternal::with('jenisSurat')->latest()->get();
        $ske = SuratKeluarEksternal::with('jenisSurat')->latest()->get();
        $jenisSurat = JenisSurat::all();
        return view('komponen.riwayat-surat', compact('suratMasuk', 'ski', 'ske', 'jenisSurat'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = SuratMasuk::find($id);
        $data->delete();
        return redirect()->route('suratMasuk')->with('sukses', 'Data Berhasil Dihapus');
    }
}
