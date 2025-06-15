<?php

namespace App\Models\Pegawai;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;

    protected $primaryKey = "id";
    protected $table = 'units';

    protected $fillable = ['nama_unit'];

    public function Jabatan()
    {
        return $this->hasMany(Jabatan::class, 'id_unit');
    }
}
