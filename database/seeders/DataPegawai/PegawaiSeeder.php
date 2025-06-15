<?php

namespace Database\Seeders\DataPegawai;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pegawais')->insert([
            'nik_pegawai' => '3510086003035404',
            'nama_pegawai' => 'Putri Wulan Sari',
            'tempat_lahir' => 'Banyuwangi',
            'tanggal_lahir' => '2003-03-20',
            'jenis_kelamin' => 'Perempuan',
            'agama' => 'islam',
            'no_telp' => '081217865340',
            'email' => 'pwsunyuk20@gmail.com',
        ]);
        
    }
}
