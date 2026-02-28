<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('master_jenis_barang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('klasifikasi_id')->constrained('master_klasifikasi')->cascadeOnDelete();
            $table->string('kode_jenis');
            $table->string('nama_jenis');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_jenis_barang');
    }
};