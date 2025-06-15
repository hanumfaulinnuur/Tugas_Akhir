<?php

namespace App\Models\Pegawai;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JabatanPegawai extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'jabatan_pegawais';

    protected $fillable = [
        'id_pegawai',
        'id_jabatan',
    
    ];
    // Ubah menjadi huruf kecil
public function pegawai()
{
    return $this->belongsTo(Pegawai::class, 'id_pegawai');
}

public function jabatan()
{
    return $this->belongsTo(Jabatan::class, 'id_jabatan');
}

   
}
