@extends('layouts.master')

@section('title', 'Surat Keluar Eksternal')

@section('content')
<div class="container mt-4">
    <h2>Daftar Surat</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formModal">+ Tambah Surat</button>

    <table id="table-surat_keluar_eksternal" class="table table-bordered mt-5">
        <thead>
            <tr>
                <th>#</th>
                <th>No Surat</th>
                <th>Template</th>
                <th>Penerima</th>
                <th>File</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $index => $surat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $surat->no_surat }}</td>
                    <td>{{ ucfirst($surat->template) }}</td>
                    <td>{{ $surat->penerima_surat }}</td>
                    <td>
                        @if($surat->file)
                            <a href="{{ asset('storage/' . $surat->file) }}" target="_blank" class="btn btn-sm btn-success">
                                Lihat File
                            </a>
                        @else
                            <span class="text-muted">Belum ada file</span>
                        @endif
                    </td>
                    <td class="d-flex gap-1">
                        <a href="{{ route('surat-keluar-internal.preview', $surat->id) }}" class="btn btn-sm btn-info" title="Preview">
                            <i class="bi bi-eye"></i>
                        </a>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#uploadModal-{{ $surat->id }}" title="Upload File">
                            <i class="bi bi-upload"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Modal Upload File untuk masing-masing surat --}}
@foreach ($data as $surat)
<div class="modal fade" id="uploadModal-{{ $surat->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('surat-keluar-eks.upload', $surat->id) }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            @method('POST')
            <div class="modal-header">
                <h5 class="modal-title">Upload File Surat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="file_surat" class="form-label">Pilih File</label>
                    <input type="file" name="file_surat" id="file_surat" class="form-control" accept="application/pdf" required>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </form>
    </div>
</div>
@endforeach

{{-- Modal Tambah Surat --}}
<div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('komponen.tambah-surat-keluareks') }}" method="POST" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Tambah Surat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label for="id_jenis_surat">Jenis Surat</label>
                    <select name="id_jenis_surat" id="id_jenis_surat" class="form-select" required>
                        <option value="">-- Pilih Jenis Surat --</option>
                        @foreach($jenisSurats as $jenis)
                            <option value="{{ $jenis->id }}" data-template="{{ $jenis->kode }}">
                                {{ $jenis->nama_jenis_surat }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal Surat</label>
                    <input type="date" name="tgl_keluar_surat" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Penerima Surat</label>
                    <input type="text" name="penerima_surat" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="deskripsi_surat" class="form-control" rows="2" required></textarea>
                </div>

                <hr>
                <div id="formTemplateFields"></div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- DataTables -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            // Inisialisasi DataTables (ubah ID sesuai dengan tabel kamu)
            $('#table-surat_keluar_eksternal, #table-pegawai').DataTable({
                language: {
                    search: "Cari:",
                    lengthMenu: "Tampilkan _MENU_ entri",
                    info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                    paginate: {
                        first: "Pertama",
                        last: "Terakhir",
                        next: "Berikutnya",
                        previous: "Sebelumnya"
                    },
                    zeroRecords: "Data tidak ditemukan",
                }
            });

            // Inisialisasi Select2
            $('.select2-multiple').select2({
                placeholder: "Pilih pegawai...",
                allowClear: true,
                width: '100%'
            });

            // Re-inisialisasi Select2 saat modal dibuka
            $('.modal').on('shown.bs.modal', function () {
                const $modal = $(this);
                $modal.find('.select2-multiple').select2({
                    placeholder: "Pilih pegawai...",
                    allowClear: true,
                    width: '100%',
                    dropdownParent: $modal
                });
            });

            // Dynamic form berdasarkan jenis surat
            const formFields = {
                undangan: `
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Hari</label>
                            <input type="text" name="hari" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tanggal Acara</label>
                            <input type="date" name="tanggal_acara" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Waktu</label>
                            <input type="text" name="waktu" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tempat</label>
                            <input type="text" name="tempat" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Acara</label>
                            <input type="text" name="acara" class="form-control" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>Kegiatan</label>
                            <input type="text" name="kegiatan" class="form-control" required>
                        </div>
                    </div>
                `,
                tugas: `
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Petugas</label>
                            <input type="text" name="nama_petugas" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tugas</label>
                            <input type="text" name="tugas" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tanggal Tugas</label>
                            <input type="date" name="tanggal_tugas" class="form-control" required>
                        </div>
                    </div>
                `
            };

            $('#id_jenis_surat').on('change', function () {
                const selectedOption = $(this).find(':selected');
                const templateType = selectedOption.data('template');

                if (templateType) {
                    const key = templateType.split('_')[0];
                    $('#formTemplateFields').html(formFields[key] || '');
                    console.log('Template:', templateType, '→ Key:', key);
                } else {
                    $('#formTemplateFields').empty();
                }
            });
        });
    </script>
@endpush

@endsection
