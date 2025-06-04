@extends('tampilan.master')

@section('title', 'Surat Masuk')

@php
    $hideContent = true;
@endphp

@section('content')
    @include('tampilan.header')

    <div class="container mt-5 pt-5">
        <h2>Daftar Surat Masuk</h2>

        <!-- Button trigger modal tambah -->
        <div class="d-flex justify-content-end mb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahSurat">
                + Tambah Data
            </button>
        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="modalTambahSurat" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('komponen.tambah.surat') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalTambahLabel">Tambah Data</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Kode Surat</label>
                                <input type="text" name="kode_surat" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nomor Surat</label>
                                <input type="number" name="nomor_surat" class="form-control">

                                <label>Jenis Surat</label>
                                <select name="id_jenis_surat" class="form-control">
                                    @foreach ($jenisSurat as $jenis)
                                        <option value="{{ $jenis->id }}">{{ $jenis->nama_jenis_surat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Judul Surat</label>
                                <input type="text" name="judul_surat" class="form-control">

                                <label>Tanggal Surat</label>
                                <input type="date" name="tanggal_surat" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input type="text" name="deskripsi" class="form-control">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table -->
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
                            <button class="btn btn-sm btn-warning mb-2" data-toggle="modal" data-target="#modalEdit{{ $surat->id }}">Edit</button>
                            <button class="btn btn-sm btn-info mb-2" data-toggle="modal" data-target="#modalDetail{{ $surat->id }}">Detail</button>
                            <form action="{{ route('komponen.hapus-data', $surat->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>

                    <!-- Modal Edit -->
                    <div class="modal fade" id="modalEdit{{ $surat->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalEditLabel{{ $surat->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('komponen.update-data', $surat->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditLabel{{ $surat->id }}">Edit Data</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Kode Surat</label>
                                            <input type="text" name="kode_surat" class="form-control" value="{{ $surat->kode_surat }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Surat</label>
                                            <input type="number" name="nomor_surat" class="form-control" value="{{ $surat->nomor_surat }}">

                                            <label>Jenis Surat</label>
                                            <select name="id_jenis_surat" class="form-control">
                                                @foreach ($jenisSurat as $jenis)
                                                    <option value="{{ $jenis->id }}" {{ $surat->id_jenis_surat == $jenis->id ? 'selected' : '' }}>{{ $jenis->nama_jenis_surat }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Judul Surat</label>
                                            <input type="text" name="judul_surat" class="form-control" value="{{ $surat->judul_surat }}">

                                            <label>Tanggal Surat</label>
                                            <input type="date" name="tanggal_surat" class="form-control" value="{{ $surat->tanggal_surat }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <input type="text" name="deskripsi" class="form-control" value="{{ $surat->deskripsi }}">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Detail -->
                    <div class="modal fade" id="modalDetail{{ $surat->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalDetailLabel{{ $surat->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalDetailLabel{{ $surat->id }}">Detail Data</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Kode Surat</label>
                                        <input type="text" class="form-control" value="{{ $surat->kode_surat }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Nomor Surat</label>
                                        <input type="number" class="form-control" value="{{ $surat->nomor_surat }}" disabled>

                                        <label>Jenis Surat</label>
                                        <select class="form-control" disabled>
                                            @foreach ($jenisSurat as $jenis)
                                                <option value="{{ $jenis->id }}" {{ $surat->id_jenis_surat == $jenis->id ? 'selected' : '' }}>{{ $jenis->nama_jenis_surat }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Judul Surat</label>
                                        <input type="text" class="form-control" value="{{ $surat->judul_surat }}" disabled>

                                        <label>Tanggal Surat</label>
                                        <input type="date" class="form-control" value="{{ $surat->tanggal_surat }}" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Deskripsi</label>
                                        <input type="text" class="form-control" value="{{ $surat->deskripsi }}" disabled>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
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
    </div>

    @include('tampilan.footer')
@endsection
