<?php

namespace App\Models\Pegawai;

use App\Models\DataTujuanSurat\PenerimaSuratKeluarInternal;
use App\Models\DataTujuanSurat\PenerimaSuratMasukEksternal;
use App\Models\DataTujuanSurat\PengerimSuratInternal;
use App\Models\DataTujuanSurat\PengirimSuratKeluarEksternal;
use App\Models\Pegawai\jabatanPegawai;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $table = 'pegawais';

    protected $fillable = [
        'nik_pegawai',
        'nama_pegawai',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'no_telp',
        'email',
    ];

    public function jabatanPegawai()
    {
        return $this->hasMany(JabatanPegawai::class, 'id_pegawai');
    }

    public function penerimaSuratMasukEksternal()
    {
        return $this->hasMany(PenerimaSuratMasukEksternal::class, 'id_pegawai');
    }

    public function penerimaSuratMasukInternal()
    {
        return $this->hasMany(PenerimaSuratKeluarInternal::class, 'id_pegawai');
    }

    public function pengerimSuratInternal()
    {
        return $this->hasMany(PengerimSuratInternal::class, 'id_pegawai');
    }

    public function pengirimSuratKeluarEksternal()
    {
        return $this->hasMany(PengirimSuratKeluarEksternal::class, 'id_pegawai');
    }
    
}
