@extends('layouts.master')

@section('title', 'Preview Surat Undangan Wali Murid')

@section('content')
<div class="d-flex justify-content-end mb-3 no-print">
    <a href="#" onclick="window.print()" class="btn btn-outline-primary">Cetak</a>
</div>

<div class="container border p-4 mt-4 bg-white">
    <div class="text-center">
        <h4 class="fw-bold">SMP NUHUUDLIYYAH</h4>
        <p>NSS: 202052511245 &nbsp;&nbsp; NPSN: 60726570</p>
        <p>Alamat: Jl. Karangsari, Parijatah Kulon</p>
        <hr>
    </div>

    <div class="mt-3">
        <p>Nomor: {{ $surat->no_surat }}</p>
        <p>Perihal: Undangan</p>
        <br>
        <p>Kepada Yth. {{ $surat->penerima_surat }}</p>
        <p>di Tempat</p>
    </div>

    <div class="mt-3">
        <p>Assalamu’alaikum Wr. Wb.</p>
        <p>Sehubungan dengan kegiatan {{ $surat->kegiatan ?? '-' }}, dimohon kehadiran pada:</p>

        <table class="table table-borderless w-75">
            <tr><td>Hari</td><td>: {{ $surat->hari ?? '-' }}</td></tr>
            <tr><td>Tanggal</td><td>: {{ \Carbon\Carbon::parse($surat->tanggal_acara ?? now())->translatedFormat('d F Y') }}</td></tr>
            <tr><td>Waktu</td><td>: {{ $surat->waktu ?? '-' }}</td></tr>
            <tr><td>Acara</td><td>: {{ $surat->acara ?? '-' }}</td></tr>
            <tr><td>Tempat</td><td>: {{ $surat->tempat ?? '-' }}</td></tr>
        </table>

        <p>Wassalamu’alaikum Wr. Wb.</p>
    </div>

    <div class="text-end mt-5">
        <p>Srono, {{ \Carbon\Carbon::parse($surat->tgl_keluar_surat)->translatedFormat('d F Y') }}</p>
        <p><strong>Kepala Sekolah</strong></p>
        <br><br>
        <p><strong>AHMAD MORSIDI, S.Pd.I</strong></p>
    </div>
</div>

{{-- Opsional: agar tombol cetak tidak ikut tercetak --}}
<style>
    @media print {
        .no-print {
            display: none !important;
        }
    }
</style>
@endsection
