<?php

namespace App\Models\DataTujuanSurat;

use App\Models\Admin\SuratKeluarInternal;
use App\Models\Pegawai\Pegawai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PenerimaSuratMasukEksternal extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'penerima_surat_masuk_eksternals';

    protected $fillable = [
        'id_surat_keluar_internal',
        'id_pegawai',
    ];
    public function suratKeluarInternal()
    {
        return $this->belongsTo(SuratKeluarInternal::class, 'id_surat_keluar_internal');
    }

    public function Pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }
}
