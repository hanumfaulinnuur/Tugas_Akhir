<?php

namespace App\Models\DataTujuanSurat;

use App\Models\Admin\SuratKeluarInternal;
use App\Models\Admin\SuratMasuk;
use App\Models\Pegawai\Pegawai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenerimaSuratMasukEksternal extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'penerima_surat_masuk_eksternals';

    protected $fillable = [
        'id_surat_masuk',
        'id_pegawai',
    ];
    public function suratMasuk()
{
    return $this->belongsTo(SuratMasuk::class, 'id_surat_masuk');
}


    public function Pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}