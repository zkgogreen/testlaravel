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
        Schema::create('tb_spd', function (Blueprint $table) {
            $table->id();
            $table->string('kode_bps')->nullable(); 
            $table->string('keldes');
            $table->string('kecamatan');
            $table->string('kabkot'); 
            $table->string('provinsi'); 
            $table->string('nama')->nullable(); 
            $table->string('seluler')->nullable();
            $table->string('elektrifikasi')->nullable();
            $table->string('akses_jalan')->nullable();
            $table->integer('jumlah_penduduk')->nullable();
            $table->integer('jumlah_kk')->nullable();
            $table->string('pendapatan')->nullable();
            $table->string('jumlah_umkm')->nullable();
            $table->string('komunitas')->nullable();
            $table->string('dana_desa')->nullable();
            $table->string('pemerintah_desa')->nullable();
            $table->string('bumdes')->nullable();
            $table->string('pencaharian')->nullable();
            $table->string('jenis_umkm')->nullable();
            $table->string('pic')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('thn_survey')->nullable();
            $table->string('potensi')->nullable();
            $table->string('foto1')->nullable();
            $table->string('foto2')->nullable();
            $table->string('foto3')->nullable();
            $table->string('foto4')->nullable();
            $table->string('foto5')->nullable();                            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_spd');
    }
};
