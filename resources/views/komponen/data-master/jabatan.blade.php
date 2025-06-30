@extends('layouts.master')

@section('title', 'Data Jabatan')

@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="card my-4 p-4">
            <h2>Data Jabatan</h2>

            <!-- Button trigger modal tambah -->
                <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahSurat">
                        + Tambah Data
                    </button>
                </div>

                <!-- Modal Tambah -->
                <div class="modal fade" id="modalTambahSurat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                    aria-labelledby="modalTambahLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('komponen.tambah-jabatan') }}" method="POST"
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
                                        <label>Nama Jabatan</label>
                                        <input type="text" name="nama_jabatan" class="form-control">  
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nama_unit" class="form-label">Nama Unit</label>
                                        <select name="nama_unit" class="form-select" required>
                                            <option selected disabled>Pilih Unit</option>
                                            @foreach ($unit as $units)
                                                <option value="{{ $units->id }}">{{ $units->nama_unit }}</option>
                                            @endforeach
                                        </select>
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
                <table id="table-jabatan" class="table table-bordered mt-5">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Jabatan</th>
                            <th>Nama Unit</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($jabatan as $index => $jabatans)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $jabatans->nama_jabatan }}</td>
                                <td>{{ $jabatans->unit->nama_unit ?? '-' }}</td>
                            </td>

                                
                                 <td>
                                <!-- Edit -->
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $jabatans->id }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Detail -->
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $jabatans->id }}" title="Detail">
                                    <i class="fas fa-info-circle"></i>
                                </button>

                                <!-- Hapus -->
                                <button class="btn btn-sm btn-danger" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                            </tr>

                            <!-- Modal Edit -->
                            <div class="modal fade" id="modalEdit{{ $jabatans->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditLabel{{ $jabatans->id }}"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST" action="{{ route('komponen.update-jabatan', $jabatans->id) }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditLabel{{ $jabatans->id }}">Edit Data
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label>Nama Jabatan</label>
                                                    <input type="text" name="nama_jabatan" class="form-control"
                                                        value="{{ $jabatans->nama_jabatan }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Nama Jabatan</label>
                                                    <select name="id_unit" class="form-control">
                                                        @foreach ($unit as $units)
                                                            <option value="{{ $units->id }}"
                                                                {{ $jabatans->id_unit == $units->id ? 'selected' : '' }}>
                                                                {{ $units->nama_unit }}</option>
                                                        @endforeach
                                                    </select>
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
                            <div class="modal fade" id="modalDetail{{ $jabatans->id }}" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="modalDetailLabel{{ $jabatans->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalDetailLabel{{ $jabatans->id }}">Detail Data
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-header">
                                                <h5 class="modal-title" id="modalEditLabel{{ $jabatans->id }}">Edit Data
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label>Nama Jabatan</label>
                                                    <input type="text" name="nama_jabatan" class="form-control"
                                                        value="{{ $jabatans->nama_jabatan }}" disabled>
                                                </div>
                                                <div class="col-md-6">
                                                    <label>Nama Jabatan</label>
                                                    <select class="form-control" disabled>
                                                        @foreach ($unit as $units)
                                                            <option value="{{ $units->id }}"
                                                                {{ $jabatans->id_unit == $units->id ? 'selected' : '' }}>
                                                                {{ $units->nama_unit }}</option>
                                                        @endforeach
                                                </select>
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
                                <td colspan="8" class="text-center">Tidak ada data unit.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // Inisialisasi DataTables
        var table = $('#table-jabatan').DataTable({
            ordering: false
        });

        // Fitur pencarian manual dari form search header
        $('#globalSearch').on('keyup', function () {
            table.search(this.value).draw();
        });

        $('#btnNavbarSearch').on('click', function () {
            var keyword = $('#globalSearch').val();
            table.search(keyword).draw();
        });
    });
</script>
@endpush


