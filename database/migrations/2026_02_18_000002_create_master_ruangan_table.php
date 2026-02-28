<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_ruangan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lokasi_id')->constrained('master_lokasi')->cascadeOnDelete();
            $table->string('kode_ruangan');
            $table->string('nama_ruangan');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_ruangan');
    }
};
