<?php

namespace Database\Seeders\Admin;

use App\Models\Admin\JenisSurat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisSurat::insert([
    ['nama_jenis_surat' => 'Undangan Wali Murid', 'kode' => 'undangan_wali'],
    ['nama_jenis_surat' => 'Edaran Corona', 'kode' => 'edaran_corona'],
    ['nama_jenis_surat' => 'SK MPLS', 'kode' => 'sk_mpls'],
    ['nama_jenis_surat' => 'Surat Edaran Pramuka', 'kode' => 'edaran_pramuka'],
    ['nama_jenis_surat' => 'Surat Edaran UAS', 'kode' => 'edaran_uas'],
    ['nama_jenis_surat' => 'Surat Keterangan Aktif Mengajar', 'kode' => 'keterangan_aktif_mengajar'],
    ['nama_jenis_surat' => 'Surat Keterangan Aktif Sekolah', 'kode' => 'keterangan_aktif_siswa'],
    ['nama_jenis_surat' => 'Surat Keterangan Penerimaan Siswa Pindahan', 'kode' => 'keterangan_penerimaan'],
    ['nama_jenis_surat' => 'Surat Keterangan Pindah Sekolah', 'kode' => 'keterangan_pindah'],
    ['nama_jenis_surat' => 'Surat Keterangan PIP 2021', 'kode' => 'keterangan_pip'],
    ['nama_jenis_surat' => 'Surat Panggilan Orang Tua', 'kode' => 'panggilan_orang_tua'],
    ['nama_jenis_surat' => 'Surat Permohonan Akreditasi', 'kode' => 'permohonan_akreditasi'],
    ['nama_jenis_surat' => 'Surat Permohonan Pergantian Specimen', 'kode' => 'permohonan_specimen'],
    ['nama_jenis_surat' => 'Surat Pernyataan Pelanggaran', 'kode' => 'pernyataan_pelanggaran'],
    ['nama_jenis_surat' => 'Surat Pernyataan Pengunduran Diri', 'kode' => 'pernyataan_mundur'],
    ['nama_jenis_surat' => 'Surat Pernyataan Pengunduran Diri UNBK', 'kode' => 'pernyataan_mundur_unbk'],
    ['nama_jenis_surat' => 'Surat Pernyataan Siswa Sewa Laptop', 'kode' => 'pernyataan_sewa_laptop'],
    ['nama_jenis_surat' => 'Undangan Rapat Guru', 'kode' => 'undangan_rapat_guru'],
    ['nama_jenis_surat' => 'Undangan Istigosah', 'kode' => 'undangan_istigosah'],
    ['nama_jenis_surat' => 'Undangan Wali Murid Raport', 'kode' => 'undangan_raport'],
]);

    }
}