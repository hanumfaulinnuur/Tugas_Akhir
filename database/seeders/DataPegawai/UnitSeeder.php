<?php

namespace Database\Seeders\DataPegawai;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('units')->insert([
            ['nama_unit' => 'Manajemen Sekolah'],
            ['nama_unit' => 'Tata Usaha'],
            ['nama_unit' => 'Bidang Kesiswaan'],
            ['nama_unit' => 'Bidang Kurikulum'],
            ['nama_unit' => 'Guru Mapel'],
            ['nama_unit' => 'Perpustakaan'],
            ['nama_unit' => 'Keamanan'],
            ['nama_unit' => 'Kebersihan'],
            ['nama_unit' => 'Laboratorium'],
            ['nama_unit' => 'UKS(Unit Kesehatan Siswa)'],
        ]);
    }
}
