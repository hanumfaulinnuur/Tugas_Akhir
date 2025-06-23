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
                        ['id' => 1, 'name' => 'Surat Masuk'],
                        ['id' => 2, 'name' => 'Surat Keluar'],
                        ['id' => 3, 'name' => 'Undangan'],
                        ['id' => 4, 'name' => 'Keputusan'],
                        ['id' => 5, 'name' => 'Tugas'],
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
                                <h5 class="card-title">{{ $template['name'] }}</h5>
                                <p class="text-muted">Klik untuk memilih</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Modal Tambah --}}
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('komponen.tambah-surat-keluareks') }}" method="POST" class="modal-content">
                    @csrf
                    <input type="hidden" name="template" id="inputTemplate">
                    <input type="hidden" name="id_jenis_surat" id="inputJenisSurat">

                    <div class="modal-header">
                        <h5 class="modal-title">Isi Data Surat: <span id="selectedTemplate" class="text-primary"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="tgl_keluar_surat" class="form-label">Tanggal Surat</label>
                            <input type="date" name="tgl_keluar_surat" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi_surat" class="form-label">Deskripsi</label>
                            <textarea name="deskripsi_surat" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="penerima_surat" class="form-label">Penerima Surat</label>
                            <input type="text" name="penerima_surat" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="id_jenis_surat" class="form-label">Jenis Surat</label>
                            <select name="id_jenis_surat" class="form-control" required>
                                @foreach ($jenisSurats as $jenis)
                                    <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis_surat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Buat Surat</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Table Data --}}
        <div class="table-responsive mt-5">
            <table class="table table-bordered">
                <thead>
                        <tr>
                            <th>#</th>
                            <th>Tanggal Surat</th>
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
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_surat)->format('Y-m-d') }}</td>
                                <td>{{ $item->jenisSurat->nama_jenis_surat ?? '-' }}</td>
                                <td>{{ $item->deskripsi_surat }}</td>
                                <td>{{ $item->penerima_surat }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $item->id }}">Edit</button>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#modalDetail{{ $item->id }}">Detail</button>
                                </td>
                            </tr>

                        <!-- Modal Edit -->
                            <div class="modal fade" id="modalEdit{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('komponen.update-data-keluareks', $item->id) }}" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditLabel{{ $item->id }}">Edit Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Tanggal Surat</label>
                                                    <input type="date" name="tanggal_surat" class="form-control" value="{{ $item->tanggal_surat }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Surat</label>
                                                    <select name="id_jenis_surat" class="form-control">
                                                        @foreach ($jenisSurats as $jenis)
                                                            <option value="{{ $jenis->id }}" {{ $item->id_jenis_surat == $jenis->id ? 'selected' : '' }}>{{ $jenis->nama_jenis_surat }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi</label>
                                                    <input type="text" name="deskripsi_surat" class="form-control" value="{{ $item->deskripsi_surat }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Penerima</label>
                                                    <input type="text" name="penerima_surat" class="form-control" value="{{ $item->penerima_surat }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Modal Detail -->
                            <div class="modal fade" id="modalDetail{{ $item->id }}" tabindex="-1" aria-labelledby="modalDetailLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalDetailLabel{{ $item->id }}">Detail Surat</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Tanggal Surat</label>
                                                <input type="date" class="form-control" value="{{ $item->tanggal_surat }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis Surat</label>
                                                <select class="form-control" disabled>
                                                    @foreach ($jenisSurats as $jenis)
                                                        <option value="{{ $jenis->id }}" {{ $item->id_jenis_surat == $jenis->id ? 'selected' : '' }}>
                                                            {{ $jenis->nama_jenis_surat }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <input type="text" class="form-control" value="{{ $item->deskripsi_surat }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Penerima</label>
                                                <input type="text" class="form-control" value="{{ $item->penerima_surat }}" disabled>
                                            </div>
                                        </div>

                                        <!-- Tombol Aksi -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>

                                            <!-- Tombol Cetak Detail -->
                                            <button class="btn btn-success btn-preview" data-id="{{ $item->id }}">
                                                Lihat & Cetak Surat
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Preview Surat -->
                            <div class="modal fade" id="modalPreviewSurat" tabindex="-1" aria-labelledby="modalPreviewLabel" aria-hidden="true">
                                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Preview Surat</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body" id="previewContent">
                                            <div class="text-center">
                                                <div class="spinner-border text-primary" role="status">
                                                    <span class="visually-hidden">Loading...</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data surat</td>
                            </tr>
                        @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>
@endsection


@push('scripts')
<style>
    .template-card {
        cursor: pointer;
        transition: transform 0.2s ease;
    }
    .template-card:hover {
        transform: scale(1.03);
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const cards = document.querySelectorAll(".template-card");
        const selectedTemplate = document.getElementById("selectedTemplate");
        const inputTemplate = document.getElementById("inputTemplate");
        const inputJenisSurat = document.getElementById("inputJenisSurat");

        cards.forEach(card => {
            card.addEventListener("click", function () {
                selectedTemplate.textContent = this.dataset.template;
                inputTemplate.value = this.dataset.template;
                inputJenisSurat.value = this.dataset.jenisId;
            });
        });

        const previewButtons = document.querySelectorAll(".btn-preview");
        previewButtons.forEach(button => {
            button.addEventListener("click", function () {
                const suratId = this.dataset.id;
                const previewModal = new bootstrap.Modal(document.getElementById('modalPreviewSurat'));
                const previewContent = document.getElementById("previewContent");
                previewContent.innerHTML = `<div class='text-center'><div class='spinner-border text-primary' role='status'><span class='visually-hidden'>Loading...</span></div></div>`;
                previewModal.show();
               fetch(`/admin/surat-eksternal/preview/${suratId}`)
    .then(response => response.text()) // Ubah dari json() ke text()
    .then(text => {
        console.log('Response preview:', text);
        try {
            const data = JSON.parse(text);
            previewContent.innerHTML = data.html;
        } catch (e) {
            previewContent.innerHTML = "<p class='text-danger'>Format response tidak sesuai JSON.</p>";
            console.error('JSON parse error:', e);
        }
    })
    .catch(error => {
        previewContent.innerHTML = "<p class='text-danger'>Gagal memuat surat.</p>";
        console.error('Fetch error:', error);
    });

            });
        });
    });
</script>
@endpush
