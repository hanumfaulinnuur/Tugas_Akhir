<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\JenisSurat;
use App\Traits\GenerateNomorSuratTrait;
use App\Models\Admin\SuratKeluarInternal;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SuratKeluarInternalController extends Controller
{
    use GenerateNomorSuratTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = SuratKeluarInternal::latest()->get();
        $jenisSurats = JenisSurat::all();
        return view('komponen.surat-keluar.surat-keluar-in', compact('data', 'jenisSurats'));
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
    // dd($request->all());
    $request->validate([
        'tgl_surat' => 'required|date',
        'penerima_surat' => 'required|string',
        'deskripsi_surat' => 'required|string',
        'judul_surat' => 'required|string',
        'id_jenis_surat' => 'required|exists:jenis_surats,id',
        'hari' => 'required|string',
        'tanggal_acara' => 'required|date',
        'waktu' => 'required|string',
        'acara' => 'required|string',
        'tempat' => 'required|string',
        'kegiatan' => 'required|string',
    ]);

    $kode_urusan = '421.2';
    $kode_instansi = '429.245.200220';

    $tahun = Carbon::parse($request->tgl_surat)->format('Y');

    $count = SuratKeluarInternal::whereYear('tgl_surat', $tahun)->count();
    $no_urut = str_pad($count + 1, 4, '0', STR_PAD_LEFT); // contoh 0172

    $jenisSurat = JenisSurat::findOrFail($request->id_jenis_surat);
    $template = $jenisSurat->kode;

    $data = $request->only([
        'tgl_surat',
        'judul_surat',
        'penerima_surat',
        'deskripsi_surat',
        'id_jenis_surat',
    ]);

    $data['no_urut'] = $no_urut;
    $data['kode_urusan'] = $kode_urusan;
    $data['kode_instansi'] = $kode_instansi;
    $data['no_surat'] = "{$kode_urusan}/{$no_urut}/{$kode_instansi}/{$tahun}";
    $data['template'] = $template;

    $data['data_dinamis'] = json_encode($request->only([
        'hari', 'tanggal_acara', 'waktu', 'acara', 'tempat', 'kegiatan'
    ]));

    SuratKeluarInternal::create($data);

    return redirect()->route('komponen.surat-keluar-int')->with('success', 'Surat berhasil disimpan.');
}


    public function preview($id)
{
    // Ambil surat berdasarkan ID
    $surat = SuratKeluarInternal::findOrFail($id);

    // Ambil data dinamis dari field JSON 'data_dinamis'
    $dinamis = json_decode($surat->data_dinamis, true);

    // Inject field JSON menjadi properti langsung ke objek $surat
    foreach ($dinamis as $key => $value) {
        $surat->{$key} = $value;
    }

    // Kirim ke blade berdasarkan nama template
    return view('komponen.preview-surat-keluar.' . $surat->template, compact('surat'));

}

    public function upload(Request $request, $id)
{
    $request->validate([
        'file_surat' => 'required|file|mimes:pdf|max:2048', // Maks 2MB
    ]);

    // Proses upload
    $file = $request->file('file_surat');
    $path = $file->store('surat-keluar', 'public');

    $surat = SuratKeluarInternal::findOrFail($id);
    $surat->file = $path;
    $surat->save();

    return back()->with('success', 'File berhasil diupload.');
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
