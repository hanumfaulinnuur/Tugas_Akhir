<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratMasuk extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'surat_masuks';

    protected $fillable = [
        'kode_surat',
        'nomor_surat',
        'id_jenis_surat',
        'judul_surat',
        'tanggal_surat',
        'deskripsi',
    ];

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat');
    }
}