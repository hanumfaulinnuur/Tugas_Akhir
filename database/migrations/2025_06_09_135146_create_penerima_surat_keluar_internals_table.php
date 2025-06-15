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
        Schema::create('penerima_surat_keluar_internals', function (Blueprint $table) {
           $table->id();
            $table->unsignedBigInteger('id_surat_keluar_internal');
            $table->foreign('id_surat_keluar_internal')->references('id')->on('surat_keluar_internals')->onDelete('cascade');
            $table->unsignedBigInteger('id_pegawai');
            $table->foreign('id_pegawai')->references('id')->on('pegawais')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerima_surat_keluar_internals');
    }
};
