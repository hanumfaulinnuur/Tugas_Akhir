<?php

namespace App\Models\Pegawai;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jabatan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'jabatans';

    protected $fillable = [
        'nama_jabatan',
        'id_unit',
    
    ];
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'id_unit');
    }
    public function jabatanPegawai()
    {
        return $this->hasMany(JabatanPegawai::class, 'id_jabatan');
    }
}
