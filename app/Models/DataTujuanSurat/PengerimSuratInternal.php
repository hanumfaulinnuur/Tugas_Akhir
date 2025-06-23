<?php

namespace App\Models\DataTujuanSurat;

use App\Models\Admin\SuratKeluarEksternal;
use App\Models\Pegawai\Pegawai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PengirimSuratInternal extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'pengirim_surat_internals';

    protected $fillable = [
        'id_pegawai',
        'id_surat_keluar_eksternal',
    ];
    public function Pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai');
    }

    public function suratKeluarEksternal()
    {
        return $this->belongsTo(SuratKeluarEksternal::class, 'id_surat_keluar_eksternal');
    }

}
