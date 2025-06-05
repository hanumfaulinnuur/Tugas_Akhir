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
        Schema::create('surat_masuks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_surat');
            $table->string('nomor_surat');
            $table->unsignedBigInteger('id_jenis_surat');
            $table->foreign('id_jenis_surat')->references('id')->on('jenis_surats')->onDelete('cascade');
            $table->string('judul_surat');
            $table->date('tanggal_surat');
            $table->string('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_masuks');
    }
};
