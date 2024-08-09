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
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('nama_pj');
            $table->string('jabatan');
            $table->string('instansi');
            $table->string('nomor_identitas');
            $table->string('nomor_telepon');
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->string('jumlah_hari');
            $table->text('keperluan');
            $table->unsignedBigInteger('id_ruangan');
            $table->unsignedBigInteger('id_peminjam');
            $table->unsignedBigInteger('id_petugas')->nullable();
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_ruangan')->references('id')->on('ruangans');
            $table->foreign('id_peminjam')->references('id')->on('users');
            $table->foreign('id_petugas')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjamen');
    }
};
