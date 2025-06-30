<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\JenisSurat;
use Illuminate\Http\Request;
use App\Models\Pegawai\Pegawai;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = Pegawai::all();
        $jenisSurat = JenisSurat::all();
        return view('komponen.data-master.pegawai', compact('pegawai', 'jenisSurat'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($request)
    {
        $pegawai = Pegawai::create($request->all());
        return redirect()->route('komponen.data-master.data')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nik_pegawai'    => 'required|numeric',
        'nama_pegawai'   => 'required|string|max:255', 
        'tempat_lahir'   => 'required|string|max:255',
        'tanggal_lahir'  => 'required|date',
        'jenis_kelamin'  => 'required|string',
        'agama' => 'required|string',
        'no_telp' => 'required|string|max:20',
        'email' => 'required|string|email',

    ]);

    Pegawai::create([
        'nik_pegawai' => $request->nik_pegawai,
        'nama_pegawai' => $request->nama_pegawai,
        'tempat_lahir' => $request->tempat_lahir,
        'tanggal_lahir' => $request->tanggal_lahir,
        'jenis_kelamin' => $request->jenis_kelamin,
        'agama' => $request->agama,
        'no_telp' => $request->no_telp,
        'email' => $request->email,
        
    ]);

    return redirect()->back()->with('success', 'Surat berhasil disimpan.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $pegawai = pegawai::find($id);

        if (!$pegawai) {
            return redirect()->route('show')->with('error', 'data tidak ditemukan');
        }

        return view('komponen.data-master.pegawai', compact('pegawai'));
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
       $validated = $request->validate([
            'nik_pegawai'    => 'required|numeric',
        'nama_pegawai'   => 'required|string|max:255', 
        'tempat_lahir'   => 'required|string|max:255',
        'tanggal_lahir'  => 'required|date',
        'jenis_kelamin'  => 'required|string',
        'agama' => 'required|string',
        'no_telp' => 'required|string|max:20',
        'email' => 'required|string|email',
        ]);
    
    $data = Pegawai::find($id);
        $data->update($validated);
        return redirect()->route('komponen.data-master.data')->with('sukses', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $data = Pegawai::find($id);
        $data->delete();
        return redirect()->route('komponen.data-master.data')->with('sukses', 'Data Berhasil Dihapus');
    }
}
