<?php

namespace Database\Seeders\Admin;

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
        DB::table('jenis_surats')->insert([
            ['nama_jenis_surat' => 'Surat Masuk'],
            ['nama_jenis_surat' => 'Surat Keluar'],
            ['nama_jenis_surat' => 'Surat Undangan '],
            ['nama_jenis_surat' => 'Surat Keputusan'],
            ['nama_jenis_surat' => 'Surat Tugas'],
        ]);
    }
}