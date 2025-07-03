@extends('layouts.master')
@section('title', 'Welcome')
@section('content')
    <main>
        <div class="container-fluid px-4">
            <div class="card my-4 p-4">
                <h2>Daftar Riwayat Surat</h2>

        
                 <!-- Table -->
                <table id="table-riwayat_surat" class="table table-bordered mt-5">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nomor Surat</th>
                            <th>Jenis Surat</th>
                            <th>Judul Surat</th>
                            <th>Tanggal Surat</th>
                            <th>Deskripsi</th>
                            <th>File</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Loop Surat Masuk --}}
                        @foreach($suratMasuk as $index => $surat)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $surat->nomor_surat }}</td>
                                <td>{{ $surat->jenisSurat->nama_jenis_surat ?? '-' }} (Masuk)</td>
                                <td>{{ $surat->judul_surat }}</td>
                                <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('Y-m-d') }}</td>
                                <td>{{ $surat->deskripsi }}</td>
                                <td>
                                    @if($surat->file)
                                        <a href="{{ asset('storage/' . $surat->file) }}" target="_blank">{{ basename($surat->file) }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#modalDetailMasuk{{ $surat->id }}">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
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
                                                <label>File</label>
                                                <input type="file" class="form-control"
                                                    value="{{ $surat->file }}" disabled>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Keluar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Loop Surat Keluar Internal --}}
                        @foreach($ski as $surat)
                            <tr>
                                <td>#</td>
                                <td>{{ $surat->no_surat }}</td>
                                <td>{{ $surat->jenisSurat->nama_jenis_surat ?? '-' }} (Keluar Internal)</td>
                                <td>{{ $surat->judul_surat }}</td>
                                <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('Y-m-d') }}</td>
                                <td>{{ $surat->deskripsi_surat }}</td>
                                <td>
                                    @if($surat->file)
                                        <a href="{{ asset('storage/' . $surat->file) }}" target="_blank">{{ basename($surat->file) }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#modalDetailSki{{ $surat->id }}">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
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
                                                <label>Nomor Surat</label>
                                                <input type="number" class="form-control"
                                                    value="{{ $surat->no_surat }}" disabled>
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
                                                    value="{{ $surat->deskripsi_surat }}" disabled>
                                            </div>
                                             <div class="form-group">
                                                <label>File</label>
                                                <input type="file" class="form-control"
                                                    value="{{ $surat->file }}" disabled>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Keluar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- Loop Surat Keluar Eksternal --}}
                        @foreach($ske as $surat)
                            <tr>
                                <td>#</td>
                                <td>{{ $surat->no_surat }}</td>
                                <td>{{ $surat->jenisSurat->nama_jenis_surat ?? '-' }} (Keluar Eksternal)</td>
                                <td>{{ $surat->judul_surat }}</td>
                                <td>{{ \Carbon\Carbon::parse($surat->tanggal_surat)->format('Y-m-d') }}</td>
                                <td>{{ $surat->deskripsi_surat }}</td>
                                <td>
                                    @if($surat->file)
                                        <a href="{{ asset('storage/' . $surat->file) }}" target="_blank">{{ basename($surat->file) }}</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#modalDetailSke{{ $surat->id }}">
                                        <i class="fas fa-info-circle"></i>
                                    </button>
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Yakin?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
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
                                                <label>Nomor Surat</label>
                                                <input type="number" class="form-control"
                                                    value="{{ $surat->no_surat }}" disabled>
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
                                                    value="{{ $surat->deskripsi_surat }}" disabled>
                                            </div>
                                             <div class="form-group">
                                                <label>File</label>
                                                <input type="file" class="form-control"
                                                    value="{{ $surat->file }}" disabled>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Keluar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>

                </table>
    </main>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#table-riwayat_surat').DataTable({
            ordering: false
        });

        // Pencarian global (jika ada form input dengan id #globalSearch)
        $('#globalSearch').on('keyup', function () {
            $('#table-riwayat_surat').DataTable().search(this.value).draw();
        });

        $('#btnNavbarSearch').on('click', function () {
            let keyword = $('#globalSearch').val();
            $('#table-riwayat_surat').DataTable().search(keyword).draw();
        });
    });
</script>
@endpush

