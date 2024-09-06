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
        Schema::create('alat_kesehatan', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('foto_alat_kesehatan');
            $table->string('foto_serial_number')->nullable(true);
            $table->string('nama_alat_kesehatan');
            $table->string('kode_inventaris')->unique(true);
            $table->string('merk')->nullable(true);
            $table->string('type')->nullable(true);
            $table->string('nomer_seri');
            $table->uuid('ruangan');
            $table->string('akd')->nullable(true);
            $table->string('akl')->nullable(true);
            $table->enum('klasifikasi', ['Bedah dan Anestesi', 'Diagnostik', 'Laboratorium', 'Life Support', 'Radiologi', 'Terapi']);
            $table->enum('teknologi', ['Teknologi Sederhana', 'Teknologi Menengah', 'Teknologi Tinggi']);
            $table->enum('risiko', ['Risiko Rendah', 'Risiko Menengah', 'Risiko Tinggi']);
            $table->date('tanggal_pengadaan');
            $table->enum('sumber_pendanaan', ['APBD', 'BLUD', 'DAk', 'HIBAH']);
            $table->string('nama_penyedia');
            $table->date('masa_garansi')->nullable(true);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('ruangan')->references('id')->on('ruangan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat_kesehatans');
    }
};
