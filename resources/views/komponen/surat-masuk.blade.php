

@extends('layouts.master')
@section('title', 'Welcome')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="card my-4 p-4">
                <h2>Daftar Surat Masuk</h2>

                <!-- Button trigger modal tambah -->
                  
                <div class="d-flex justify-content-start mt-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahSurat">
                        + Tambah Data
                    </button>
                </div>
                
                <!-- Modal Tambah -->
            <div class="modal fade" id="modalTambahSurat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <form action="{{ route('komponen.tambah.surat') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTambahLabel">Tambah Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                        <select name="id_jenis_surat" class="form-control" required>
                                            @foreach ($jenisSurat as $jenis)
                                                <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis_surat }}</option>
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
                                            <select id="id_pegawai" name="id_pegawai[]" class="form-select">
                                                @foreach ($pegawai as $p)
                                                    <option value="{{ $p->id }}">{{ $p->nama_pegawai }} - {{ $p->nama_jabatan }}</option>
                                                @endforeach
                                            </select>
                                            <small class="text-muted">Tekan Ctrl (atau Cmd di Mac) untuk memilih lebih dari satu.</small>
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
                                    @php
                                        $jabatan = $jabatanPegawais->firstWhere('id_pegawai', $penerima->pegawai->id);
                                    @endphp
                                    {{ $penerima->pegawai->nama }} - {{ $jabatan ? $jabatan->nama_jabatan : '-' }}
                                    @if (!$loop->last), @endif
                                @endforeach
                            </td>
                            <td>
                                <a href="{{ asset('storage/' . $surat->file) }}" target="_blank">
                                    {{ basename($surat->file) }}
                                </a>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $surat->id }}">Edit</button>
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalDetail{{ $surat->id }}">Detail</button>
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </td>
                        </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="modalEdit{{ $surat->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditLabel{{ $surat->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('komponen.update-data', $surat->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditLabel{{ $surat->id }}">Edit Data
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label>Kode Surat</label>
                                                    <input type="text" name="kode_surat" class="form-control"
                                                        value="{{ $surat->kode_surat }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nomor Surat</label>
                                                    <input type="number" name="nomor_surat" class="form-control"
                                                        value="{{ $surat->nomor_surat }}">
                                                    <label>Jenis Surat</label>
                                                    <select name="id_jenis_surat" class="form-control">
                                                        @foreach ($jenisSurat as $jenis)
                                                            <option value="{{ $jenis->id }}"
                                                                {{ $surat->id_jenis_surat == $jenis->id ? 'selected' : '' }}>
                                                                {{ $jenis->nama_jenis_surat }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Judul Surat</label>
                                                    <input type="text" name="judul_surat" class="form-control"
                                                        value="{{ $surat->judul_surat }}">
                                                    <label>Tanggal Surat</label>
                                                    <input type="date" name="tanggal_surat" class="form-control"
                                                        value="{{ $surat->tanggal_surat }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi</label>
                                                    <input type="text" name="deskripsi" class="form-control"
                                                        value="{{ $surat->deskripsi }}">
                                                </div>
                                                 <div class="form-group">
                                                    <label>File</label>
                                                    <input type="file" name="file" class="form-control"
                                                        value="{{ $surat->file }}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Keluar</button>
                                                <button type="submit" class="btn btn-primary">Simpan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Detail -->
                            <div class="modal fade" id="modalDetail{{ $surat->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="modalDetailLabel{{ $surat->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalDetailLabel{{ $surat->id }}">Detail Data
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label>Kode Surat</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $surat->kode_surat }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Nomor Surat</label>
                                                <input type="number" class="form-control"
                                                    value="{{ $surat->nomor_surat }}" disabled>
                                                <label>Jenis Surat</label>
                                                <select class="form-control" disabled>
                                                    @foreach ($jenisSurat as $jenis)
                                                        <option value="{{ $jenis->id }}"
                                                            {{ $surat->id_jenis_surat == $jenis->id ? 'selected' : '' }}>
                                                            {{ $jenis->nama_jenis_surat }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Judul Surat</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $surat->judul_surat }}" disabled>
                                                <label>Tanggal Surat</label>
                                                <input type="date" class="form-control"
                                                    value="{{ $surat->tanggal_surat }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $surat->deskripsi }}" disabled>
                                            </div>
                                            <div class="form-group">
                                                <label>File</label><br>
                                                <a href="{{ asset('storage/' . $surat->file) }}" target="_blank">
                                                    {{ basename($surat->file) }}
                                                </a>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Keluar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Tidak ada data surat masuk.</td>
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
<script>
    $(document).ready(function() {
        $('#id_pegawai').select2({
            tags: true,
            placeholder: "Pilih pegawai...",
            allowClear: true,
            tokenSeparators: [',']
        });
    });
</script>
@endpush
