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
        Schema::create('pinjam_barang', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('barang');
            $table->string('no_wa');

            $table->uuid('pegawai_pinjam');
            $table->timestamp('tanggal_pinjam');
            $table->timestamp('tanggal_kembali')->nullable(true);

            $table->enum('status', ['PINJAM', 'KEMBALI', 'HILANG'])->default('PINJAM');

            $table->timestamps();
            $table->foreign('barang')->references('id')->on('alat_kesehatan')->onDelete('cascade');
            $table->foreign('pegawai_pinjam')->references('id')->on('pegawai')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjam_barangs');
    }
};
