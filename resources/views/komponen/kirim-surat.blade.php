@extends('layouts.master')

@section('title', 'Kirim Surat')

@section('content')
<main>
    <div class="container-fluid px-4">
        <div class="card my-4 p-4">
            <h2>Kirim Surat</h2>

            <div class="container">
                <div class="row">
                    <!-- Sidebar di kiri -->
                    <div class="col-md-3">
                        <div class="list-group">
                            <!-- Tombol modal menggantikan list kotak surat -->
                            <button type="button" 
                                    class="list-group-item list-group-item-action" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#staticBackdrop">
                                Kotak Surat
                            </button>
                            <a href="#" class="list-group-item list-group-item-action">A third link item</a>
                            <a href="#" class="list-group-item list-group-item-action">A fourth link item</a>
                            <a href="#" class="list-group-item list-group-item-action disabled" tabindex="-1" aria-disabled="true">
                                A disabled link item
                            </a>
                        </div>
                    </div>

                    <!-- Konten utama di kanan -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Konten Utama</h5>
                                <p class="card-text">Ini adalah area konten utama.</p>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row -->
            </div> <!-- end container -->
        </div> <!-- end card -->
    </div> <!-- end container-fluid -->

    <!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Tambahkan modal-lg agar modal lebih lebar -->
        <div class="modal-content">
            <form action="{{ route('komponen.kirim-data-surat') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Kotak Surat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                  <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="file" class="form-label">Pilih File Surat Masuk</label>
                            <select name="file" id="file" class="form-control">
                                @foreach ($suratMasuk as $surat)
                                    <option value="{{ $surat->file }}">
                                        {{ basename($surat->file) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nama_unit" class="form-label">Kepada</label>
                            <select name="nama_unit" id="nama_unit" class="form-select" required>
                                <option selected disabled>Pilih Unit</option>
                                @foreach ($unit as $units)
                                    <option value="{{ $units->nama_unit }}">{{ $units->nama_unit }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tujuan" class="form-label">Tujuan</label>
                            <select name="tujuan" id="tujuan" class="form-select" required>
                                <option selected disabled>Pilih Tujuan</option>
                                @foreach ($jabatanpeg as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->pegawai->nama_pegawai }} - {{ $item->jabatan->nama_jabatan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sifat" class="form-label">Sifat</label>
                            <input type="text" class="form-control" id="sifat" name="sifat" placeholder="Sifat surat">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="perihal" class="form-label">Perihal</label>
                            <input type="text" class="form-control" id="perihal" name="perihal" placeholder="Perihal surat">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="isi_pesan" class="form-label">Isi Pesan</label>
                            <textarea class="form-control" id="isi_pesan" name="isi_pesan" rows="3" placeholder="Tuliskan isi pesan..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
</main>
@endsection
