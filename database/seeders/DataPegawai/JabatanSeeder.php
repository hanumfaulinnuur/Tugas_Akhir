<?php

namespace Database\Seeders\DataPegawai;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $devisi = [
        ['nama_jabatan' => 'Kepala Sekolah', 'id_unit' => '1'],
        ['nama_jabatan' => 'Wakil Kepala Sekolah', 'id_unit' => '1'],
        ['nama_jabatan' => 'Staff Tata Usaha', 'id_unit' => '2'],
        ['nama_jabatan' => 'Guru BK', 'id_unit' => '3'],
        ['nama_jabatan' => 'Guru Kelas', 'id_unit' => '4'],
        ['nama_jabatan' => 'Guru Mapel', 'id_unit' => '5'],
        ['nama_jabatan' => 'Pustakawan', 'id_unit' => '6'],
        ['nama_jabatan' => 'Satpam', 'id_unit' => '7'],
        ['nama_jabatan' => 'Petugas Kebersihan', 'id_unit' => '8',],
        ['nama_jabatan' => 'Laboran', 'id_unit' => '9',],
        ['nama_jabatan' => 'Petugas UKS', 'id_unit' => '10',],
    ];

    // Insert data devisi ke tabel 'devisis'
    DB::table('jabatans')->insert($devisi);
    }
}
