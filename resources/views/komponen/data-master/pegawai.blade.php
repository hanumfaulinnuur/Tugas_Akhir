@extends('layouts.master')

@section('title', 'Data Pegawai')

@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="card my-4 p-4">
            <h2>Data Pegawai</h2>

            <!-- Button trigger modal tambah -->
                <div class="d-flex justify-content-start mt-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahSurat">
                        + Tambah Data
                    </button>
                </div>

                <!-- Modal Tambah -->
                <div class="modal fade" id="modalTambahSurat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="modalTambahLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('komponen.tambah-pegawai') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalTambahLabel">Tambah Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label>Nik</label>
                                        <input type="number" name="nik_pegawai" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Nama Pegawai</label>
                                        <input type="text" name="nama_pegawai" class="form-control">  
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tempat Lahir</label>
                                        <input type="text" name="tempat_lahir" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Tanggal Lahir</label>
                                        <input type="date" name="tanggal_lahir" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Jenis Kelamin</label>
                                        <select class="form-select" name="jenis_kelamin" aria-label="Default select example">
                                            <option selected>--pilih jenis kelamin--</option>
                                            <option value="laki-laki">laki-laki</option>
                                            <option value="perempuan">perempuan</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Agama</label>
                                        <input type="text" name="agama" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label> No Telp</label>
                                        <input type="text" name="no_telp" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Email</label>
                                        <input type="text" name="email" class="form-control">
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

                <!-- Table -->
                <table class="table table-bordered mt-5">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>NIK</th>
                            <th>Nama Pegawai</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>No Telp</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pegawai as $index => $pegawais)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $pegawais->nik_pegawai }}</td>
                                <td>{{ $pegawais->nama_pegawai }}</td>
                                <td>{{ $pegawais->tempat_lahir }}</td>
                                <td>{{ \Carbon\Carbon::parse($pegawais->tanggal_lahir)->format('Y-m-d') }}</td>
                                <td>{{ $pegawais->jenis_kelamin }}</td>
                                <td>{{ $pegawais->agama }}</td>
                                <td>{{ $pegawais->no_telp }}</td>
                                <td>{{ $pegawais->email }}</td>
                            </td>

                                <td>
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                        data-bs-target="#modalEdit{{ $pegawais->id }}">Edit</button>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#modalDetail{{ $pegawais->id }}">Detail</button>
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="modalEdit{{ $pegawais->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditLabel{{ $pegawais->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('komponen.update-data', $pegawais->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditLabel{{ $pegawais->id }}">Edit Data
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label>NIK</label>
                                                    <input type="number" name="nik_pegawai" class="form-control"
                                                        value="{{ $pegawais->nik_pegawai }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Nama Pegawai</label>
                                                    <input type="text" name="nama_pegawai" class="form-control"
                                                        value="{{ $pegawais->nama_pegawai }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Tempat Lahir</label>
                                                    <input type="text" name="tempat_lahir" class="form-control"
                                                        value="{{ $pegawais->tempat_lahir }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Tanggal Lahir</label>
                                                    <input type="date" name="tanggal_lahir" class="form-control"
                                                        value="{{ $pegawais->tanggal_lahir }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Jenis Kelamin</label>
                                                    <select class="form-select" name="jenis_kelamin" aria-label="Default select example">
                                                        <option selected>--pilih jenis kelamin--</option>
                                                        <option value="laki-laki">laki-laki</option>
                                                        <option value="perempuan">perempuan</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Agama</label>
                                                    <input type="text" name="agama" class="form-control"
                                                        value="{{ $pegawais->agama }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>No Telp</label>
                                                    <input type="text" name="no_telp" class="form-control"
                                                        value="{{ $pegawais->no_telp }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Email</label>
                                                    <input type="text" name="email" class="form-control"
                                                        value="{{ $pegawais->email }}">
                                                </div>
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
                            <div class="modal fade" id="modalDetail{{ $pegawais->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="modalDetailLabel{{ $pegawais->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalDetailLabel{{ $pegawais->id }}">Detail Data
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditLabel{{ $pegawais->id }}">Edit Data
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label>NIK</label>
                                                    <input type="number" name="nik_pegawai" class="form-control"
                                                        value="{{ $pegawais->nik_pegawai }}" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Nama Pegawai</label>
                                                    <input type="text" name="nomor_surat" class="form-control"
                                                        value="{{ $pegawais->nomor_surat }}" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Tempat Lahir</label>
                                                    <input type="text" name="tempat_lahir" class="form-control"
                                                        value="{{ $pegawais->tempat_lahir }}" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Tanggal Lahir</label>
                                                    <input type="date" name="tanggal_lahir" class="form-control"
                                                        value="{{ $pegawais->tanggal_lahir }}" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                                        <input type="text" name="jenis_kelamin" class="form-control" id="jenis_kelamin"
                                                        value="{{ $pegawais->jenis_kelamin }}" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Agama</label>
                                                    <input type="text" name="agama" class="form-control"
                                                        value="{{ $pegawais->agama }}" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>No Telp</label>
                                                    <input type="text" name="no_telp" class="form-control"
                                                        value="{{ $pegawais->no_telp }}" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Email</label>
                                                    <input type="text" name="email" class="form-control"
                                                        value="{{ $pegawais->email }}" disabled>
                                                </div>
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
            </div>
        </div>
    </main>
@endsection


