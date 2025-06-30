@extends('layouts.master')

@section('title', 'Surat Keluar Eksternal')

@section('content')
<div class="container mt-4">
    <h2>Daftar Surat</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formModal">+ Tambah Surat</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No Surat</th>
                <th>Template</th>
                <th>Penerima</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $surat)
                <tr>
                    <td>{{ $surat->no_surat }}</td>
                    <td>{{ ucfirst($surat->template) }}</td>
                    <td>{{ $surat->penerima_surat }}</td>
                    <td>
                        <a href="{{ route('surat.preview', $surat->id) }}" class="btn btn-sm btn-info">Preview</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Form Tambah -->
<div class="modal fade" id="formModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form action="{{ route('komponen.tambah-surat-keluareks') }}" method="POST" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Tambah Surat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                {{-- Jenis Surat --}}
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
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

        const select = document.getElementById('id_jenis_surat');
        select.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const templateType = selectedOption.getAttribute('data-template');

            if (templateType) {
                const key = templateType.split('_')[0]; // Ambil 'undangan' dari 'undangan_wali'
                document.getElementById('formTemplateFields').innerHTML = formFields[key] || '';
                console.log('Kode dipilih:', templateType, '→ Form:', key); // Untuk debug
            } else {
                document.getElementById('formTemplateFields').innerHTML = '';
            }
        });
    });
</script>
@endsection
