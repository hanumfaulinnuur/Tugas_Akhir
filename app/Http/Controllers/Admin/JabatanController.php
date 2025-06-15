<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai\Jabatan;
use App\Models\Pegawai\Unit;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unit = Unit::all();
        $jabatan = Jabatan::all();
        return view('komponen.data-master.jabatan', compact('unit', 'jabatan'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($request)
    {
        $jabatan = Jabatan::create($request->all());
        return redirect()->route('komponen.data-master.jabatan')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nama_jabatan'   => 'required|string|max:255',
        'id_unit'   => 'required|string|max:255',   

    ]);

    Jabatan::create([
        'nama_jabatan' => $request->nama_jabatan,
        'id_unit'   => $request->id_unit,  
        
    ]);

    return redirect()->back()->with('success', 'Surat berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $jabatan = Jabatan::find($id);

        if (!$jabatan) {
            return redirect()->route('show')->with('error', 'data tidak ditemukan');
        }

        return view('komponen.data-master.jabatan', compact('jabatan'));
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
        'nama_jabatan'   => 'required|string|max:255',
        'id_unit'   => 'required|string|max:255',  
        ]);
    
    $data = Jabatan::find($id);
        $data->update($validated);
        return redirect()->route('komponen.data-master.jabatan')->with('sukses', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $data = Jabatan::find($id);
        $data->delete();
        return redirect()->route('komponen.data-master.jabatan')->with('sukses', 'Data Berhasil Dihapus');
    }
}
