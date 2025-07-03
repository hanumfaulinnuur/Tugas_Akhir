<?php

namespace App\Models\Admin;

use App\Models\DataTujuanSurat\PenerimaSuratKeluarInternal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratKeluarInternal extends Model
{
     use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'surat_keluar_internals';

    protected $fillable = [
        'no_surat',
        'tgl_keluar',
        'judul_surat',
        'deskripsi_surat',
        'penerima_surat',
        'file',
        'id_jenis_surat',
        'kode_urusan',
        'no_urut',
        'kode_satuan',
        'data_dinamis',
        'template'
    
    ];
    public function penerimaSuratMasukIksternal()
    {
        return $this->hasMany(PenerimaSuratKeluarInternal::class, 'id_surat_keluar_internal');
    }
    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat');
    }

}
