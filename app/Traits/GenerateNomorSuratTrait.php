<?php

namespace App\Traits;

trait GenerateNomorSuratTrait
{
    public function generateNomorSurat($model, $kodeJenis)
    {
        $last = $model::where('no_surat', 'LIKE', "%/$kodeJenis/%")->latest()->first();
        $next = $last ? intval(substr($last->no_surat, 0, 3)) + 1 : 1;

        $bulanRomawi = ['I','II','III','IV','V','VI','VII','VIII','IX','X','XI','XII'];
        return str_pad($next, 3, '0', STR_PAD_LEFT) . "/$kodeJenis/SMK-NHD/" . $bulanRomawi[date('n') - 1] . '/' . date('Y');
    }
}
