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
        Schema::create('pembatalans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_pembatalan');
            $table->text('alasan_pembatalan');
            $table->unsignedBigInteger('id_peminjam');
            $table->timestamps();

            // Foreign Key
            $table->foreign('id_peminjam')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembatalans');
    }
};
