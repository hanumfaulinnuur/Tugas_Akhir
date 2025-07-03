<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratKeluarEksternal extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'surat_keluar_eksternals';

   protected $fillable = [
    'tgl_keluar_surat',
    'penerima_surat',
    'deskripsi_surat',
    'file',
    'id_jenis_surat',
    'kode_urusan',
    'no_urut',
    'kode_satuan',
    'no_surat',
    'data_dinamis',
    'template'
];

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat');
    }
}
