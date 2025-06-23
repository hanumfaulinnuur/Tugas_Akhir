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
        return view('komponen.surat-keluar-eks', compact('data', 'jenisSurats'));
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
            'deskripsi_surat' => 'required|string',
            'penerima_surat' => 'required|string|max:255',
            'id_jenis_surat' => 'required|exists:jenis_surats,id',
            'template' => 'required|string',
        ]);

        $nomorSurat = $this->generateNomorSurat(SuratKeluarEksternal::class, 'EXT');

        $surat = SuratKeluarEksternal::create([
            'no_surat' => $nomorSurat,
            'tgl_keluar_surat' => $request->tgl_keluar_surat,
            'deskripsi_surat' => $request->deskripsi_surat,
            'penerima_surat' => $request->penerima_surat,
            'id_jenis_surat' => $request->id_jenis_surat,
        ]);

        $templateName = $request->template;
        $templatePath = public_path("template-surat/eksternal/{$templateName}.docx");

        if (!file_exists($templatePath)) {
            return back()->with('error', 'Template Word tidak ditemukan.');
        }

        $template = new TemplateProcessor($templatePath);

        $template->setValue('nama_sekolah', 'SMP NUHUUDLIYYAH');
        $template->setValue('alamat_sekolah', 'Jl. Karangsari, Desa Parijatah Kulon, Kec. Srono, Banyuwangi');
        $template->setValue('nss', '202052511245');
        $template->setValue('nis', '201770');
        $template->setValue('npsn', '60726570');
        $template->setValue('email_sekolah', 'nuhuudliyyah2012@gmail.com');
        $template->setValue('nomor_surat', $nomorSurat);
        $template->setValue('lampiran', '-');
        $template->setValue('perihal', 'Permohonan Re-Akreditasi Sekolah');
        $template->setValue('penerima', $request->penerima_surat);
        $template->setValue('status_sekolah', 'Swasta');
        $template->setValue('no_hp', '0852 0493 3967');
        $template->setValue('no_sk', '503/205/429.111/2021');
        $template->setValue('tanggal', now()->translatedFormat('d F Y'));
        $template->setValue('kepala_sekolah', 'AHMAD MORSIDI, S.Pd.I');

        $cleanNomorSurat = str_replace('/', DIRECTORY_SEPARATOR, $nomorSurat);
        $outputPath = public_path("generated/" . $cleanNomorSurat . ".docx");
        $folderPath = dirname($outputPath);

        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        $template->saveAs($outputPath);

        return redirect()->back()->with('success', 'Surat berhasil disimpan.');
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
    $surat = SuratKeluarEksternal::with('jenisSurat')->findOrFail($id);

    // ✅ Perbaikan di sini
    $jenisSurat = trim($surat->jenisSurat->nama_jenis_surat ?? '');

    if (!$jenisSurat) {
        return response()->json([
            'html' => '<p class="text-danger">Jenis surat tidak tersedia.</p>'
        ]);
    }

    $namaTemplate = str_replace(' ', '_', strtolower($jenisSurat)) . '.docx';
    $templatePath = public_path("template-surat/eksternal/{$namaTemplate}");

    if (!file_exists($templatePath)) {
        return response()->json([
            'html' => "<p class='text-danger'>Template tidak ditemukan. Dicari di: {$templatePath}</p>"
        ]);
    }

    // Lanjutkan proses preview
    $processor = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);
    $processor->setValue('no_surat', $surat->no_surat);
    $processor->setValue('nama', $surat->penerima_surat);
    $processor->setValue('tanggal', \Carbon\Carbon::parse($surat->tgl_keluar_surat)->translatedFormat('d F Y'));
    $processor->setValue('deskripsi', $surat->deskripsi_surat);

    $tempDocxPath = storage_path("app/temp/surat_{$id}.docx");
    $processor->saveAs($tempDocxPath);

    $phpWord = \PhpOffice\PhpWord\IOFactory::load($tempDocxPath);
    $htmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');

    ob_start();
    $htmlWriter->save('php://output');
    $html = ob_get_clean();

    return response()->json(['html' => $html]);
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
