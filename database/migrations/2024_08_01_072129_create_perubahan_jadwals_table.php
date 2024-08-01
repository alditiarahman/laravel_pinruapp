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
        Schema::create('perubahan_jadwals', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_perubahan');
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->text('alasan_perubahan');
            $table->unsignedBigInteger('id_peminjam');
            $table->unsignedBigInteger('id_petugas')->nullable();
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_peminjam')->references('id')->on('users');
            $table->foreign('id_petugas')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perubahan_jadwals');
    }
};
