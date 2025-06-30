@extends('layouts.master')

@section('title', 'Surat Keluar Eksternal')

@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="card p-4 mt-4">
            <h2 class="mb-4">Pilih Template Surat Keluar Eksternal</h2>

            <div class="row">
                @php
                    $templates = [
                        ['id' => 1, 'name' => 'undangan'],
                        ['id' => 2, 'name' => 'keputusan'],
                        ['id' => 3, 'name' => 'tugas'],
                        ['id' => 4, 'name' => 'surat_keluar'],
                        ['id' => 5, 'name' => 'surat_masuk'],
                    ];
                @endphp

                @foreach ($templates as $template)
                    <div class="col-md-4 mb-3">
                        <div class="card shadow-sm h-100 template-card"
                            data-template="{{ $template['name'] }}"
                            data-jenis-id="{{ $template['id'] }}"
                            data-bs-toggle="modal"
                            data-bs-target="#formModal">
                            <div class="card-body text-center">
                                <h5 class="card-title text-capitalize">{{ $template['name'] }}</h5>
                                <p class="text-muted">Klik untuk memilih</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Modal Tambah Surat --}}
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('komponen.tambah-surat-keluareks') }}" method="POST" class="modal-content">
                    @csrf
                    <input type="hidden" name="template" id="inputTemplate">
                    <input type="hidden" name="id_jenis_surat" id="inputJenisSurat">

                    <div class="modal-header">
                        <h5 class="modal-title">Isi Data Surat: <span id="selectedTemplate" class="text-primary"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="tgl_keluar_surat" class="form-label">Tanggal Surat</label>
                                <input type="date" name="tgl_keluar_surat" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="penerima_surat" class="form-label">Penerima Surat</label>
                                <input type="text" name="penerima_surat" class="form-control" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="deskripsi_surat" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi_surat" class="form-control" rows="2" required></textarea>
                            </div>

                            <hr class="my-3">

                            <div class="col-md-6 mb-3">
                                <label for="hari" class="form-label">Hari</label>
                                <input type="text" name="hari" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tanggal_acara" class="form-label">Tanggal Acara</label>
                                <input type="date" name="tanggal_acara" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="waktu" class="form-label">Waktu</label>
                                <input type="text" name="waktu" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="acara" class="form-label">Nama Acara</label>
                                <input type="text" name="acara" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="tempat" class="form-label">Tempat</label>
                                <input type="text" name="tempat" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="kegiatan" class="form-label">Kegiatan</label>
                                <input type="text" name="kegiatan" class="form-control" required>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Buat Surat</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabel Data Surat --}}
        <div class="table-responsive mt-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tanggal</th>
                        <th>Jenis Surat</th>
                        <th>Deskripsi</th>
                        <th>Penerima</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->tgl_keluar_surat)->format('Y-m-d') }}</td>
                            <td>{{ $item->jenisSurat->nama_jenis_surat ?? '-' }}</td>
                            <td>{{ $item->deskripsi_surat }}</td>
                            <td>{{ $item->penerima_surat }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data surat</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection