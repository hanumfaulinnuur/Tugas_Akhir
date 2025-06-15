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
        Schema::create('pengirim_surat_keluar_eksternals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_surat_keluar_internal');
            $table->unsignedBigInteger('id_pegawai');

        // Tambahkan foreign key dengan nama constraint yang lebih pendek
        $table->foreign('id_surat_keluar_internal', 'fk_surat_keluar_internal')
              ->references('id')->on('surat_keluar_internals')
              ->onDelete('cascade');

        $table->foreign('id_pegawai', 'fk_pegawai')
              ->references('id')->on('pegawais')
              ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirim_surat_keluar_eksternals');
    }
};
