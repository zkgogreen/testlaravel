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
        Schema::create('tb_kp', function (Blueprint $table) {
            $table->id();
            $table->string('kode_bps')->nullable();
            $table->string('keldes')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('kabkot'); 
            $table->string('provinsi'); 
            $table->string('jenis_kawasan')->nullable();
            $table->string('status_3t')->nullable();
            $table->string('lokpri')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_ks');
    }
};
