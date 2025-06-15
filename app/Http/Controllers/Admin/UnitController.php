<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pegawai\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $unit = Unit::paginate(5);
return view('komponen.data-master.unit', compact('unit'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($request)
    {
        $unit = Unit::create($request->all());
        return redirect()->route('komponen.data-master.unit')->with('sukses', 'Data Berhasil Ditambahkan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nama_unit'   => 'required|string|max:255', 

    ]);

    Unit::create([
        'nama_unit' => $request->nama_unit,
        
    ]);

    return redirect()->back()->with('success', 'Surat berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $unit = Unit::find($id);

        if (!$unit) {
            return redirect()->route('show')->with('error', 'data tidak ditemukan');
        }

        return view('komponen.data-master.unit', compact('unit'));
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
        'nama_unit'   => 'required|string|max:255', 
        ]);
    
    $data = Unit::find($id);
        $data->update($validated);
        return redirect()->route('komponen.data-master.unit')->with('sukses', 'Data Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         $data = Unit::find($id);
        $data->delete();
        return redirect()->route('komponen.data-master.data')->with('sukses', 'Data Berhasil Dihapus');
    }
}
