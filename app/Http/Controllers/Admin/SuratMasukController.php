<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\JenisSurat;
use App\Models\Admin\SuratMasuk;
use App\Models\DataTujuanSurat\PenerimaSuratMasukEksternal;
use App\Models\Pegawai\Pegawai;
use Illuminate\Support\Facades\DB;

class SuratMasukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Ambil semua jenis surat untuk dropdown
    $jenisSurat = JenisSurat::all();
    $penerimaSuratMasukEksternal = PenerimaSuratMasukEksternal::all();

    // Ambil data pegawai beserta nama jabatannya
    $pegawai = DB::table('pegawais')
        ->join('jabatan_pegawais', 'pegawais.id', '=', 'jabatan_pegawais.id_pegawai')
        ->join('jabatans', 'jabatan_pegawais.id_jabatan', '=', 'jabatans.id')
        ->select('pegawais.*', 'jabatans.nama_jabatan')
        ->get();

    // Ambil data surat masuk beserta relasi jenis surat dan penerima
    $suratMasuk = SuratMasuk::with(['jenisSurat', 'penerimaSuratMasukEksternal.pegawai'])->paginate(5);

    // Ambil daftar jabatan pegawai untuk ditampilkan di tabel
    $jabatanPegawais = DB::table('jabatan_pegawais')
        ->join('jabatans', 'jabatan_pegawais.id_jabatan', '=', 'jabatans.id')
        ->select('jabatan_pegawais.id_pegawai', 'jabatans.nama_jabatan')
        ->get();

    // Kirim semua data ke view
    return view('komponen.surat-masuk', compact('jenisSurat', 'pegawai', 'suratMasuk', 'jabatanPegawais'));
}

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
        'id_jenis_surat' => 'required|exists:jenis_surats,id',
        'judul_surat' => 'required|string|max:255',
        'tanggal_surat' => 'required|date',
        'deskripsi' => 'nullable|string',
        'file' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        'id_pegawai' => 'required|array',
        'id_pegawai.*' => 'exists:pegawais,id',
    ]);

    if ($request->hasFile('file')) {
        $originalName = $request->file('file')->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('surat_files', $originalName, 'public');
    }

    // Simpan data surat
    $surat = SuratMasuk::create([
        'kode_surat' => $request->kode_surat,
        'nomor_surat' => $request->nomor_surat,
        'id_jenis_surat' => $request->id_jenis_surat,
        'judul_surat' => $request->judul_surat,
        'tanggal_surat' => $request->tanggal_surat,
        'deskripsi' => $request->deskripsi,
        'file' => $filePath ?? null,
    ]);

    // Simpan penerima surat
    foreach ($request->id_pegawai as $idPegawai) {
        PenerimaSuratMasukEksternal::create([
            'id_surat_masuk' => $surat->id,
            'id_pegawai' => $idPegawai,
        ]);
    }

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
            'deskripsi' => 'required',
            'file' => 'required',
        ]);
        $data = SuratMasuk::find($id);
        $data->update($validate);
        return redirect()->route('komponen.surat-masuk')->with('sukses', 'Data Berhasil Diupdate');
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

