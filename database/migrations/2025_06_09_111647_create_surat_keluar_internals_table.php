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
        Schema::create('surat_keluar_internals', function (Blueprint $table) {
            $table->id();
            $table->string('no_surat')->unique();
            $table->date('tgl_surat');
            $table->string('judul_surat');
            $table->string('deskripsi_surat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_keluar_internals');
    }
};
