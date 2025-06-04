<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JenisSurat extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    protected $table = 'jenis_surats';

    protected $fillable = ['nama_jenis_surat'];

    public function suratMasuk()
    {
        return $this->hasMany(SuratMasuk::class, 'id_jenis_surat');
    }
}