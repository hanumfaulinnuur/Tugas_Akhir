<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('surat_keluar_internals', function (Blueprint $table) {
            $table->renameColumn('kode_satuan', 'kode_instansi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_keluar_internals', function (Blueprint $table) {
            $table->renameColumn('kode_satuan', 'kode_instansi');
        });
    }
};
