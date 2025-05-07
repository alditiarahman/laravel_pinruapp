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
        // Add foreign key to penilaian_ruangans
        Schema::table('penilaian_ruangans', function (Blueprint $table) {
            $table->unsignedBigInteger('id_peminjamen')->nullable();

            // Foreign key relation
            $table->foreign('id_peminjamen')->references('id')->on('peminjamen')->onDelete('cascade');
        });

        // Add foreign key to penilaian_petugas
        Schema::table('penilaian_petugas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_peminjamen')->nullable();

            // Foreign key relation
            $table->foreign('id_peminjamen')->references('id')->on('peminjamen')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the foreign keys and the columns
        Schema::table('penilaian_ruangans', function (Blueprint $table) {
            $table->dropForeign(['id_peminjamen']);
            $table->dropColumn('id_peminjamen');
        });

        Schema::table('penilaian_petugas', function (Blueprint $table) {
            $table->dropForeign(['id_peminjamen']);
            $table->dropColumn('id_peminjamen');
        });
    }
};
