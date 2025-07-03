<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisSurat extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    protected $table = 'jenis_surats';

    protected $fillable = ['nama_jenis_surat','kode'];

    public function suratMasuk()
    {
        return $this->hasMany(SuratMasuk::class, 'id_jenis_surat');
    }

    public function suratKeluarEksternal()
    {
        return $this->hasMany(SuratKeluarEksternal::class, 'id_jenis_surat');
    }
    public function suratKeluarInternal()
    {
        return $this->hasMany(SuratKeluarInternal::class, 'id_jenis_surat');
    }
}