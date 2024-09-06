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
        Schema::create('pegawai_user', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pegawai');
            $table->string('username', 40)->unique();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('pegawai')->references('id')->on('pegawai')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai_users');
    }
};
