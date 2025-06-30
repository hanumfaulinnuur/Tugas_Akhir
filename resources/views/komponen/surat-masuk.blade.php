@extends('layouts.master')
@section('title', 'Surat Masuk')

@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="card my-4 p-4">
            <h2>Daftar Surat Masuk</h2>

            <!-- Tombol Tambah -->
            <div class="d-flex justify-content-start mt-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahSurat">
                    + Tambah Data
                </button>
            </div>

            <!-- Modal Tambah -->
            <div class="modal fade" id="modalTambahSurat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                aria-labelledby="modalTambahLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('komponen.tambah.surat') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTambahLabel">Tambah Surat Masuk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="kode_surat" class="form-label">Kode Surat</label>
                                        <input type="text" name="kode_surat" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                                        <input type="number" name="nomor_surat" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="id_jenis_surat" class="form-label">Jenis Surat</label>
                                       <select name="id_jenis_surat" id="template" class="form-control" required>
    <option value="">-- Pilih Jenis Surat --</option>
    @foreach ($jenisSurat as $jenis)
        <option value="{{ $jenis->id }}" data-template="{{ $jenis->kode }}">
            {{ $jenis->nama_jenis_surat }}
        </option>
    @endforeach
</select>


                                    </div>
                                    <div class="col-md-6">
                                        <label for="judul_surat" class="form-label">Judul Surat</label>
                                        <input type="text" name="judul_surat" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tanggal_surat" class="form-label">Tanggal Surat</label>
                                        <input type="date" name="tanggal_surat" class="form-control" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="file" class="form-label">File</label>
                                        <input type="file" name="file" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="deskripsi" class="form-label">Deskripsi</label>
                                        <input type="text" name="deskripsi" class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="id_pegawai" class="form-label">Penerima Surat</label>
                                        <select id="id_pegawai" name="id_pegawai[]" class="form-control select2-multiple" multiple required>
                                            @foreach ($pegawai as $p)
                                                <option value="{{ $p->id }}">{{ $p->nama_pegawai }} - {{ $p->nama_jabatan }}</option>
                                            @endforeach
                                        </select>
                                        <small class="text-muted">Pilih satu atau lebih penerima surat.</small>
                                    </div>
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

            <!-- Tabel Surat Masuk -->
            <table class="table table-bordered mt-5">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Surat</th>
                        <th>Nomor Surat</th>
                        <th>Jenis Surat</th>
                        <th>Judul Surat</th>
                        <th>Tanggal Surat</th>
                        <th>Deskripsi</th>
                        <th>Penerima</th>
                        <th>File</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($suratMasuk as $index => $surat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $surat->kode_surat }}</td>
                            <td>{{ $surat->nomor_surat }}</td>
                            <td>{{ $surat->jenisSurat->nama_jenis_surat ?? '-' }}</td>
                            <td>{{ $surat->judul_surat }}</td>
                            <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('Y-m-d') }}</td>
                            <td>{{ $surat->deskripsi }}</td>
                            <td>
    @foreach ($surat->penerimaSuratMasukEksternal as $penerima)
        {{ $penerima->pegawai->nama_pegawai ?? '-' }}
        @if (!$loop->last), @endif
    @endforeach
</td>
                            <td>
                                @if ($surat->file)
                                    <a href="{{ asset('storage/' . $surat->file) }}" target="_blank">
                                        {{ basename($surat->file) }}
                                    </a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info">Detail</button>
                                <button class="btn btn-sm btn-warning">Edit</button>
                                <form action="{{ route('komponen.hapus-data', $surat->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Yakin ingin menghapus?')" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">Tidak ada data surat masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex justify-content-end mt-4">
                {{ $suratMasuk->links() }}
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.select2-multiple').select2({
                placeholder: "Pilih pegawai...",
                allowClear: true,
                width: '100%'
            });

            $('.modal').on('shown.bs.modal', function () {
                const $modal = $(this);
                $modal.find('.select2-multiple').select2({
                    placeholder: "Pilih pegawai...",
                    allowClear: true,
                    width: '100%',
                    dropdownParent: $modal
                });
            });
        });
    </script>
@endpush
