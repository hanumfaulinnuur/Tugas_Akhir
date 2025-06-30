@extends('layouts.master')

@section('title', 'Data Jabatan Pegawai')

@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="card my-4 p-4">
            <h2>Data Jabatan Pegawai</h2>

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
                        <form action="{{ route('komponen.tambah-jabatanpeg') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTambahLabel">Tambah Data</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="id_pegawai" class="form-label">Nama Pegawai</label>
                                        <select name="id_pegawai" class="form-select" required>
                                            <option selected disabled>Pilih Pegawai</option>
                                            @foreach ($pegawai as $pegawais)
                                                <option value="{{ $pegawais->id }}">{{ $pegawais->nama_pegawai }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="id_jabatan" class="form-label">Nama Jabatan</label>
                                        <select name="id_jabatan" class="form-select" required>
                                            <option selected disabled>Pilih jabatan</option>
                                            @foreach ($jabatan as $jab)
                                                <option value="{{ $jab->id }}">{{ $jab->nama_jabatan }}</option>
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

            <!-- Table Data -->
            <table id="table-jabatan_pegawai" class="table table-bordered mt-5">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Pegawai</th>
                        <th>Nama Jabatan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jabatans as $index => $jabatans1)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $jabatans1->pegawai->nama_pegawai ?? '-' }}</td>
                            <td>{{ $jabatans1->jabatan->nama_jabatan ?? '-' }}</td>
                            <td>
                                <!-- Edit -->
                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#modalEdit{{ $jabatans1->id }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <!-- Detail -->
                                <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail{{ $jabatans1->id }}" title="Detail">
                                    <i class="fas fa-info-circle"></i>
                                </button>

                                <!-- Hapus -->
                                <form action="{{ route('komponen.hapus-jabatanpeg', $jabatans1->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')" title="Hapus">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Modal Edit -->
                        <div class="modal fade" id="modalEdit{{ $jabatans1->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                            aria-labelledby="modalEditLabel{{ $jabatans1->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('komponen.update-jabatanpeg', $jabatans1->id) }}" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditLabel{{ $jabatans1->id }}">Edit Data</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label for="id_pegawai" class="form-label">Nama Pegawai</label>
                                                    <select name="id_pegawai" class="form-select" required>
                                                        <option disabled>Pilih Pegawai</option>
                                                        @foreach ($pegawai as $pegawais)
                                                            <option value="{{ $pegawais->id }}" {{ $pegawais->id == $jabatans1->pegawai_id ? 'selected' : '' }}>
                                                                {{ $pegawais->nama_pegawai }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="id_jabatan" class="form-label">Nama Jabatan</label>
                                                    <select name="id_jabatan" class="form-select" required>
                                                        <option disabled>Pilih jabatan</option>
                                                        @foreach ($jabatan as $jab)
                                                            <option value="{{ $jab->id }}" {{ $jab->id == $jabatans1->jabatan_id ? 'selected' : '' }}>
                                                                {{ $jab->nama_jabatan }}
                                                            </option>
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

                        <!-- Modal Detail -->
                        <div class="modal fade" id="modalDetail{{ $jabatans1->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                            aria-labelledby="modalDetailLabel{{ $jabatans1->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalDetailLabel{{ $jabatans1->id }}">Detail Data</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Nama Pegawai</label>
                                                <select class="form-select" disabled>
                                                    @foreach ($pegawai as $pegawais)
                                                        <option value="{{ $pegawais->id }}" {{ $pegawais->id == $jabatans1->pegawai_id ? 'selected' : '' }}>
                                                            {{ $pegawais->nama_pegawai }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nama Jabatan</label>
                                                <select class="form-select" disabled>
                                                    @foreach ($jabatan as $jab)
                                                        <option value="{{ $jab->id }}" {{ $jab->id == $jabatans1->jabatan_id ? 'selected' : '' }}>
                                                            {{ $jab->nama_jabatan }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">Tidak ada data Jabatan Pegawai.</td>
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
        var table = $('#table-jabatan_pegawai').DataTable({
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
