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
        Schema::create('penerima_surat_masuk_eksternals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_surat_masuk_internal');
            $table->foreign('id_surat_masuk_internal')->references('id')->on('surat_masuks')->onDelete('cascade');
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
        Schema::dropIfExists('penerima_surat_masuk_eksternals');
    }
};
