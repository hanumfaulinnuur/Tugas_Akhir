<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('surat_keluar_eksternals', function (Blueprint $table) {
        $table->string('kode_urusan')->nullable();
        $table->string('no_urut')->nullable();
        $table->string('kode_satuan')->nullable();
        $table->json('data_dinamis')->nullable();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_keluar_eksternals', function (Blueprint $table) {
            //
        });
    }
};
