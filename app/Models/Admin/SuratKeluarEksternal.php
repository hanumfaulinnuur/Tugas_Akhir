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
        'no_surat',
        'tgl_keluar_surat',
        'deskripsi_surat',
        'penerima_surat',
        'id_jenis_surat',
    ];
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat');
    }
}
