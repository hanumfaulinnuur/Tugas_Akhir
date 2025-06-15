<?php

namespace App\Models\Admin;

use App\Models\DataTujuanSurat\PenerimaSuratMasukEksternal;
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
        'file',
    ];

    public function jenisSurat()
    {
        return $this->belongsTo(JenisSurat::class, 'id_jenis_surat');
    }
    public function penerimaSuratMasukEksternal()
{
    return $this->hasMany(PenerimaSuratMasukEksternal::class, 'id_surat_masuk_eksternal');
}

}