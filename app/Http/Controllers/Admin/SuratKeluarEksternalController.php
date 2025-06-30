<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\JenisSurat;
use App\Traits\GenerateNomorSuratTrait;
use App\Models\Admin\SuratKeluarEksternal;
use PhpOffice\PhpWord\TemplateProcessor;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\IOFactory;
use Carbon\Carbon;

class SuratKeluarEksternalController extends Controller
{
    use GenerateNomorSuratTrait;

    /**
     * Display a listing of the resource.
     */
     public function index()
    {
        $data = SuratKeluarEksternal::latest()->get();
        $jenisSurats = JenisSurat::all();
        return view('komponen.surat-keluar.surat-keluar-eks', compact('data', 'jenisSurats'));
        
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
        'tgl_keluar_surat' => 'required|date',
        'penerima_surat' => 'required|string',
        'deskripsi_surat' => 'required|string',
        'id_jenis_surat' => 'required|exists:jenis_surats,id',
        'hari' => 'required|string',
        'tanggal_acara' => 'required|date',
        'waktu' => 'required|string',
        'acara' => 'required|string',
        'tempat' => 'required|string',
        'kegiatan' => 'required|string',
    ]);

    $kode_urusan = '421.6';
    $kode_satuan = '188';

    $bulan = Carbon::parse($request->tgl_keluar_surat)->format('m');
    $tahun = Carbon::parse($request->tgl_keluar_surat)->format('Y');

    $count = SuratKeluarEksternal::whereYear('tgl_keluar_surat', $tahun)->count();
    $no_urut = str_pad($count + 1, 3, '0', STR_PAD_LEFT);

    // ambil template dari jenis surat
    $jenisSurat = JenisSurat::findOrFail($request->id_jenis_surat);
    $template = $jenisSurat->kode;

    // data tetap
    $data = $request->only([
        'tgl_keluar_surat',
        'penerima_surat',
        'deskripsi_surat',
        'id_jenis_surat',
    ]);

    $data['no_urut'] = $no_urut;
    $data['kode_urusan'] = $kode_urusan;
    $data['kode_satuan'] = $kode_satuan;
    $data['no_surat'] = "{$kode_urusan}/{$no_urut}/{$kode_satuan}/{$bulan}/{$tahun}";
    $data['template'] = $template;

    // field tambahan
    $data['data_dinamis'] = json_encode($request->only([
        'hari', 'tanggal_acara', 'waktu', 'acara', 'tempat', 'kegiatan'
    ]));

    SuratKeluarEksternal::create($data);

    return redirect()->route('komponen.surat-keluar-eks')->with('success', 'Surat berhasil disimpan.');
}


    /**
     * Display the specified resource.
     */
    
     public function show($id)
    {
        $surat = SuratKeluarEksternal::with('jenisSurat')->findOrFail($id);

        $jenisSurat = ucfirst(strtolower($surat->jenisSurat->nama_jenis_surat ?? ''));
        if (empty($jenisSurat)) {
            abort(400, 'Jenis surat tidak tersedia.');
        }

        $namaTemplate = $jenisSurat . '.docx';
        $templatePath = public_path("template-surat/eksternal/" . $namaTemplate);
        

        if (!file_exists($templatePath)) {
            abort(404, "Template surat '$namaTemplate' tidak ditemukan.");
        }

        $templateProcessor = new TemplateProcessor($templatePath);
        $templateProcessor->setValue('nama', $surat->penerima_surat);
        $templateProcessor->setValue('tanggal', $surat->tgl_keluar_surat);
        $templateProcessor->setValue('nomor', $surat->no_surat);
        $templateProcessor->setValue('isi', $surat->deskripsi_surat);

        $outputName = 'Surat-' . $jenisSurat . '-' . now()->format('YmdHis') . '.docx';
        $outputPath = public_path('generated-surats/' . $outputName);

        if (!file_exists(public_path('generated-surats'))) {
            mkdir(public_path('generated-surats'), 0777, true);
        }

        $templateProcessor->saveAs($outputPath);

        return Response::download($outputPath)->deleteFileAfterSend(true);
    }

    // 🔽 Method tambahan untuk download ulang berdasarkan ID
    public function downloadWord($id)
    {
        $surat = SuratKeluarEksternal::findOrFail($id);
        $nomorSurat = $surat->no_surat;

        $filePath = public_path('generated/' . str_replace('/', DIRECTORY_SEPARATOR, $nomorSurat) . '.docx');

        if (!file_exists($filePath)) {
            return back()->with('error', 'File surat tidak ditemukan.');
        }

        return Response::download($filePath, 'Surat-' . str_replace('/', '-', $nomorSurat) . '.docx');
    }

    public function preview($id)
{
    // Ambil surat berdasarkan ID
    $surat = SuratKeluarEksternal::findOrFail($id);

    // Ambil data dinamis dari field JSON 'data_dinamis'
    $dinamis = json_decode($surat->data_dinamis, true);

    // Inject field JSON menjadi properti langsung ke objek $surat
    foreach ($dinamis as $key => $value) {
        $surat->{$key} = $value;
    }

    // Kirim ke blade berdasarkan nama template
    return view('preview-surat-keluar.' . $surat->template, compact('surat'));
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
