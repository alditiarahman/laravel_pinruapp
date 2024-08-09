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
        Schema::create('penilaian_petugas', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_surat');
            $table->enum('pelayanan', ['fast respon', 'slow respon'])->default('fast respon');
            $table->text('saran')->nullable();
            $table->unsignedBigInteger('id_petugas');
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_petugas')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_petugas');
    }
};
