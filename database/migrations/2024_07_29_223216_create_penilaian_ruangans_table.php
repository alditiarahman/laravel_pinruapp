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
        Schema::create('penilaian_ruangans', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->unsignedBigInteger('id_ruangan');
            $table->unsignedBigInteger('id_peminjam');
            $table->enum('kebersihan', ['bersih', 'cukup bersih', 'kurang bersih'])->default('bersih');
            $table->enum('kenyamanan', ['nyaman', 'cukup nyaman', 'kurang nyaman'])->default('nyaman');
            $table->enum('kelengkapan_fasilitas', ['lengkap', 'cukup lengkap', 'kurang lengkap'])->default('lengkap');
            $table->text('saran')->nullable();
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_ruangan')->references('id')->on('ruangans');
            $table->foreign('id_peminjam')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_ruangans');
    }
};
