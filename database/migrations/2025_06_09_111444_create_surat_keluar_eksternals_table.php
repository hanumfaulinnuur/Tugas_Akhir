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
        Schema::create('surat_keluar_eksternals', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->unique();
            $table->date('tgl_keluar_surat');
            $table->string('deskripsi_surat');
            $table->string('penerima_surat');
            $table->unsignedBigInteger('id_jenis_surat');
             $table->foreign('id_jenis_surat')->references('id')->on('jenis_surats')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar_eksternals');
    }
};
