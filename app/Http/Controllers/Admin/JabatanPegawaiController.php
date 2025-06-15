<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai\Jabatan;
use App\Models\Pegawai\JabatanPegawai;
use App\Models\Pegawai\Pegawai;
use App\Models\Pegawai\Unit;
use Illuminate\Http\Request;

class JabatanPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $pegawai = Pegawai::all();
    $jabatan = Jabatan::all();
    $jabatans = JabatanPegawai::with(['pegawai', 'jabatan'])->get(); 
    return view('komponen.data-master.jabatanpeg', compact('pegawai', 'jabatan', 'jabatans'));
}

public function store(Request $request)
{
    $request->validate([
        'id_pegawai' => 'required',
        'id_jabatan' => 'required',
    ]);

    JabatanPegawai::create([
        'id_pegawai' => $request->id_pegawai,
        'id_jabatan' => $request->id_jabatan,
    ]);

    return redirect()->back()->with('success', 'Data berhasil disimpan.');
}

public function update(Request $request, string $id)
{
    $validated = $request->validate([
        'id_pegawai' => 'required',
        'id_jabatan' => 'required',
    ]);

    $data = JabatanPegawai::findOrFail($id);
    $data->update($validated);

    return redirect()->route('komponen.data-master.jabatanpeg')->with('sukses', 'Data berhasil diupdate.');
}

public function destroy(string $id)
{
    $data = JabatanPegawai::findOrFail($id);
    $data->delete();
    return redirect()->route('komponen.data-master.jabatanpeg')->with('sukses', 'Data berhasil dihapus.');
}

}
