@extends('layouts.master')

@section('title', 'Preview Surat Undangan Wali Murid')

@section('content')
<div class="container mt-4">

{{-- Tambahkan link Bootstrap Icon jika belum ada --}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

{{-- Tombol Cetak --}}
<div class="text-end no-print mb-3">
    <button class="btn btn-primary" onclick="window.print()">
        <i class="bi bi-printer me-1"></i> Cetak Surat
    </button>
</div>

{{-- Konten Surat --}}
<div class="container border border-2 rounded p-5 bg-white shadow-sm">

    {{-- HEADER SURAT DENGAN LOGO --}}
    <div class="text-center mb-4">
        <div class="d-flex align-items-center justify-content-center mb-3">
            <img src="{{ asset('/gambar/logosmp.jpg') }}" alt="Logo Sekolah" width="80" class="me-3">
            <div class="text-start">
                <h5 class="fw-bold text-uppercase mb-0">YAYASAN NAHDLATUL MUHAMMADIYYAH</h5>
                <h4 class="fw-bold text-uppercase mb-0">SMP NUHUUDLIYYAH</h4>
                <p class="mb-0 small">
                    NSS: 202052511245 &nbsp;&nbsp; NIS: 201770 &nbsp;&nbsp; NPSN: 60726570<br>
                    Alamat: Jl. Karangsari, Desa Parijatah Kulon, Kec. Srono, Kab. Banyuwangi 68471<br>
                    Email: <a href="mailto:smp_nhdl12@yahoo.co.id">smp_nhdl12@yahoo.co.id</a>
                </p>
            </div>
        </div>
        <hr class="my-3 border-dark">
    </div>

    {{-- Tujuan Surat --}}
    <div class="mb-4">
        <p><strong>Nomor</strong>: {{ $surat->no_surat }}</p>
        <p><strong>Lampiran</strong>: -</p>
        <p><strong>Perihal</strong>: Undangan</p>
        <br>
        <p>Kepada Yth.</p>
        <p><strong>{{ $surat->penerima_surat }}</strong></p>
        <p>di Tempat</p>
    </div>

    {{-- Isi Surat --}}
    <div class="mb-4">
        <p>Assalamu’alaikum Wr. Wb.</p>

        <p>Dengan hormat,</p>
        <p>Sehubungan dengan kegiatan <strong>{{ $surat->kegiatan ?? '-' }}</strong>, maka kami mengharap kehadiran Bapak/Ibu wali murid pada:</p>

        <table class="table table-borderless w-75">
            <tr><td width="30%">Hari</td><td>: {{ $surat->hari ?? '-' }}</td></tr>
            <tr><td>Tanggal</td><td>: {{ \Carbon\Carbon::parse($surat->tanggal_acara ?? now())->translatedFormat('d F Y') }}</td></tr>
            <tr><td>Waktu</td><td>: {{ $surat->waktu ?? '-' }}</td></tr>
            <tr><td>Acara</td><td>: {{ $surat->acara ?? '-' }}</td></tr>
            <tr><td>Tempat</td><td>: {{ $surat->tempat ?? '-' }}</td></tr>
        </table>

        <p>Demikian permohonan kami, atas perhatian Bapak/Ibu kami ucapkan terima kasih.</p>

        <p>Wassalamu’alaikum Wr. Wb.</p>
    </div>

    {{-- Tanda Tangan --}}
    <div class="text-end mt-5">
        <p>Srono, {{ \Carbon\Carbon::parse($surat->tgl_keluar_surat)->translatedFormat('d F Y') }}</p>
        <p><strong>Kepala Sekolah</strong></p>
        <br><br>
        <p><strong>AHMAD MORSIDI, S.Pd.I</strong></p>
    </div>
</div>

{{-- CSS Print --}}
<style>
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>

</div>
@endsection
