@extends('layouts.master')

@section('title', 'Preview Surat')

@section('content')
<div class="container mt-4">
    <h3>Preview Surat {{ ucfirst($surat->template) }}</h3>
    <hr>

    <p><strong>No Surat:</strong> {{ $surat->no_surat }}</p>
    <p><strong>Penerima:</strong> {{ $surat->penerima_surat }}</p>
    <p><strong>Deskripsi:</strong> {{ $surat->deskripsi_surat }}</p>

    @if($surat->template === 'undangan')
        <p><strong>Hari:</strong> {{ $data['hari'] ?? '-' }}</p>
        <p><strong>Tanggal Acara:</strong> {{ $data['tanggal_acara'] ?? '-' }}</p>
        <p><strong>Waktu:</strong> {{ $data['waktu'] ?? '-' }}</p>
        <p><strong>Tempat:</strong> {{ $data['tempat'] ?? '-' }}</p>
        <p><strong>Acara:</strong> {{ $data['acara'] ?? '-' }}</p>
    @elseif($surat->template === 'tugas')
        <p><strong>Nama Petugas:</strong> {{ $data['nama_petugas'] ?? '-' }}</p>
        <p><strong>Tugas:</strong> {{ $data['tugas'] ?? '-' }}</p>
        <p><strong>Tanggal Tugas:</strong> {{ $data['tanggal_tugas'] ?? '-' }}</p>
    @endif

    <a href="{{ route('surat.index') }}" class="btn btn-secondary mt-3">Kembali</a>
</div>
@endsection
