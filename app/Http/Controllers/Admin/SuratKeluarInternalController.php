<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\GenerateNomorSuratTrait;
use App\Models\Admin\SuratKeluarInternal;
use Illuminate\Http\Request;

class SuratKeluarInternalController extends Controller
{
    use GenerateNomorSuratTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SuratKeluarInternal::latest()->get();
        return view('komponen.surat-keluar-int', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.surat-internal.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'tgl_surat' => 'required|date',
        'judul_surat' => 'required|string|max:255',
        'deskripsi_surat' => 'required|string',
    ]);

    // Generate nomor surat otomatis
    $nomorSurat = $this->generateNomorSurat(SuratKeluarInternal::class, 'INT');

    SuratKeluarInternal::create([
        'no_surat' => $nomorSurat,
        'tgl_surat' => $request->tgl_surat,
        'judul_surat' => $request->judul_surat,
        'deskripsi_surat' => $request->deskripsi_surat,
    ]);

    return redirect()->route('surat-internal.index')->with('success', 'Surat berhasil ditambahkan!');
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
        //
    }
}
